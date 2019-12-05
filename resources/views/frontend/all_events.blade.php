<?php use App\User; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Start main-content -->
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
                     <li class="active text-gray-silver">@t('Services & Products')</li>
                  </ol>
                  <h2 class="title text-white">@t('Services & Products')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="divider">
      <div class="container">
         <div class="row <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?>">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-sm-30">
               <h2 class="mt-0 font-30 heading-title-spec" style="text-transform: none">@t('Training Events')</h2>
            </div>
         </div>
         <div class="row <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?>">
            <?php if (count($eventNative) > 0): ?>
            <?php foreach ($eventNative as $key => $events): ?>
            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
               <div class=" bg-white border-1px p-30 pt-20 pb-20">
                  <h3 class="package-type font-24 m-0 mb-20 color-theme-green text-center">
                     <?php
                        $coach = User::find($events->events->coach_id);
                        if ($coach) {
                            echo $coach->name.' '.$coach->last_name;
                        } else {
                          echo t('User');
                        }
                        ?>
                  </h3>
                  <img src="\public\storage\{{ $events->image }}" alt="{{ $events->name }}"> 
                  <?php 
                  $dt = new DateTime($events->end_date);
                  $date = date_create($events->events->end_date);
                   ?> 
                  <table style="width: 100%">
                     <tr>
                        <td class="color-dark-green font-weight-600 font-16 course-divider">
                           <span class="color-theme-green course-span">@t('To date')</span>
                        </td>
                        <td style="border-bottom: 1px solid #ddd" class="color-dark-green font-weight-600 font-16 course-divider">
                           <span class="color-theme-green course-span">{{ date_format($date, 'd-m-Y') }}</span>
                        </td>
                     </tr>
                     <tr>
                        <td class="color-dark-green font-weight-600 font-16 course-divider">
                           <span class="color-theme-green course-span">@t('Type')</span>
                        </td>
                        <td style="border-bottom: 1px solid #ddd" class="color-dark-green font-weight-600 font-16 course-divider">
                           <?php if (request()->segments()[0] == "ar") : ?>
                              <span class="color-theme-green course-span">@t('Training room')</span>
                           <?php else : ?>
                              <span class="color-theme-green course-span">{{ ucwords(str_replace('_', ' ', $events->events->type)) }}</span>
                           <?php endif; ?>
                        </td>
                     </tr>
                     <tr>
                        <td class="color-dark-green font-weight-600 font-16 course-divider">
                           <span class="color-theme-green course-span">@t('For fees')</span>
                        </td>
                        <td style="border-bottom: 1px solid #ddd" class="color-dark-green font-weight-600 font-16 course-divider">
                           <span class="color-theme-green course-span">{{ $events->events->price }}</span>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <a href="{{ lang_url('events/'.$events->events->id) }}" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">@t('Details')</a>
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
            <?php endforeach ?>
            <?php else: ?>
            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
               <p class="color-dark-green font-weight-600 font-16 course-divider">
                  @t('No Events Found!')
               </p>
            </div>
            <?php endif ?>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop