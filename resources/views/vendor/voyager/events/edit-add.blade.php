@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if($edit)
                        {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp

                            <?php if ($edit) {
                                $children = \App\Event::where("parent_id", "=", $model->id)->get();
                            } ?>
                            <ul class="nav nav-tabs">
                                @for($i=1; $i<11; $i++)
                                    <li class="<?= $i==1 ? "active" : "" ?>"><a data-toggle="tab" href="#tab<?= $i ?>">Tab <?= $i ?></a></li>
                                @endfor
                            </ul>

                            <div class="tab-content">
                                @for($i=1; $i<11; $i++)
                                    @if($i==1)
                                        <div id="tab<?= $i ?>" class="tab-pane fade <?= $i==1 ? "in active" : "" ?>">
                                        @foreach($dataTypeRows as $row)
                                            <!-- GET THE DISPLAY OPTIONS -->
                                                @php
                                                    $display_options = $row->details->display ?? NULL;
                                                    if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                                        $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                                    }
                                                @endphp
                                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                                @endif

                                                <?php
                                                $dynamicClass = NULL;
                                                if ($edit) {
                                                    if ($row->display_name == 'Video' || $row->display_name == 'Attachment') {
                                                        $date = new DateTime($dataTypeContent->end_date);
                                                        $now = new DateTime();

                                                        if(/*$date < $now*/ 1==1) {
                                                            $dynamicClass = NULL;
                                                        } else {
                                                            $dynamicClass = 'hidden';
                                                        }
                                                    }
                                                }
                                                ?>
                                                <div class="form-group <?= $dynamicClass; ?> @if(!$edit && $row->display_name == 'Video') hidden @endif @if(!$edit && $row->display_name == 'Attachment') hidden @endif @if($row->display_name == 'Period') hidden @endif  @if($row->type == 'relationship' && $row->display_name == 'Coach') hidden @endif @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                                    {{ $row->slugify }}
                                                    <label class="control-label" for="name">{{ $row->display_name }}</label>
                                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                                    @if (isset($row->details->view))
                                                        @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add')])
                                                    @elseif ($row->type == 'relationship')
                                                        <?php if ($row->display_name == 'Coach'): ?>
                                                        <input type="hidden" name="coach_id" value="{{ $dataTypeContent->{$row->field} ?? old($row->field) ?? $options->default ?? Auth::user()->id }}" />
                                                        <?php else: ?>
                                                        @include('voyager::formfields.relationship', ['options' => $row->details])
                                                        <?php endif ?>
                                                    @elseif($row->display_name == 'Period')
                                                        <input type="hidden" name="period" value="{{ $dataTypeContent->{$row->field} }}" />
                                                        {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                                    @else
                                                        {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                                    @endif

                                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                                        {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                                    @endforeach
                                                    @if ($errors->has($row->field))
                                                        @foreach ($errors->get($row->field) as $error)
                                                            <span class="help-block">{{ $error }}</span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <?php if (!$edit) : ?>
                                                    <?php if ($row->field == "video") : ?>
                                                        <div class="form-group col-md-12 ">
                                                            <label class="control-label" for="name">Video</label>
                                                            <input type="file" class="form-control" name="video"value="">
                                                        </div>
                                                    <?php elseif ($row->field == "attachment") : ?>
                                                        <div class="form-group col-md-12 ">
                                                            <label class="control-label" for="name">Attachment</label>
                                                            <input type="file" class="form-control" name="attachment"value="">
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            @endforeach
                                        </div>
                                    @else
                                        @php
                                        $extraMID = "";
                                        $name = "";
                                        $video = "";
                                        $attach = "";
                                        if ($edit) {
                                            $c = $i - 2;
                                            $video = $children[$c]->video ?? "";
                                            $attach = $children[$c]->attachment ?? "";
                                            $name = $children[$c]->name ?? "";
                                        }
                                        @endphp
                                        <div id="tab<?= $i ?>" class="tab-pane fade">
                                            <input type="hidden" name="model-id<?= $i ?>" value="<?= $extraMID ?>">
                                            <div class="form-group col-md-12 ">
                                                <label class="control-label" for="name">Name</label>
                                                <input type="text" class="form-control" name="name<?= $i ?>" placeholder="Name" value="<?= $name ?>">
                                            </div>
                                            <div class="form-group col-md-12 ">
                                                <label class="control-label" for="name">Video <?= $i ?></label>
                                                <div data-field-name="video">
                                                    <a class="fileType" target="_blank" href="https://www2.bettertrend.net/storage/events/videos/<?= $video ?>" data-file-name="[]" data-id="3">&gt;
                                                        Download <?= $video ?>
                                                    </a>
                                                    <!-- <a href="#" class="voyager-x remove-single-file"></a> -->
                                                </div>
                                                <input type="file" name="video<?= $i ?>">
                                            </div>
                                            <div class="form-group col-md-12 ">
                                                <label class="control-label" for="name">Attachment <?= $i ?></label>
                                                <div data-field-name="attachment">
                                                    <a class="fileType" target="_blank" href="https://www2.bettertrend.net/storage/events/<?= $attach ?>" data-file-name="[]" data-id="3">&gt;
                                                        Download <?= $attach ?>
                                                    </a>
                                                    <!-- <a href="#" class="voyager-x remove-single-file"></a> -->
                                                </div>
                                                <input type="file" name="attachment<?= $i ?>">
                                            </div>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
            return function() {
                $file = $(this).siblings(tag);

                params = {
                    slug:   '{{ $dataType->slug }}',
                    filename:  $file.data('file-name'),
                    id:     $file.data('id'),
                    field:  $file.parent().data('field-name'),
                    multi: isMulti,
                    _token: '{{ csrf_token() }}'
                }

                $('.confirm_delete_name').text(params.filename);
                $('#confirm_delete_modal').modal('show');
            };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            $('.form-group input[name=start_date]').datetimepicker({
                format: 'YYYY-MM-DD'
            }).on('dp.change', function(e) {
                var $this = $(this);
                var startDate = $this.val();
                var endDate = $('.form-group input[name=end_date]').val();

                var startDay = new Date(endDate);
                var endDay = new Date(startDate);
                var millisecondsPerDay = 1000 * 60 * 60 * 24;
                var millisBetween = startDay.getTime() - endDay.getTime();
                var days = millisBetween / millisecondsPerDay;

                if (endDate != '' && days > -1) {
                    $('.form-group input[name=period]').val(days);
                } else {
                    $('.form-group input[name=period]').val(0);
                }


            });

            $('.form-group input[name=end_date]').datetimepicker({
                format: 'YYYY-MM-DD'
            }).on('dp.change', function(e) {

                var $this = $(this);
                var startDate = $('.form-group input[name=start_date]').val();
                var endDate = $this.val();

                var startDay = new Date(endDate);
                var endDay = new Date(startDate);
                var millisecondsPerDay = 1000 * 60 * 60 * 24;
                var millisBetween = startDay.getTime() - endDay.getTime();
                var days = millisBetween / millisecondsPerDay;

                if (startDate != '' && days > -1) {
                    $('.form-group input[name=period]').val(days);
                } else {
                    $('.form-group input[name=period]').val(0);
                }


            });

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
