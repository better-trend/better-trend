<?php 
use App\UserSubscription;
?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<?php $my_subscriptions = UserSubscription::where('user_id', Auth::user()->id)->get(); ?>
<?php 
$training_activities = DB::table('course_subscriptions')
                ->join('events', 'course_subscriptions.event_id', '=', 'events.id')
                ->join('events_natives', 'events_natives.event_id', '=', 'events.id')
                ->select('course_subscriptions.*', 'events.*', 'events_natives.*', 'course_subscriptions.id AS subscriptionID')
                ->where([['course_subscriptions.user_id', Auth::user()->id], ['course_subscriptions.status', 'active'], ['events_natives.lang', $langCode]])
                ->orderBy('course_subscriptions.id', 'DESC')
                ->get();
?>
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
                     <li><a href="{{ lang_url('profile') }}">@t('Profile')</a></li>
                     <li class="active text-gray-silver">@t('My purchases')</li>
                  </ol>
                  <h2 class="title text-white">@t('My purchases')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="divider bg-white">
      <div class="container">
         <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
               <div class="vertical-tab">
                  <ul class="nav nav-tabs">
                     <li><a class="d-block" href="{{ lang_url('profile') }}" ><img src="/frontend/_assets/images/icon-1.png" class="img-responsive" alt="icon-1"/>@t('Profile personly')</a></li>
                     <li class="active"><a class="d-block" href="{{ lang_url('all_purchases') }}" ><img src="/frontend/_assets/images/icon-2.png" class="img-responsive" alt="icon-2"/>@t('My purchases') </a></li>
                     <li><a class="d-block" href="{{ lang_url('all_subscriptions') }}" ><img src="/frontend/_assets/images/icon-3.png" class="img-responsive" alt="icon-3"/>@t('My Packages') </a></li>
                     <li><a class="d-block" href="{{ lang_url('schools') }}" ><img src="/frontend/_assets/images/icon-4.png" class="img-responsive" alt="icon-4"/> @t('Electronic School')</a></li>
                     <li><a class="d-block" href="{{ lang_url('training_activities') }}" ><img src="/frontend/_assets/images/icon-5.png" class="img-responsive" alt="icon-5"/>@t('Training activities') </a></li>
                     <li><a class="d-block" href="{{ lang_url('communication') }}" ><img src="/frontend/_assets/images/icon-6.png" class="img-responsive" alt="icon-6"/> @t('Communication') </a></li>
                     <li><a class="d-block" href="{{ lang_url('logout_frontend') }}"><img src="/frontend/_assets/images/icon-7.png" class="img-responsive" alt="icon-7"/>@t('Exit') </a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
               <div class="tab-content">
                  <div class="tab-pane fade in active " id="tab2">
                     <div class="row mb-30">
                        <div class="col-md-12">
                           <a href="{{ lang_url('books') }}" class="btn btn-dark btn-xl btn-blue pull-left"><i class="fa fa-plus ml-10"></i>&nbsp;@t('Product Review')</a>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="table-responsive table-condensed">
                              <table class="table  sub-table">
                                 <thead>
                                    <tr>
                                       <th>@t('The date of purchase')</th>
                                       <th>@t('the product')</th>
                                       <th>@t('the amount')</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @if($all_purchases)
                                       @foreach($all_purchases as $purchase)
                                       <tr>
                                          <td class="half-gray">
                                             @php
                                             $dt = new DateTime($purchase->created_at);
                                             echo $dt->format('d-m-Y');
                                             @endphp
                                          </td>
                                          <td class="color-theme-green">{{ $purchase->ProductsNative->name }} </td>
                                          <td class="color-dark-green">{{ $purchase->total_price }}</td>
                                          <td>
                                             <a href="{{ lang_url("listings/$purchase->id/1") }}" class="btn btn-default btn-lg blue">@t('View details')</a>
                                          </td>
                                       </tr>
                                       @endforeach
                                    @endif   
                                    @if ($my_subscriptions) 
                                       @foreach($my_subscriptions as $purchase)
                                       <tr>
                                          <td class="half-gray">
                                             @php
                                             $dt = new DateTime($purchase->created_at);
                                             echo $dt->format('d-m-Y');
                                             @endphp
                                          </td>
                                          <td class="color-theme-green">{{ $purchase->package_name }} </td>
                                          <td class="color-dark-green">{{ $purchase->package_price }}</td>
                                          <td>
                                             <a href="{{ lang_url("listings/$purchase->id/2") }}" class="btn btn-default btn-lg blue">@t('View details')</a>
                                          </td>
                                       </tr>
                                       @endforeach
                                    @endif
                                    @if($training_activities)
                                       @foreach($training_activities as $purchase)
                                       <tr>
                                          <td class="half-gray">
                                             @php
                                             $dt = new DateTime($purchase->created_at);
                                             echo $dt->format('d-m-Y');
                                             @endphp
                                          </td>
                                          <td class="color-theme-green">{{ $purchase->name }} </td>
                                          <td class="color-dark-green">{{ $purchase->price }}</td>
                                          <td>
                                             <a href="{{ lang_url("listings/$purchase->id/3") }}" class="btn btn-default btn-lg blue">@t('View details')</a>
                                          </td>
                                       </tr>
                                       @endforeach
                                    @endif  
                                    @if(!$training_activities && !$my_subscriptions && !$all_purchases)
                                    <tr>
                                       <td colspan="50">@t('No records found')</td>
                                    </tr>
                                    @endif
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop