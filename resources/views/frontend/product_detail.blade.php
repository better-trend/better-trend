@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
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
                     <li><a href="{{ lang_url('book') }}">@t('Books')</a></li>
                     <li class="active text-gray-silver"><?= $title ?></li>
                  </ol>
                  <h2 class="title text-white"><?= $title ?></h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: profile -->
    <div class="row">
        <div class="col-sm-6 col-sm-offset-2">
            <a style="
                padding: 5px 10px;
                background-color: #41a161 !important;
                margin-top: 20px;
                display: block;
                width: 180px;
                text-align: center;
                font-size: 15px;
                border-radius: 3px;
                " href="{{ lang_url('books') }}">@t('Back to Books')</a>
        </div>
    </div>
   <section class="divider">
      <div class="container" style="padding-bottom: 10px">
         <div class="row">
            <div class="col-md-10 col-md-offset-1">
               <div class="blog-posts single-post">
                  <article class="post clearfix mb-0">
                     <div class="entry-header">
                        <div class="post-thumb thumb"> <img src="\public\storage\{{ $productDecode->thumbnail }}" alt="{{ $productDecode->name }}" class="img-responsive img-fullwidth"> </div>
                     </div>
                     <div class="col-md-12 col-sm-12 text-center">
                        <div class="entry-title pt-10 pl-15 text-center">
                           <h4 class="color-theme-green font-weight-600" style="font-size: 35px">{{ $productDecode->name }} </h4>
                        </div>
                        <div class="entry-content mt-10">
                           <p class="mb-15">{!! $productDecode->long_description !!}</p>
                        </div>
                        <?php if ($productDecode->product_url) : ?>
                          <div class="entry-content mt-10">
                             <p class="mb-15" style="font-size: 17px"><strong>@t('Information'):</strong> <a target="_blank" href="{{ $productDecode->product_url }}"><span class="color-theme-green">{{ $productDecode->product_url }}</span></a></p>
                          </div>
                        <?php endif; ?>
                        <div class="entry-content mt-10">
                           <p class="mb-15" style="font-size: 17px"><strong>@t('Price'):</strong> SR {{ $productDecode->price }}</span></p>
                        </div>
                        <div class="entry-content mt-10">
                           <p class="mb-15" style="font-size: 17px"><strong>@t('Tax'):</strong> SR {{ $productDecode->tax }}</span></p>
                        </div>
                        <div class="entry-content mt-10">
                           <p class="mb-15" style="font-size: 17px"><strong>@t('Shipping fee'):</strong> SR {{ $productDecode->shipping_fee }}</span></p>
                        </div>
                        <div class="entry-content mt-10">
                           <p class="mb-15" style="font-size: 17px"><strong>@t('Total Price'):</strong> SR {{ $productDecode->shipping_fee + $productDecode->tax + $productDecode->price}}</span></p>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </article>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section>
       <?php
       $pr_id = request()->segments()[2];
       $product = \App\ProductsNative::find($pr_id);
       $hasOrder = false;
       if (Auth::user()) {
          $hasOrder = \App\Order::where([["product_native_id", $pr_id], ["user_id", Auth::user()->id]])->first();
       }
       ?>
       <?php if ($hasOrder && $product->product_id == 5) : ?>
       <div class="container" style="padding-top: 10px">
           <div class="section-content">
               <div class="col-sm-12 text-center" style="margin-top: -70px">
                   <a style="
                            color: white;
                            font-size: 30px;
                            border: 2px solid #03a84e;
                            background-color: #03a84e;
                            padding: 10px 40px 15px 40px;
                            border-radius: 5px;
                    " href="/storage/products-native/<?= $product->e_book ?>" download="{{$product->name}}.pdf">
                       @t('Download your tool')
                   </a>
               </div>
           </div>
       </div>
       <?php endif; ?>
       <?php if (/*!$hasOrder && */!Auth::guest()) : ?>
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
   </section>
</div>
<!-- end main-content -->
<!-- ADD NEW JOB MODAL -->
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
            <form name="checkoutForm" id="checkoutForm"  class="form-inline" action="{{ lang_url('checkout_post') }}" method="post">
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
                           <label for="last_name">@t('Last name')</label>
                           <input id="last_name" name="last_name" class="form-control" type="text" placeholder="@t('Last name')" required="" aria-required="true" value="{{ Auth::check() ? Auth::user()->last_name : '' }}">
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
                           <label for="account_number">@t('account number')</label>
                           <input id="account_number" name="account_number" class="form-control" type="text" placeholder="@t('account number')" required="" aria-required="true">
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
                       <input value="{{ old('couponCode') }}" data-product_native_id="{{ $productDecode->id }}" type="text" class="form-control couponCode" name="couponCode" style="width: 60%;">
                       <button type="button" class="btn btn-success apply_code" style="display: inline-block;">@t('Apply code')</button>
                       <img src="\public\loading.gif" class="loader_coupen mr-1 ml-1">
                       <span class="text-danger coupen_error">@t('Coupen expire or Invalid')</span>
                       <input type="hidden" name="coupen_status" class="coupen_status" value="0" />
                       <input type="hidden" name="discount_perc" class="discount_perc" value="0" />
                       <input type="hidden" class="user_id" name="user_id" value="{{ Auth::check() ? Auth::user()->id : NULL }}" />
                     </div>

                     <div class="col-sm-12 list-group-item d-flex justify-content-between ">
                        <h3 class="my-0">@t('Price')</h6>
                        <input type="hidden" name="actual_price" class="actual_price" value="{{ $productDecode->price}}" />
                        <span class="form-group text-muted total_price" style="font-size: 15px"><strong>SR <span class="total_price_">{{ $productDecode->price}} </span></strong></span>
                        <h3 class="my-0 show-disc" style="display: none">@t('Discount')</h6>
                        <input type="hidden" style="display: none" name="discount_price" class="discount_price show-disc" value="" />
                        <span style="display: none" class="show-disc form-group text-muted discount_price" style="font-size: 15px"><strong>SR <span class="discount_">{{ $productDecode->price}} </span></strong></span>
                        <h3 class="my-0">@t('Tax')</h6>
                        <input type="hidden" name="tax_price" class="tax_price" value="{{ $productDecode->tax}}" />
                        <span class="form-group text-muted tax" style="font-size: 15px"><strong>SR <span class="tax_">{{ $productDecode->tax}} </span></strong></span>
                        <h3 class="my-0">@t('Shipping fee')</h6>
                        <input type="hidden" name="shipping_price" class="shipping_price" value="{{ $productDecode->shipping_fee}}" />
                        <span class="form-group text-muted shipping_fee" style="font-size: 15px"><strong>SR <span class="shipping_fee_">{{ $productDecode->shipping_fee}} </span></strong></span>
                        <input type="hidden" name="product_price" class="book_price_main" value="{{ $productDecode->price }}">
                        <input class="total_price_hidden" name="total_price_hidden" type="hidden" value="{{ $productDecode->price + $productDecode->tax + $product->shipping_fee }}">
                        <input name="product_native_id" type="hidden" value="{{ $productDecode->id }}">
                        <h3 class="my-0">@t('Total Price')</h6>
                        <span class="form-group text-muted shipping_fee" style="font-size: 15px"><strong>SR <span class="total_price_">{{ $productDecode->shipping_fee + $productDecode->tax + $productDecode->price }} </span></strong></span>
                     </div>
                  </div>
               </div>
               <div class="modal-footer text-center mb-30">
                  <button type="submit" class="btn btn-dark btn-flat btn-theme-green">@t('Checkout')</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@push('scripts')
<script>
  $(document).ready(function() {
     var quantitiy = 0;

     var price = $('.book_price_main').val();

     $('button.qty-change.plus').click(function (e) {
       e.preventDefault();

       var quantity = parseFloat($('input.qty-input.form-control').val());



       $('input.qty-input.form-control').val(quantity + 1);

       var quantity_exact = $('input.qty-input.form-control').val();
       var myResult = quantity_exact * price;

       var discount = $('.discount_perc').val();
       if (discount != '0') {
        var myResult = (myResult * parseInt(discount))/ 100;
       }

       $('.total_price span').text(myResult);
       $('.total_price_hidden').val(myResult);
    });

     $('button.qty-change.minus').click(function (e) {
       e.preventDefault();

       var quantity = parseFloat($('input.qty-input.form-control').val());

       if (quantity > 1) {
         $('input.qty-input.form-control').val(quantity - 1);
       }

       var quantity_exact = $('input.qty-input.form-control').val();

       var myResult = quantity_exact * price;

       var discount = $('.discount_perc').val();
       if (discount != '0') {
        var myResult = (myResult * parseInt(discount))/ 100;
       }


       $('.total_price span').text(myResult);
       $('.total_price_hidden').val(myResult);
     });



     $('.apply_code').on('click', function(e) {
       e.preventDefault();
       var $this = $('.couponCode'),
           coupenCode = $this.val(),
           user_id = $('.user_id').val(),
           object_id = $this.attr('data-product_native_id'),
           object_type = '1',
           qty_input = $('.qty-input').val(),
           tax = parseFloat($(".tax_").text()),
           shippment = parseFloat($(".shipping_fee_").text())

           if (coupenCode != '') {

             $('.loader_coupen').show();

             $.ajax({
                   type: 'POST',
                   url: '{{ lang_url("coupenCheck") }}',
                   data: {"_token": "{{ csrf_token() }}", 'object_type':object_type, 'user_id':user_id, 'coupenCode':coupenCode, 'object_id':object_id, 'qty_input':qty_input},
               })
               .done(function(response) {
                 $('.loader_coupen').hide();
                 if (response == '0') {
                   $('.coupen_error').show();
                   $('.discount_perc').val('0');
                   $('.total_price_hidden').val((parseInt($('.actual_price').val()) * parseInt(qty_input)) + tax + shippment);
                   $('.total_price_:eq(1)').text((parseInt($('.actual_price').val()) * parseInt(qty_input)) + tax + shippment);

                 } else {
                   $('.coupen_error').hide();
                   $('.show-disc').show()
                   $('.discount_').text(parseFloat($('.total_price_:eq(0)').text()) - parseFloat(response['discountedPrice']))
                   $('.total_price_hidden').val(parseFloat(response['discountedPrice']) + tax + shippment);
                   $('.total_price_:eq(1)').text(parseFloat(response['discountedPrice']) + tax + shippment);
                   $('.discount_perc').val(response['discount']);
                 }

               });


           } else {

             $('.loader_coupen').hide();
             $('.coupen_error').hide();
             $('.discount_perc').val('0');
             $('.total_price_hidden').val(parseInt($('.actual_price').val()) * parseInt(qty_input));
             $('.total_price_').text(parseInt($('.actual_price').val()) * parseInt(qty_input));

           }

     });
  });
</script>
@endpush

@stop
