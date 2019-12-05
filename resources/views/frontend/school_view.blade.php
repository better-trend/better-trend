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
                    <li><a href="{{ lang_url('allschools') }}">@t('E-Schools')</a></li>
                    <li class="active text-gray-silver"><?= $title ?></li>
                </ol>
                <h2 class="title text-white"><?= $title ?></h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Divider: about -->
    <section class="divider">
      <div class="container" style="padding-top: 10px">
        <div class="main-top-resources">
           <a href="#" class="resp-menu" onclick="openNav()">☰</a>
           <div class="you_need">
              <div class="row">
                 <div class="col-md-12 text-center">
                    <h2 class="text-center"><span>{{ $schoolNative->name }}</span></h2>
                    <div class="img-forex">
                       <img width="80%" src="\public\storage\{{ $schoolNative->image }}" alt="{{ $schoolNative->name }}">
                    </div>
                    <div class="book-detail">
                       <h3 class="mb-2"><strong>@t('School Description:')</strong></h3>
                      {!! $schoolNative->description !!}
                    </div>
                    <div>
                      <?php if (Auth::check()): ?>
                        <?php 
                          $my_subscriptions = DB::table('users_subscription')
                            ->join('schools_natives', 'users_subscription.school_id', '=', 'schools_natives.school_id')
                        ->select('schools_natives.*', 'users_subscription.*', 'users_subscription.school_id AS subscription_school_id', 'users_subscription.status AS subscription_status')
                        ->where([['users_subscription.status', '!=', 'active'], ['users_subscription.user_id', '=', Auth::user()->id], ['schools_natives.status', '=', 'active'], ['schools_natives.lang', '=', json_decode(Auth::user()->settings)->locale], ['schools_natives.id', '=', $schoolNative->id]])
                            ->first();
                        ?>
                        <?php if ($my_subscriptions===null): ?>
                         <div class="row mt-3" style="margin-top: 35px">
                            <div class="col-xs-12 p-0">
                               <a class="" href="{{ lang_url('plans_pricing') }}">
                                  <button class="btn btn-success w-100" style="font-size: 18px">@t('Enroll in')</button>
                               </a>
                            </div><!-- /.col-4 -->
                         </div><!-- /.row -->
                        <?php endif ?>
                      <?php else: ?>

                        <div class="row mt-3" style="margin-top: 35px">
                           <div class="col-xs-12 p-0">
                              <a class="" href="{{ lang_url('userlogin') }}">
                                 <button class="btn btn-success w-100" style="font-size: 18px">@t('Enroll in')</button>
                              </a>
                           </div><!-- /.col-4 -->
                        </div><!-- /.row -->
                      <?php endif ?>
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