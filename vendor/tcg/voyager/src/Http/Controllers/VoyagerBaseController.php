<?php

namespace TCG\Voyager\Http\Controllers;

use App\Chapter;
use App\Event;
use App\ProductsNative;
use App\SchoolPlan;
use App\SchoolPlanSchools;
use App\VideoNative;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataRestored;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use Auth;
use TCG\Voyager\Models\DataRow;


class VoyagerBaseController extends Controller
{
    use BreadRelationshipParser;

    //***************************************
    //               ____
    //              |  _ \
    //              | |_) |
    //              |  _ <
    //              | |_) |
    //              |____/
    //
    //      Browse our Data Type (B)READ
    //
    //****************************************



    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
        $searchable = $dataType->server_side ? array_keys(SchemaManager::describeTable(app($dataType->model_name)->getTable())->toArray()) : '';
        $orderBy = $request->get('order_by', $dataType->order_column);
        $sortOrder = $request->get('sort_order', null);
        $usesSoftDeletes = false;
        $showSoftDeleted = false;
        $orderColumn = [];
        if ($orderBy) {
            $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + 1;
            $orderColumn = [[$index, 'desc']];
            if (!$sortOrder && isset($dataType->order_direction)) {
                $sortOrder = $dataType->order_direction;
                $orderColumn = [[$index, $dataType->order_direction]];
            } else {
                $orderColumn = [[$index, 'desc']];
            }
        }

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $query = $model->{$dataType->scope}();
            } else {
                $query = $model::select('*');
            }
            if (strpos($request->getPathInfo(), "/events") != false && strpos($request->getPathInfo(), "/events-") == false) {
                $query->whereNull("parent_id");
            }
            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses($model)) && app('VoyagerAuth')->user()->can('delete', app($dataType->model_name))) {
                $usesSoftDeletes = true;

                if ($request->get('showSoftDeleted')) {
                    $showSoftDeleted = true;
                    $query = $query->withTrashed();
                }
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value != '' && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
                $query->where($search->key, $search_filter, $search_value);
            }

            if ($orderBy && in_array($orderBy, $dataType->fields())) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        if (($isModelTranslatable = is_bread_translatable($model))) {
            $dataTypeContent->load('translations');
        }

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        // Check if a default search key is set
        $defaultSearchKey = $dataType->default_search_key ?? null;

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return Voyager::view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'orderColumn',
            'sortOrder',
            'searchable',
            'isServerSide',
            'defaultSearchKey',
            'usesSoftDeletes',
            'showSoftDeleted'
        ));
    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |__) |
    //               |  _  /
    //               | | \ \
    //               |_|  \_\
    //
    //  Read an item of our Data Type B(R)EAD
    //
    //****************************************

    public function show(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $isSoftDeleted = false;

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses($model))) {
                $model = $model->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $model = $model->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
            if ($dataTypeContent->deleted_at) {
                $isSoftDeleted = true;
            }
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        // Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'read');

        // Check permission
        $this->authorize('read', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }

        if ($slug == "promo-codes") {
            $model = \App\PromoCode::where("id", $id)->first();
        } elseif ($slug == "products-native") {
            $model = ProductsNative::where("id", $id)->first();
        } elseif ($slug == "generate-link") {
            $model = \App\GenerateLink::where("id", $id)->first();
        } elseif ($slug == "orders") {
            $model = \App\Order::where("id", $id)->first();
        } elseif ($slug == "events") {
            $model = \App\Event::where("id", $id)->first();
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'isSoftDeleted', 'model'));
    }

    //***************************************
    //                ______
    //               |  ____|
    //               | |__
    //               |  __|
    //               | |____
    //               |______|
    //
    //  Edit an item of our Data Type BR(E)AD
    //
    //****************************************

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses($model))) {
                $model = $model->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $model = $model->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        $extraModels = null;
        if (strpos($request->getPathInfo(), "/events") != false && strpos($request->getPathInfo(), "/events-") == false) {
            $extraModels = \App\Event::where("parent_id", "=", $id)->get();
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        if ($slug == "promo-codes") {
            $model = \App\PromoCode::where("id", $id)->first();
        } elseif ($slug == "products-native") {
            $model = ProductsNative::where("id", $id)->first();
        } elseif ($slug == "generate-link") {
            $model = \App\GenerateLink::where("id", $id)->first();
        } elseif ($slug == "orders") {
            $model = \App\Order::where("id", $id)->first();
        } elseif ($slug == "events") {
            $model = \App\Event::where("id", $id)->first();
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'extraModels', 'model'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $vid = "";
        $att = "";
        if ($slug == "events") {
            $model = \App\Event::find($id);
            $vid = $model->video;
            $att = $model->attachment;
        }

        $vidNat = "";
        $attNat = "";
        if ($slug == "video-natives") {
            $model = \App\VideoNative::find($id);
            $vidNat = $model->video_upload;
            $attNat = $model->attachments;
        }

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);

        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }

        if ($slug == "generate-link") {
                $model = \App\GenerateLink::find($id);
                $model->name = $_POST['name'];
                $model->save();
        }

        if ($slug == "orders") {
                $model = \App\Order::find($id);
                $model->payment = $_POST['payment'];
                $model->shippment = $_POST['shippment'];
                $model->product_quantity = $_POST['product_quantity'];
                $model->save();
        }

        if ($model && in_array(SoftDeletes::class, class_uses($model))) {
            $data = $model->withTrashed()->findOrFail($id);
        } else {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        }

        if (request()->segments()[2] == "products-native") {
            $model = ProductsNative::find($id);
            if ($_FILES['file-input']) {
                $file_chunks = explode('.', $_FILES['file-input']['name']);
                $filename = "book_{$model->id}.".end($file_chunks);
                move_uploaded_file($_FILES['file-input']['tmp_name'], public_path()."/storage/products-native/".$filename);
                $model->e_book = $filename;
            }
            $model->tax = $_POST['tax'];
            $model->shipping_fee = $_POST['shipping_fee'];
            $model->save();
        }

        if (request()->segments()[2] == "school-plans") {
            $data->schools_number = $_POST['schools_number'];
            $data->priority = $_POST['priority'];
            $newSchoolsArray = $_POST['schools'];
            $oldSchoolsArray = [];
            $oldSchools = SchoolPlanSchools::where('plan_id', $data->id)->get();
            if ($oldSchools) {
                foreach ($oldSchools as $sc) {
                    $oldSchoolsArray[] = $sc->school_id;
                }
            }
            $forDelete = array_diff($oldSchoolsArray, $newSchoolsArray);
            $forSave = array_diff($newSchoolsArray, $oldSchoolsArray);

            if ($forDelete) {
                foreach ($forDelete as $id) {
                    SchoolPlanSchools::where([['school_id', $id], ['plan_id',$data->id]])->delete();
                }
            }

            if ($forSave) {
                foreach ($forSave as $id) {
                    $newModel = new SchoolPlanSchools();
                    $newModel->plan_id = $data->id;
                    $newModel->school_id = $id;
                    $newModel->save();
                }
            }
        }

        if (get_class($model) == "App\Chapter") {
            $data->hours = $_POST['hours'];
            $data->sort = $_POST['sort'];
        } else if (get_class($model) == "App\Course") {
            $data->sort = $_POST['sort'];
        }

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        event(new BreadDataUpdated($dataType, $data));

        if ($slug == "events") {
            $model = \App\Event::find($id);
            if ($_FILES) {
                if (gettype($_FILES['video']["name"]) == "array" && array_key_exists(0, $_FILES['video']['name'])) {
                    if ($_FILES['video']["name"][0]) {
                        $filename = basename($_FILES["video"]['name'][0]);
                        move_uploaded_file($_FILES["video"]['tmp_name'][0], public_path()."/storage/events/videos/".$filename);
                        $model->video = '[{"download_link":"events\/videos\/'.$filename.'","original_name":"'.$filename.'"}]';
                    } else {
                        $model->video = $vid;
                    }
                }
                
                if (gettype($_FILES['attachment']["name"]) == "array" && array_key_exists(0, $_FILES['attachment']['name'])) {
                    if ($_FILES['attachment']['name'][0]) {
                        $attachmentName = basename($_FILES["attachment"]['name'][0]);
                        move_uploaded_file($_FILES["attachment"]['tmp_name'][0], public_path()."/storage/events/attachments/".$attachmentName);
                        $model->attachment = '[{"download_link":"events\/attachments\/'.$attachmentName.'","original_name":"'.$attachmentName.'"}]';
                    } else {
                        $model->attachment = $att;
                    }
                }
                
                $model->save();
                
                $subModels = \App\Event::where("parent_id", "=", $model->id)->get(); 
                for ($i = 2; $i < 11; $i++) {
                    $subModel = $subModels[$i - 2];
                    if ($_FILES["video{$i}"]["name"]) {
                        $filename = basename($_FILES["video{$i}"]['name']);
                        move_uploaded_file($_FILES["video{$i}"]['tmp_name'], public_path()."/storage/events/videos/".$filename);
                        $subModel->video = $filename;
                    }
                    if ($_FILES["attachment{$i}"]["name"]) {
                        $attachmentName = basename($_FILES["attachment{$i}"]['name']);
                        move_uploaded_file($_FILES["attachment{$i}"]['tmp_name'], public_path()."/storage/events/attachments/".$attachmentName);
                        $subModel->attachment = $attachmentName;
                    }
                    $subModel->name = $_POST["name{$i}"];
                    $subModel->save();
                    
                }
            }
        }

        if ($slug == "video-natives") {
            $vn = VideoNative::find($id);
            if ($_FILES['video_upload']['name'][0] != "") {
                $filename = basename($_FILES['video_upload']['name'][0]);
                move_uploaded_file($_FILES['video_upload']['tmp_name'][0], public_path() . "/storage/events-natives/" . $filename);
                $vn->video_upload = '[{"download_link":"events-natives\/'.$filename.'","original_name":"'.$filename.'"}]';
            } else {
                $vn->video_upload = $vidNat;
            }
            if ($_FILES['attachments']['name'][0] != "") {
                $filename = basename($_FILES['attachments']['name'][0]);
                move_uploaded_file($_FILES['attachments']['tmp_name'][0], public_path() . "/storage/events-natives/" . $filename);
                $vn->attachments = '[{"download_link":"events-natives\/'.$filename.'","original_name":"'.$filename.'"}]';   
            } else {
                $vn->attachments = $attNat;
            }
            $vn->save();
        }

       if ($slug == "media-documents") {
            $model = \App\MediaDocument::find($id);
            if ($_FILES['attachment']) {
                $filename = basename($_FILES['attachment']['name'][0]);
                move_uploaded_file($_FILES["attachment"]['tmp_name'][0], public_path()."/storage/media-documents/" . $filename);
                $model->attachment = '[{"download_link":"media-documents\/'.$filename.'","original_name":"'.$filename.'"}]';
                $model->save();
            }
        }

        $user = Auth::user();

        if ($user->role_id != '1' && $slug == 'users') {
            return redirect()
            ->back()
            ->with([
                'message'    => __('voyager::generic.successfully_updated')." {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
        } else {
            return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => __('voyager::generic.successfully_updated')." {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
        }
    }

    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
                            ? new $dataType->model_name()
                            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();

        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        if (request()->segments()[2] == "chapters") {
            $model = \App\Chapter::latest()->first();
            $model->hours = $_POST['hours'];
            $model->sort = $_POST['sort'];
            $model->update();
        } else if (request()->segments()[2] == "courses") {
            $model = \App\Course::latest()->first();
            $model->sort = $_POST['sort'];
            $model->update();
        }

        if ($slug == "products-native") {
            $model = ProductsNative::latest()->first();
            if ($_FILES['file-input']) {
                $file_chunks = explode('.', $_FILES['file-input']['name']);
                $filename = "book_{$model->id}.".end($file_chunks);
                move_uploaded_file($_FILES['file-input']['tmp_name'], public_path()."/storage/products-native/".$filename);
                $model->e_book = $filename;
            }
            $model->save();
        }

        if (request()->segments()[2] == "school-plans") {
            $lastPlan = SchoolPlan::latest()->first();
            $lastPlan->schools_number = $_POST['schools_number'];
            $lastPlan->priority = $_POST['priority'];
            if ($schools = $_POST['schools']) {
                foreach ($schools as $school) {
                    $model = new SchoolPlanSchools();
                    $model->plan_id = $lastPlan->id;
                    $model->school_id = $school;
                    $model->save();
                }
            }
            $lastPlan->save();
        }

        if ($slug == "generate-link") {
            $model = \App\GenerateLink::latest()->first();
            $model->name = $_POST['name'];
            if ($_FILES['file'] != "") {
                $file_chunks = explode('.', $_FILES['file']['name']);
                $filename = $model->id . "_" . $_FILES['file']['name'];
                $filename = md5($filename) . "." . end($file_chunks);
                move_uploaded_file($_FILES['file']['tmp_name'], public_path()."/storage/links/".$filename);
                $model->link = url('/') . "/storage/links/" . $filename;
                $model->file = $filename;
                $model->uniqid = uniqid();
            }
            $model->save();
        }

        if ($slug == "events") {
            $model = \App\Event::latest()->first();
            if ($_FILES) {
                $filename = basename($_FILES["video"]['name']);
                $attachmentName = basename($_FILES["attachment"]['name']);
                move_uploaded_file($_FILES["video"]['tmp_name'], public_path()."/storage/events/videos/".$filename);
                move_uploaded_file($_FILES["attachment"]['tmp_name'], public_path()."/storage/events/attachments/".$attachmentName);
                $model->video = '[{"download_link":"events\/videos\/'.$filename.'","original_name":"'.$filename.'"}]';;
                $model->attachment = '[{"download_link":"events\/attachments\/'.$attachmentName.'","original_name":"'.$attachmentName.'"}]';;
                $model->save();
                for ($i = 2; $i < 11; $i++) {
                    $subModel = new \App\Event();
                    $filename = basename($_FILES["video{$i}"]['name']);
                    $attachmentName = basename($_FILES["attachment{$i}"]['name']);
                    move_uploaded_file($_FILES["video{$i}"]['tmp_name'], public_path()."/storage/events/videos/".$filename);
                    move_uploaded_file($_FILES["attachment{$i}"]['tmp_name'], public_path()."/storage/events/attachments/".$attachmentName);
                    $subModel->name = $_POST["name{$i}"];
                    $subModel->video = $filename;
                    $subModel->attachment = $attachmentName;
                    $subModel->parent_id = $model->id;
                    $subModel->save();
                }
            }
        }

        if ($slug == "video-natives") {
            $model = VideoNative::latest()->first();
            if ($_FILES['video_upload']['name'][0] != "") {
                $filename = basename($_FILES['video_upload']['name'][0]);
                move_uploaded_file($_FILES['video_upload']['tmp_name'][0], public_path()."/storage/video-natives/".$filename);
                $model->video_upload = '[{"download_link":"video-natives\/'.$filename.'","original_name":"'.$filename.'"}]';
            }
            if ($_FILES['attachments']['name'][0] != "") {
                $filename = basename($_FILES['attachments']['name'][0]);
                move_uploaded_file($_FILES['attachments']['tmp_name'][0], public_path()."/storage/video-natives/".$filename);
                $model->attachments = '[{"download_link":"video-natives\/'.$filename.'","original_name":"'.$filename.'"}]';
            }
            $model->save();
        }

        event(new BreadDataAdded($dataType, $data));

        return redirect()
        ->route("voyager.{$dataType->slug}.index")
        ->with([
                'message'    => __('voyager::generic.successfully_added_new')." {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |  | |
    //               | |  | |
    //               | |__| |
    //               |_____/
    //
    //         Delete an item BREA(D)
    //
    //****************************************

    public function destroy(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('delete', app($dataType->model_name));

        // Init array of IDs
        $ids = [];
        if (empty($id)) {
            // Bulk delete, get IDs from POST
            $ids = explode(',', $request->ids);
        } else {
            // Single item delete, get ID from URL
            $ids[] = $id;
        }
        foreach ($ids as $id) {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

            $model = app($dataType->model_name);
            if (!($model && in_array(SoftDeletes::class, class_uses($model)))) {
                $this->cleanup($dataType, $data);
            }
        }

        $displayName = count($ids) > 1 ? $dataType->display_name_plural : $dataType->display_name_singular;

        $res = $data->destroy($ids);
        $data = $res
            ? [
                'message'    => __('voyager::generic.successfully_deleted')." {$displayName}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => __('voyager::generic.error_deleting')." {$displayName}",
                'alert-type' => 'error',
            ];

        if ($res) {
            event(new BreadDataDeleted($dataType, $data));
        }

        // return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
        return redirect()->back()->with($data);
    }

    public function restore(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('delete', app($dataType->model_name));

        // Get record
        $model = call_user_func([$dataType->model_name, 'withTrashed']);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        $data = $model->findOrFail($id);

        $displayName = $dataType->display_name_singular;

        $res = $data->restore($id);
        $data = $res
            ? [
                'message'    => __('voyager::generic.successfully_restored')." {$displayName}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => __('voyager::generic.error_restoring')." {$displayName}",
                'alert-type' => 'error',
            ];

        if ($res) {
            event(new BreadDataRestored($dataType, $data));
        }

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }

    /**
     * Remove translations, images and files related to a BREAD item.
     *
     * @param \Illuminate\Database\Eloquent\Model $dataType
     * @param \Illuminate\Database\Eloquent\Model $data
     *
     * @return void
     */
    protected function cleanup($dataType, $data)
    {
        // Delete Translations, if present
        if (is_bread_translatable($data)) {
            $data->deleteAttributeTranslations($data->getTranslatableAttributes());
        }

        // Delete Images
        $this->deleteBreadImages($data, $dataType->deleteRows->where('type', 'image'));

        // Delete Files
        foreach ($dataType->deleteRows->where('type', 'file') as $row) {
            if (isset($data->{$row->field})) {
                foreach (json_decode($data->{$row->field}) as $file) {
                    $this->deleteFileIfExists($file->download_link);
                }
            }
        }

        // Delete media-picker files
        $dataType->rows->where('type', 'media_picker')->where('details.delete_files', true)->each(function ($row) use ($data) {
            $content = $data->{$row->field};
            if (isset($content)) {
                if (!is_array($content)) {
                    $content = json_decode($content);
                }
                if (is_array($content)) {
                    foreach ($content as $file) {
                        $this->deleteFileIfExists($file);
                    }
                } else {
                    $this->deleteFileIfExists($content);
                }
            }
        });
    }

    /**
     * Delete all images related to a BREAD item.
     *
     * @param \Illuminate\Database\Eloquent\Model $data
     * @param \Illuminate\Database\Eloquent\Model $rows
     *
     * @return void
     */
    public function deleteBreadImages($data, $rows)
    {
        foreach ($rows as $row) {
            if ($data->{$row->field} != config('voyager.user.default_avatar')) {
                $this->deleteFileIfExists($data->{$row->field});
            }

            if (isset($row->details->thumbnails)) {
                foreach ($row->details->thumbnails as $thumbnail) {
                    $ext = explode('.', $data->{$row->field});
                    $extension = '.'.$ext[count($ext) - 1];

                    $path = str_replace($extension, '', $data->{$row->field});

                    $thumb_name = $thumbnail->name;

                    $this->deleteFileIfExists($path.'-'.$thumb_name.$extension);
                }
            }
        }

        if ($rows->count() > 0) {
            event(new BreadImagesDeleted($data, $rows));
        }
    }

    /**
     * Order BREAD items.
     *
     * @param string $table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('edit', app($dataType->model_name));

        if (!isset($dataType->order_column) || !isset($dataType->order_display_column)) {
            return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => __('voyager::bread.ordering_not_set'),
                'alert-type' => 'error',
            ]);
        }

        $model = app($dataType->model_name);
        if ($model && in_array(SoftDeletes::class, class_uses($model))) {
            $model = $model->withTrashed();
        }
        $results = $model->orderBy($dataType->order_column, $dataType->order_direction)->get();

        $display_column = $dataType->order_display_column;

        $dataRow = Voyager::model('DataRow')->whereDataTypeId($dataType->id)->whereField($display_column)->first();

        $view = 'voyager::bread.order';

        if (view()->exists("voyager::$slug.order")) {
            $view = "voyager::$slug.order";
        }

        return Voyager::view($view, compact(
            'dataType',
            'display_column',
            'dataRow',
            'results'
        ));
    }

    public function update_order(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('edit', app($dataType->model_name));

        $model = app($dataType->model_name);

        $order = json_decode($request->input('order'));
        $column = $dataType->order_column;
        foreach ($order as $key => $item) {
            if ($model && in_array(SoftDeletes::class, class_uses($model))) {
                $i = $model->withTrashed()->findOrFail($item->id);
            } else {
                $i = $model->findOrFail($item->id);
            }
            $i->$column = ($key + 1);
            $i->save();
        }
    }

    public function action(Request $request)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $action = new $request->action($dataType, null);

        return $action->massAction(explode(',', $request->ids), $request->headers->get('referer'));
    }

    /**
     * Get BREAD relations data.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function relation(Request $request)
    {
        $slug = $this->getSlug($request);
        $page = $request->input('page');
        $on_page = 50;
        $search = $request->input('search', false);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        foreach ($dataType->editRows as $key => $row) {
            if ($row->field === $request->input('type')) {
                $options = $row->details;
                $skip = $on_page * ($page - 1);

                // If search query, use LIKE to filter results depending on field label
                if ($search) {
                    $total_count = app($options->model)->where($options->label, 'LIKE', '%'.$search.'%')->count();
                    $relationshipOptions = app($options->model)->take($on_page)->skip($skip)
                        ->where($options->label, 'LIKE', '%'.$search.'%')
                        ->get();
                } else {
                    $total_count = app($options->model)->count();
                    $relationshipOptions = app($options->model)->take($on_page)->skip($skip)->get();
                }

                $results = [];
                foreach ($relationshipOptions as $relationshipOption) {
                    $results[] = [
                        'id'   => $relationshipOption->{$options->key},
                        'text' => $relationshipOption->{$options->label},
                    ];
                }

                return response()->json([
                    'results'    => $results,
                    'pagination' => [
                        'more' => ($total_count > ($skip + $on_page)),
                    ],
                ]);
            }
        }

        // No result found, return empty array
        return response()->json([], 404);
    }
}
