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
                     <li><a href="index.html">@t('Home')</a></li>
                     <li class="active text-gray-silver">@t('Partners')</li>
                  </ol>
                  <h2 class="title text-white">@t('Partners')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: Parteners -->
   <section class="bg-white">

      <div class="container">

         <div class="section-content">

            <div class="row">

               <div class="col-md-12 <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?> p-0">

                  <h2 class="mt-0 mb-50 font-30 heading-title-spec">@t('Success Partners')</h2>

               </div>

            </div>

            <div class="row clients">

               <div class="col-md-4 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                  <div class="parteners-white-block">
                     <h4 class="text-center mb-0">@t('DNet')</h4>
                     <a href="https://www.dnet.sa"><img src="/frontend/assets/p1.png"></a>
                     <p class="mt-5 text-center">@t('dnet_text').</p>
                  </div>

               </div>

               <div class="col-md-4 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">


                  <div class="parteners-white-block">
                     <h4 class="text-center mb-0">@t('komait')</h4>
                     <a href="https://komait.com/tadawul-course/"><img src="/frontend/assets/p2.png"></a>
                     <p class="mt-5 text-center">@t('komait_text')</p>
                  </div>


               </div>

               <div class="col-md-4 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">


                  <div class="parteners-white-block">
                     <h4 class="text-center mb-0">@t('komait2')</h4>
                     <a href="https://komait.com/en/"><img src="/frontend/assets/p3.png"></a>
                     <p class="mt-5 text-center">@t('komait2_text')</p>
                  </div>


               </div>

               <div class="col-md-4 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                  <div class="parteners-white-block">
                     <h4 class="text-center mb-0">@t('market')</h4>
                     <a href="https://twitter.com/oxygenmarkets?lang=en"><img src="/frontend/assets/p4.png"></a>
                     <p class="mt-5 text-center">@t('market_text')</p>
                  </div>

               </div>

               <div class="col-md-4 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                  <div class="parteners-white-block">
                     <h4 class="text-center mb-0">@t('GCTC')</h4>
                     <a href="https://gctc.com.sa/?lang=en"><img src="/frontend/assets/p5.png"></a>
                     <p class="mt-5 text-center">@t('GCTC_text')</p>
                  </div>

               </div>

               <div class="col-md-4 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                  <div class="parteners-white-block">
                     <h4 class="text-center mb-0">@t('money_expert')</h4>
                     <a href="https://institute.mec.biz/en"><img src="/frontend/assets/p6.png"></a>
                     <p class="mt-5 text-center">@t('money_expert_text')</p>
                  </div>

               </div>

            </div>

         </div>

      </div>

      <div class="container">
         <div class="section-content">
            <div class="row">

               <div class="col-md-12 <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?> p-0">

                  <h2 class="mt-0 mb-50 font-30 heading-title-spec">@t('leg_super')</h2>

               </div>

            </div>

            <div class="row clients">

               <div class="col-md-6 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                  <div class="parteners-white-block">
                     <h4 class="text-center mb-0">@t('capital_market')</h4>
                     <a href="https://cma.org.sa/en/Pages/default.aspx"><img src="/frontend/assets/p7.png"></a>
                  </div>

               </div>

               <div class="col-md-6 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                  <div class="parteners-white-block">
                     <h4 class="text-center mb-0">@t('TVTC')</h4>
                     <a href="https://www.tvtc.gov.sa/English/"><img src="/frontend/assets/p8.png"></a>
                  </div>

               </div>

            </div>
         </div>
      </div>

   </section>
</div>
<!-- end main-content -->
@stop