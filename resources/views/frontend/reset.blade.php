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
                     <li class="active text-gray-silver">@t('Access')</li>
                  </ol>
                  <h2 class="title text-white">@t('Entry area')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: about -->
   <section class="divider">
      <div class="container">
         <div class="row pt-30 <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?>">
            <div class="col-md-8 col-md-offset-2">
               <!-- login Form -->
               <div class="form-container">
                  <form class="form-inline" name="loginform" id="loginform" method="POST" action="{{ lang_url('forgot_send_email') }}">
                     @csrf
                     @if(session()->has('error'))
                     <div class="alert alert-red">
                        <ul class="list-unstyled mb-0">
                           <li class="text-white">{!! session()->get('error') !!}</li>
                        </ul>
                     </div>
                     @endif
                     @if(session()->has('message'))
                     <div class="alert alert-green">
                        <ul class="list-unstyled mb-0">
                           <li class="text-white">{!! session()->get('message') !!}</li>
                        </ul>
                     </div>
                     @endif
                     <div class="row">
                        <div class="col-md-12 col-sm-12">
                           <div class="col-sm-12 p-0">
                              <div class="form-group mb-30">
                                 <label for="email">@t('E-mail')</label>
                                 <input id="email" name="email" class="form-control" type="email" placeholder="@t('E-mail')" required="" aria-required="true" value="{{ old('email') }}" required >
                              </div>
                           </div>
                           <div class="col-sm-12 p-0">
                              <div class="form-group mb-30">
                                 <input type="submit" name="wp-submit" id="wp-submit" class="button btn btn-success" value="@t('Send Password Reset Link')">
                              </div>
                           </div>
                           <p>@('Login instead')?<a class="fusion-modal-text-link" style="margin:0 5px;color:#337ab7;" href="{{ lang_url('userlogin') }}">@t('Sign In')</a></p>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop