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
                    <li><a href="{{ lang_url('events') }}">@t('Training Events')</a></li>
                    <li class="active text-gray-silver">{{ $eventNative->name }}</li>
                </ol>
                <h2 class="title text-white">{{ $eventNative->name }}</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
      
    <section class="bg-theme-colored">
      <div class="container pt-40 pb-40">
        <div class="row text-center">
          <div class="col-md-12">
            <?php $s = $eventNative->status ?>
            <h2 id="basic-coupon-clock" style="margin-top: 0" class="text-white">@t('Status'):
            <?php if ($s == "active") : ?> 
              @t('active')
            <?php else: ?>
              @t('inactive')
            <?php endif; ?>
          </h2>
            <!-- Final Countdown Timer Script -->
            {{--<script type="text/javascript">
              $(document).ready(function() {
                $('#basic-coupon-clock').countdown('{{ $eventNative->events->start_date }}', function(event) {
                  $(this).html(event.strftime('%D days %H:%M:%S'));
                });
              });
            </script>--}}
          </div>
        </div>
      </div>
    </section>

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
                " href="{{ lang_url('events') }}">@t('Back to Training Events')</a>
          </div>
      </div>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <table style="width: 100%">
              <tr>
                <td>@t('Title:')</td>
                <td>{{ $eventNative->name }}</td>
              </tr>
              <tr>
                <td>@t('Type:')</td>
                <?php if (request()->segments()[0] == "ar") : ?>
                  <td>@t('Training room')</td>
                <?php else : ?>
                  <td>{{ $eventNative->events->type }}</td>
                <?php endif; ?>
              </tr>  
              <tr>
                <td>@t('Event Price:')</td>
                <td>{{ $eventNative->events->price}}</td>
              </tr>
              <tr>
                <td>@t('Classification:')</td>
                <?php if (request()->segments()[0] == "ar") : ?>
                  <td>@t('online')</td>
                <?php else : ?>
                  <td>{{ $eventNative->events->classification }}.</td>
                <?php endif; ?>
              </tr>
              <tr>
                <td>@t('Location:')</td>
                <?php if (request()->segments()[0] == "ar") : ?>
                  <td>@t('online')</td>
                <?php else : ?>
                  <td>{{ $eventNative->events->location }}</td>
                <?php endif; ?>
              </tr>
              <tr>
                <td>@t('Start Date:')</td>
                <td>{{ $eventNative->events->start_date }}</td>
              </tr>  
              <tr>
                <td>@t('End Date:')</td>
                <td>{{ $eventNative->events->end_date }}</td>
              </tr>
              <tr>
                <td>@t('Total hours:')</td>
                <td>{{ $eventNative->events->hours }}</td>
              </tr>
              <tr>
                <td>@t('Share:')</td>
                <td>
                <div class="styled-icons icon-sm icon-gray icon-circled">
                  <a href="https://www.facebook.com/sharer/sharer.php?u=#url" target="_blank"><i class="fa fa-facebook"></i></a>
                  <a target="_blank" href="https://www.twiter.com"><i class="fa fa-twitter"></i></a>
                  <a target="_blank" href="https://www.instagram.com"><i class="fa fa-instagram"></i></a>
                  <a target="_blank" href="https://www.google.com"><i class="fa fa-google-plus"></i></a>
                </div>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-md-8">
              <div class="item"><img src="\storage\{{ $eventNative->image }}" alt=""></div>
          </div>
        </div>
        <div class="row mt-60">
          <div class="col-md-12">
            <h4 class="mt-0">@t('Event Description')</h4>
            <p>{{ $eventNative->description }}</p>
          </div>
        </div>
      </div>
    </section>


<?php if ($eventNative->events->course_enroll_status != 'finish' && $eventNative->events->course_enroll_status != 'cancelled' && $eventNative->events->course_enroll_status != 'closed' && $eventNative->events->course_enroll_status != 'on_hold'): ?>
  <?php 
    $date = new DateTime($eventNative->events->end_date);
    $now = new DateTime();
  ?>
  
  <?php if ($date > $now): ?>    
    <!-- Section: Registration Form -->
    <section class="divider parallax bg-lighter">
      <div class="container-fluid">
        <div class="section-title">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
              <h3 class="title text-theme-colored">@t('Registration Form')</h3>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
          <?php if (Auth::check()): ?>

            <?php $enrolledCourse = DB::table('course_subscriptions')->where([['status', 'active'], ['event_id', $eventNative->events->id], ['user_id', Auth::user()->id]])->first(); ?>

            <?php if (!$enrolledCourse): ?>
              <form name="checkoutForm" id="checkoutForm" method="POST" action="{{ lang_url('') }}/enroll_form" class="checkoutForm">
            <?php endif ?>
          <?php else: ?>
            <form name="checkoutForm" id="checkoutForm" method="POST" action="{{ lang_url('') }}/enroll_form" class="checkoutForm">
          <?php endif ?>
            @csrf
            <input type="hidden" class="user_id" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}" />
            <input type="hidden" name="event_id" value="{{ $eventNative->events->id }}" />

            @if(Auth::check())
              <input type="hidden" value="{{ Auth::user()->name }}" name="first_name">
              <input type="hidden" value="{{ Auth::user()->last_name }}" name="last_name">
              <input type="hidden" value="{{ Auth::user()->email }}" name="email">
              <input type="hidden" value="{{ Auth::user()->phone }}" name="mobile_number">
            @else

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="@t('First name')" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="@t('Last name')" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="@t('+123-342')" required>
                  </div>
                </div>

                <div style="padding-left: 15px;margin-top: 20px;"><a href="{{lang_url('register')}}" class="text-theme-colored" style="font-size: 20px;">@t('Or create an account here')</a></div>
                @endif
                <div class="col-sm-12">
                  <div class="form-group text-center">
                    <?php if (Auth::check()): ?>

                      <?php $enrolledCourse = DB::table('course_subscriptions')->where([['status', 'active'], ['event_id', $eventNative->events->id], ['user_id', Auth::user()->id]])->first(); ?>
                      <?php if (!$enrolledCourse): ?>
                        <button data-loading-text="@t('Please wait')..." class="btn btn-dark btn-theme-colored btn-sm btn-block mt-20 pt-10 pb-10" type="submit">@t('Register now')</button>
                      <?php else: ?>
                        <span>@t('Note'): <b>@t('You are already Enrolled in this event')</b></span>
                      <?php endif ?>
                    <?php else: ?>
                      <button data-loading-text="Please wait..." class="btn btn-dark btn-theme-colored btn-sm btn-block mt-20 pt-10 pb-10" type="submit">@t('Register now')</button>
                    <?php endif ?>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  <?php endif ?>
  <?php endif ?>
  </div>
  <!-- end main-content -->
  @stop
  