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
                  <ol class="breadcrumb text-black mb-0 mt-40">
                     <li><a href="{{ lang_url('') }}">@t('Home')</a></li>
                     <li class="active text-gray-silver">@t('About Better Trend')</li>
                  </ol>
                  <h2 class="title text-white">@t('About Better Trend')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: about -->
   <section>
      <div class="container pt-20">
         <div class="row pt-30 <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?>">
            <div class="col-md-12">
               <div class="col-md-12 col-sm-12">
                  <h2 class="mt-0 mb-0 font-30 heading-title-spec  ">@t('BT Story')</h2>
               </div>
               <div class="col-md-12 col-sm-12 p-0">
                   <div class="col-sm-8">
                       <p>
                           @t('111111111')
                       </p>
                   </div>
                   <div class="col-sm-4">
                       <img src="/public/frontend/assets/about1.jpg">
                   </div>
                   <div class="col-sm-8">
                       <h3><strong>@t('111111111aa')</strong></h3>
                       <p>
                           @t('111111111a')
                       </p>
                   </div>
                   <div class="col-sm-4 mt-50">
                       <img src="/public/frontend/assets/about2.png">
                   </div>
                   <div class="col-sm-8">
                       <h3><strong>@t('111111111bb')</strong></h3>
                       <p>
                           @t('111111111b')
                       </p>
                   </div>
                   <div class="col-sm-4 mt-50">
                       <img src="/public/frontend/assets/about3.png">
                   </div>
                   <div class="col-sm-8">
                       <h3><strong>@t('111111111cc')</strong></h3>
                       <p>
                           @t('111111111c')
                       </p>
                   </div>
                   <div class="col-sm-4 mt-50">
                       <img src="/public/frontend/assets/about4.png">
                   </div>
               </div>
            </div>
             <div class="col-md-12">
                 <div class="col-md-12 col-sm-12">
                     <h2 class="mt-0 mb-0 font-30 heading-title-spec  ">@t('BT Profilea')</h2>
                 </div>
                 <div class="col-md-12 col-sm-12">
                     <p>
                         @t('555555')
                     </p>
                 </div>
             </div>
             <div class="col-md-12">
                 <div class="col-md-12 col-sm-12">
                     <h2 class="mt-0 mb-0 font-30 heading-title-spec  ">@t('BT Mission')</h2>
                 </div>
                 <div class="col-md-12 col-sm-12">
                     <p>
                         @t('22222222')
                     </p>
                 </div>
             </div>
             <div class="col-md-12">
                 <div class="col-md-12 col-sm-12">
                     <h2 class="mt-0 mb-0 font-30 heading-title-spec  ">@t('BT Vision')</h2>
                 </div>
                 <div class="col-md-12 col-sm-12">
                     <p>
                         @t('3333333')
                     </p>
                 </div>
             </div>
             <div class="col-md-12">
                 <div class="col-md-12 col-sm-12">
                     <h2 class="mt-0 mb-0 font-30 heading-title-spec  ">@t('BT Values')</h2>
                 </div>
                 <?php $s = @t('44444444') ?>
                 <div class="col-md-12 col-sm-12">
                     <p>
                         <?= str_replace("\r\n", " <br/>", $s) ?>
                     </p>
                 </div>
             </div>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop