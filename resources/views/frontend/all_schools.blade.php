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
                      <?php if (request()->segments()[0] == "en") : ?>
                     <li class="active text-gray-silver">@t('Online Schools')</li>
                     <?php else: ?>
                     <li class="active text-gray-silver">@t('خدماتنا ومنتجاتن')</li>
                     <?php endif; ?>
                  </ol>
                  <?php if (request()->segments()[0] == "en") : ?>
                  <h2 class="title text-white">@t('Services & Products')</h2>
                  <?php else : ?>
                  <h2 class="title text-white">@t('خدماتنا ومنتجاتن')</h2>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="divider">
      <div class="container">
         <div class="row <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?>">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-sm-30">
                <?php if (request()->segments()[0] == "en") : ?>
                  <h2 class="mt-0 font-30 heading-title-spec">@t('Online Schools')</h2>
                   <?php else: ?>
                   <h2 class="mt-0 font-30 heading-title-spec">@t('خدماتنا ومنتجاتن')</h2>
                   <?php endif; ?>
            </div>
         </div>
         <div class="row <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?>">
            <?php if ($schoolNative): ?>
            <?php foreach ($schoolNative as $key => $school): ?>
            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
               <div class="pricing-table maxwidth400">
               </div>
               <div class=" bg-white border-1px p-30 pt-20 pb-20">
                  <h3 class="package-type font-24 m-0 mb-20 color-theme-green text-center"><a href="{{ lang_url('school/'.$school->schools->id.'/view') }}">{{ $school->name }}</a></h3>
                  <img src="\public\storage\{{ $school->image }}" alt="{{ $school->name }}">
                  <p>{{ $school->description }}</p>
               </div>
               <a href="{{ lang_url('school/'.$school->schools->id.'/view') }}" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">@t('Details')</a>
            </div>
            <?php endforeach ?>
            <?php else: ?>
            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
               <div class="pricing-table maxwidth400">
               </div>
               <div class=" bg-white border-1px p-30 pt-20 pb-20">
                  <p>@t('No Record Found !')</p>
               </div>
            </div>
            <?php endif ?>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop