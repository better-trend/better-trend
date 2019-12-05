<?php use App\User; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
    <!-- Start main-content -->
    <style>
        p {
            font-size: 20px;
            font-weight: bold;
        }
        label {
            font-size: 16px;
        }
    </style>
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" style="height: 60%;"
                 data-bg-img="/frontend/_assets/images/breadcrumb-bg.png">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb text-right text-black mb-0 mt-40">
                                <li><a href="{{ lang_url('') }}">@t('Home')</a></li>
                                <li><a href="{{ lang_url('all_purchases') }}">@t('My purchases')</a></li>
                                <li class="active text-gray-silver">@t('Billing details')</li>
                            </ol>
                            <h2 class="title text-white">@t('Billing details')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row">
                <div class="col-sm-12" style="margin-top: 20px">
                       <a href="{{ url()->previous() }}" style='<?= (request()->segments()[0] == "ar" ? "float: right!important" : "float:left!important") ?>' class="btn btn-dark btn-xl btn-blue"><i class="<?= request()->segments()[0] == "en" ? "fa fa-backward" : "fa fa-forward" ?>" aria-hidden="true"></i></a>
               </div>
               <div class="col-sm-12" style="margin-top: 20px">
                    <?php $props = json_encode($order->getAttributes()) ?>
                    <a class="btn btn-primary" href="<?= Url::to("/")."/storage/bills/".session()->getId()."/bill.pdf" ?>" onclick="createPDF()" download>@t('Download details')</a>
                </div>
           </div>
       </div>

        @if($type == 1)
        <?php $product = \App\ProductsNative::find($order->product_native_id) ?>

        <section>
            <div class="container" style="padding-top: 15px">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>@t('Billing details')</h2>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Date'):</label>
                        <p>{{ $order->created_at }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Transaction #'):</label>
                        <p>{{ $order->id }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('First name'):</label>
                        <p>{{ $order->user_name }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Last name'):</label>
                        <p>{{ $order->user_last_name }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Address'):</label>
                        <p>{{ $order->user_address }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Quantity'):</label>
                        <p>{{ $order->product_quantity }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Product Price'):</label>
                        <p>SAR&nbsp;{{ $order->product_price }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <?php 
                            $priceBeforeDisc = ($order->product_price * $order->product_quantity) + $order->tax + $order->shipping;
                        ?>
                        <label>@t('Discount'):</label>
                        <p>SAR&nbsp;<?= $priceBeforeDisc - $order->total_price ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Shipping Fees'):</label>
                        <p>SAR <?= $product->shipping_fee ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Tax'):</label>
                        <p>SAR <?= $product->tax ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Total Price'):</label>
                        <p>SAR&nbsp;{{ $order->total_price }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Payment Transaction #'):</label>
                        <p>15</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Payment Method'):</label>
                        <p>@t('Online Payment')</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Shipment Company'):</label>
                        <p></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Shipment Tracking Number'):</label>
                        <p>1234</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Shipment Status'):</label>
                        <p></p>
                    </div>
                </div>
            </div>
        </section>

        @elseif($type == 2)
        <?php $school = \App\School::find($order->school_id); ?>
        <section>
            <div class="container" style="padding-top: 15px">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>@t('Package details')</h2>
                    </div>
                </div>
                <hr>
                @if($school)
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('School'):</label>
                        <p>{{ $school->name }}</p>
                    </div>
                </div>
                @endif
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Package'):</label>
                        <p>{{ $order->package_name }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Price'):</label>
                        <p>{{ $order->package_price }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Start'):</label>
                        <p>{{ $order->package_start_date }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('End'):</label>
                        <p>{{ $order->package_end_date }}</p>
                    </div>
                </div>
            </div>
        </section>

        @else

        <?php 
        $event = \App\Event::find($order->event_id);
        $coach = \App\User::find($order->coach_id);
         ?>
        <section>
            <div class="container" style="padding-top: 15px">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>@t('Details')</h2>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Name'):</label>
                        <p>{{ $event->name }} ({{ $order->name }})</p>
                    </div>
                </div>
                <hr>
                @if($coach)
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Coach'):</label>
                        <p>{{ $coach->name }}</p>
                    </div>
                </div>
                <hr>
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <label>@t('Description'):</label>
                        <p>{{ $order->description }}</p>
                    </div>
                </div>
            </div>
        </section>

        @endif
        <!-- Divider: about -->
    </div>
@stop
<script type="text/javascript">
    function createPDF() {
        $.post(
            '<?= lang_url('createPDF') ?>',
            {
                data: <?= json_encode($order->getAttributes()) ?>,
                "_token": "{{ csrf_token() }}",
            }
        )
        .done(function(result) {
            console.log(result)
        })
    }
</script>