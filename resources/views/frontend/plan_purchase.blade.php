<?php use App\UserSubscription; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<?php $bought = false ?>
<!-- Start main-content -->
<div class="main-content">
   <!-- Section: inner-header -->
   <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="/frontend/_assets/images/breadcrumb-bg.png">
      <div class="container pt-70 pb-20">
         <!-- Section Content -->
         <div class="section-content">
            <div class="row">
               <div class="col-md-12">
                  <ol class="breadcrumb text-right text-black mb-0 mt-40">
                        <li><a href="{{ lang_url('') }}">@t('Home')</a></li>
                        <li><a href="{{ url()->previous() }}">@t('Packages')</a></li>
                        <li class="active text-gray-silver"> / {{ $plan_name }}</li>
                  </ol>
                  <h2 class="title text-white">{{$plan_name}}</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: about -->
    <div class="row">
        <div class="col-sm-6 col-sm-offset-2">
            <a style="
                padding: 5px 10px;
                background-color: #41a161 !important;
                margin-top: 20px;
                display: block;
                width: 220px;
                text-align: center;
                font-size: 15px;
                border-radius: 3px;
                " href="{{ lang_url('plans_pricing') }}">@t('Back to Membership Pages')</a>
        </div>
    </div>
   <section class="divider">
      <div class="container">
         <div class="row pt-30 <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?>">
            <div class="col-md-12">
               <form id="buy_plan_school" name="buy_plan_school" class="form-inline" action="{{ lang_url('buy_plan_school') }}" method="post">
                  @csrf
                  <?php
                     $date = date("Y-m-d");// current date
                     if ($no == '1') {
                        $period = '';

                     } else if ($no == '2') {
                        $period = '+1 year';

                     } else if ($no == '3') {
                        $period = '+1 month';

                     } else if ($no == '4') {
                        $period = '+1 week';
                     }
                     $plan = \App\SchoolPlan::find($planId);
                     $time = date("Y-m-d", strtotime($date. " + {$plan->duration} days"));                  
                     ?>
                  @if(session()->has('error'))
                  <div class="alert alert-red">
                     <ul class="list-unstyled mb-0">
                        <li class="text-white">{!! session()->get('error') !!}</li>
                     </ul>
                  </div>
                  @endif
                  <input type="hidden" name="plan_name" value="{{ $plan_name }}" />
                  <input type="hidden" name="no" value="{{ $no }}" />
                  <input type="hidden" class="total_price_hidden" name="price" value="{{ $price }}" />
                  <input type="hidden" name="package_start_date" value="{{ date('Y-m-d h:i:s') }}" />
                  <input type="hidden" name="package_end_date" value="{{ $time }}" />
                  <div class="row">
                     <div class="col-md-10 col-sm-12 col-md-offset-1">
                        <?php if ($schoolNative): ?>
                        <div class="col-sm-12 p-0">
                           <div class="form-group mb-30">
                              <label for="school_name" style="font-size: 18px">@t('School')</label>
                               <?php
                                   if ($schoolNumber == 1) {
                                       $multiple = "" ;
                                       $name = "school";
                                   } elseif ($schoolNumber > 1) {
                                       $multiple = "multiple" ;
                                       $name = "school[]";
                                   }
                                ?>

                              <select class="form-control" <?= $multiple ?> id="school_name" name="<?= $name ?>">
                                 <?php foreach ($schoolNative as $key => $school): ?>
                                    <?php
                                    $alreadySubscribed = UserSubscription::where([['user_id', Auth::user()->id],['school_id', $school->schools->id],['status', 'active'], ['package_name', $plan->name]])->first(); 
                                    $schoolSubscriptions = UserSubscription::where([['user_id', Auth::user()->id],['school_id', $school->schools->id],['status', 'active']])->get();
                                    foreach ($schoolSubscriptions as $sub) {
                                     	$planModel = \App\SchoolPlan::where("name", "=", $sub->package_name)->first();
                                     	if ($plan->priority < $planModel->priority) {
		                                    $alreadySubscribed = false;
		                                } else {
		                                    $alreadySubscribed = true;
		                                }
                                     } 
                                    ?>
                                    <?php if (!$alreadySubscribed) : ?>
                                        <?php $bought = true ?>
                                        <option class="sc-option" value="{{ $school->schools->id }}">{{ $school->name }}</option>
                                    <?php else : ?>
                                        <?php
                                         $isRecord = UserSubscription::where([["school_id", $school->schools->id],["user_id", Auth::user()->id]])->first();
                                         if (!$isRecord) {
                                         ?>
                                     <option class="sc-option" value="{{ $school->schools->id }}">{{ $school->name }}</option>
                                        <?php
                                         }
                                        ?>
                                    <?php endif; ?>
                                 <?php endforeach ?>
                              </select>
                           </div>
                        </div>
                        <?php endif ?>
                        <div class="col-sm-12 p-0 mb-20">
                          <label for="couponCode" style="font-size: 18px">@t('Coupon code')</label>
                          <input value="{{ old('couponCode') }}" data-plan_id="{{ $planId }}" type="text" class="form-control couponCode" name="couponCode" style="width: 68%;">
                          <button type="button" class="btn btn-success apply_code" style="display: inline-block;">@t('Apply code')</button>
                          <img src="\public\loading.gif" class="loader_coupen mr-1 ml-1">
                          <span class="text-danger coupen_error" style="font-size: 18px">@t('Coupen expire or Invalid')</span>
                          <input type="hidden" name="coupen_status" class="coupen_status" value="0" />
                          <input type="hidden" name="discount_perc" class="discount_perc" value="0" />
                          <input type="hidden" class="user_id" name="user_id" value="{{ Auth::check() ? Auth::user()->id : NULL }}" />
                        </div>
                            <?php $plan = \App\SchoolPlan::find($planId); ?>
                        <div class="row">
                            <div class="col-sm-2" style="font-size: 18px">@t('Description')</div>
                            <div class="col-sm-10"><?= $plan->description ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2" style="font-size: 18px">@t('Advantages')</div>
                            <div class="col-sm-10"><?= $plan->advantages ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2" style="font-size: 18px">@t('Duration')</div>
                            <div class="col-sm-10"><?= $plan->duration?>&nbsp;@t('Days')</div>
                        </div>
                            @if($bought)
                              <div class="row">
                                  <div class="col-sm-2" style="font-size: 18px">@t('Price')</div>
                                  <div class="col-sm-10 text-theme-colored" id="price-wrapper" style="display: inline-block;font-size: 20px; width: auto"><?= $plan->price ?></div>
                                  <span style="position: relative;
                                              font-size: 20px;
                                              left: -12px;
                                              color: #41a161 !important;">$</span>
                              </div>
                              <div class="row">
                                  <div class="col-sm-2" style="font-size: 18px">@t('Discount')</div>
                                  <div class="col-sm-10 text-theme-colored" id="disc-wrapper" style="display: inline-block;font-size: 20px; width: auto"><?= $plan->discount ?? 0 ?></div>
                                  <span style="position: relative;
                                              font-size: 20px;
                                              left: -12px;
                                              color: #41a161 !important;">$</span>
                              </div>
                              <div class="row">
                                  <div class="col-sm-2" style="font-size: 18px">@t('Tax')</div>
                                  <div class="col-sm-10 text-theme-colored" id="tax-wrapper" style="display: inline-block;font-size: 20px; width: auto"><?= $plan->tax ?? 0 ?></div>
                                  <span style="position: relative;
                                              font-size: 20px;
                                              left: -12px;
                                              color: #41a161 !important;">$</span>
                              </div>
                              <div class="row">
                                  <div class="col-sm-2" style="font-size: 18px">@t('Shipment Fees')</div>
                                  <div class="col-sm-10 text-theme-colored" id="fee-wrapper" style="display: inline-block;font-size: 20px; width: auto"><?= $plan->shipment_fee ?? 0 ?></div>
                                  <span style="position: relative;
                                              font-size: 20px;
                                              left: -12px;
                                              color: #41a161 !important;">$</span>
                              </div>
                              <div class="row">
                                  <div class="col-sm-2" style="font-size: 18px">@t('Total Price')</div>
                                  <div class="col-sm-10 text-theme-colored" id="total-price" style="display: inline-block;font-size: 20px; width: auto"><?= $plan->price - ($plan->discount ?? 0) + ($plan->tax ?? 0) + ($plan->shipment_fee ?? 0) ?></div>
                                  <span style="position: relative;
                                              font-size: 20px;
                                              left: -12px;
                                              color: #41a161 !important;">$</span>
                              </div>
                            @endif
                        {{--<div class="form-group form-group-center text-center mb-30 mt-20">
                           <input name="form_botcheck" class="form-control" type="hidden" value="">
                           <button type="submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">@t('Buy a package')</button>
                        </div>--}}
                            <?php if (!Auth::guest() && $bought) : ?>
                            <div class="container" style="padding-top: 10px">
                                <div class="section-content">
                                    <div class="row <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?>">
                                        <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12">
                                            <div class="col-xs-12 col-sm-6 col-md-6 hvr-float-shadow mb-sm-30">
                                                <div class="pricing-table maxwidth400">
                                                </div>
                                                <div class=" bg-white border-1px p-30 pt-20 pb-20">
                                                    <img src="/frontend/_assets/images/payment-1.jpg" alt="">
                                                </div>
                                                <a data-toggle="modal" data-target="#pay-modal" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">@t('Wire/Transfer Cash Payment')</a>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6 hvr-float-shadow mb-sm-30">
                                                <div class="pricing-table maxwidth400">
                                                </div>
                                                <div class=" bg-white border-1px p-30 pt-20 pb-20">
                                                    <img src="/frontend/_assets/images/payment-2.jpg" alt="">
                                                </div>
                                                <a data-toggle="modal" data-target="#pay-modal" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">@t('Online Payment')</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->

<div class="modal fade" id="pay-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p class="color-dark-green">@t('form_fill') </p>
                <p class="text-gray mb-0">@t('Bank information:')</p>
                <p class="text-gray mb-0">@t('Bank name:') <span>@t(' البنك الاول')</span></p>
                <p class="text-gray mb-0">@t('Account number:') <span>@t(' 33333333332323')</span></p>
                <p class="text-gray mb-0">@t('IBAN NO') <span>@t(' sasasasasasasas')</span></p>
            </div>
            <div class="modal-body">
                <!-- add new job Form -->
                {{--<form name="checkoutForm" id="checkoutForm"  class="form-inline" action="{{ lang_url('checkout_post') }}" method="post">--}}
                <form name="checkoutForm" id="checkoutForm"  class="form-inline" action="{{ lang_url('buy_plan_school') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="col-sm-12 p-0">
                                <div class="form-group mb-30">
                                    <label for="first_name">@t('Name')</label>
                                    <input id="first_name" name="first_name" class="form-control" type="text" placeholder="@t('Name')" required="" value="{{ Auth::check() ? Auth::user()-> name : '' }}" aria-required="true">
                                </div>
                            </div>
                            <div class="col-sm-12 p-0">
                                <div class="form-group mb-30">
                                    <label for="last_name">@t('Last Name')</label>
                                    <input id="last_name" name="last_name" class="form-control" type="text" placeholder="@t('Last Name')" required="" aria-required="true" value="{{ Auth::check() ? Auth::user()->last_name : '' }}">
                                </div>
                            </div>
                            <div class="col-sm-12 p-0">
                                <div class="form-group mb-30">
                                    <label for="user_address">@t('Address')</label>
                                    <input id="user_address" name="user_address" class="form-control" type="text" placeholder="@t('Address')" required="" aria-required="true" value="{{ Auth::check() ? Auth::user()->location : '' }}">
                                </div>
                            </div>
                            <div class="col-sm-12 p-0 mb-20">
                                <h6 class="my-0 quantity-h">@t('Quantity')</h6>
                                <div class="qty-changer form-group">
                                    <button type="button" class="qty-change minus btn btn-danger">-</button>
                                    <input class="qty-input form-control" name="qty-input" type="number" min="1" value="1" readonly>
                                    <button type="button" class="qty-change plus btn btn-success">+</button>
                                </div>
                            </div>
                            <div class="col-sm-12 p-0">
                                <div class="form-group mb-30">
                                    <label for="account_number">@t('Account Number')</label>
                                    <input id="account_number" name="account_number" class="form-control" type="text" placeholder="@t('Account Number')" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="col-sm-12 p-0">
                                <div class="form-group mb-30">
                                    <label for="phone">@t('Phone')</label>
                                    <input id="phone" name="phone" class="form-control" type="text" placeholder="@t('Phone')" required="" aria-required="true" value="{{ Auth::check() ? Auth::user()->phone : '' }}">
                                </div>
                            </div>
                            <div class="col-sm-12 p-0">
                                <div class="form-group mb-30">
                                    <label for="email">@t('Email')</label>
                                    <input id="email" name="email" class="form-control" type="email" placeholder="@t('Email')" required="" aria-required="true" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                </div>
                            </div>

                            <div class="col-sm-12 p-0 mb-20">
                                <label for="couponCode">@t('Coupon')</label>
                                <input value="{{ old('couponCode') }}" data-product_native_id="{{ $plan->id }}" type="text" class="form-control couponCode" name="couponCode" style="width: 60%;">
                                <button type="button" class="btn btn-success apply_code" style="display: inline-block;">@t('Apply code')</button>
                                <img src="\public\loading.gif" class="loader_coupen mr-1 ml-1">
                                <span class="text-danger coupen_error">@t('Coupen expire or Invalid')</span>
                                <input type="hidden" name="coupen_status" class="coupen_status" value="0" />
                                <input type="hidden" name="discount_perc" class="discount_perc" value="0" />
                                <input type="hidden" class="user_id" name="user_id" value="{{ Auth::check() ? Auth::user()->id : NULL }}" />
                            </div>

                            <div class="col-sm-12 list-group-item d-flex justify-content-between ">
                                <h6 class="my-0">@t('Price')</h6>
                                <input type="hidden" name="actual_price" class="actual_price" value="{{ $plan->price}}" />
                                <span class="form-group text-muted total_price"><strong>$ <span class="total_price_">{{ $plan->price }} </span></strong></span>
                                <input type="hidden" name="product_price" class="book_price_main" value="{{ $plan->price }}">
                                <input class="total_price_hidden" name="total_price_hidden" type="hidden" value="{{ $plan->price }}">
                                <input name="product_native_id" type="hidden" value="{{ $plan->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center mb-30">
                        {{--<button type="submit" class="btn btn-dark btn-flat btn-theme-green">@t('طلب المنتج')</button>--}}
                        <button type="button" onclick="$('#buy_plan_school').submit()" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">@t('Buy a package')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
  $(document).ready(function() {

      $(".sc-option").on('click', function () {
         let selectedCount = $(".sc-option:selected").length
          if (selectedCount >= "<?= $maxSchools ?>") {
             $(this).attr("selected", false)
         }
      })

      $('.apply_code').on('click', function(e) {
        e.preventDefault();
        var $this = $('.couponCode'),
            coupenCode = $this.val() != "" ? $this.val() : $this.eq(1).val(),
            object_id = $this.attr('data-plan_id'),
            object_type = '2';

            if (coupenCode != '') {

              $('.loader_coupen').show();

              $.ajax({
                    type: 'POST',
                    url: '{{ lang_url("coupenCheck") }}',
                    data: {"_token": "{{ csrf_token() }}", 'object_type':object_type, 'coupenCode':coupenCode, 'object_id':object_id},
                })
                .done(function(response) {
                  $('.loader_coupen').hide();
                  if (response == '0') {
                    $('.coupen_error').show();
                    $('.discount_perc').val('0');
                    $('.total_price_hidden').val('${{ $price }}');
                    $('.total_price_').val('${{ $price }}');
                  } else {
                    $('.coupen_error').hide();
                    $('.total_price_hidden').val(response['discountedPrice']);
                    $('.total_price_').val('$'+response['discountedPrice']);
                    $('.discount_perc').val(response['discount']);
                    let dsc = parseFloat($("#price-wrapper").text()) * ( parseInt($('#disc-wrapper').text()) / 100 )
                    $('#disc-wrapper').text(parseFloat($("#price-wrapper").text()) - parseFloat(dsc))
                    let t = parseFloat($("#price-wrapper").text()) - parseFloat($("#disc-wrapper").text()) + parseFloat($("#tax-wrapper").text()) + parseFloat($("#fee-wrapper").text())
                    $('#total-price').text(t)   
                    $('.total_price_').text(t)
                    $this.val(coupenCode)
                    if ($this.eq(1))
                      $this.eq(1).val(coupenCode)
                  }

                });
            } else {
              $('.loader_coupen').hide();
              $('.coupen_error').hide();
              $('.discount_perc').val('0');
              $('.total_price_hidden').val('${{ $price }}');
              $('.total_price_').val('${{ $price }}');
            }

      });
   });
</script>
@endpush
@stop