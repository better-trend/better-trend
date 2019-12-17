<!DOCTYPE html>
<html class="loading" lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}" data-textdirection="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PK SOL">
    <title>Admin - {{ Voyager::setting("admin.title") }}</title>
    <link rel="apple-touch-icon" href="/backend/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/backend/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css{{ __('voyager::generic.is_rtl') == 'true' ? '-rtl' : NULL }}/vendors.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css{{ __('voyager::generic.is_rtl') == 'true' ? '-rtl' : NULL }}/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css{{ __('voyager::generic.is_rtl') == 'true' ? '-rtl' : NULL }}/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css{{ __('voyager::generic.is_rtl') == 'true' ? '-rtl' : NULL }}/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css{{ __('voyager::generic.is_rtl') == 'true' ? '-rtl' : NULL }}/pages/login-register.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->

    <!-- END Custom CSS-->

    <style>
        body.login .login-sidebar {
            border-top:5px solid {{ config('voyager.primary_color','#22A7F0') }};
        }
        @media (max-width: 767px) {
            body.login .login-sidebar {
                border-top:0px !important;
                border-left:5px solid {{ config('voyager.primary_color','#22A7F0') }};
            }
        }
        body.login .form-group-default.focused{
            border-color:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .login-button, .bar:before, .bar:after{
            background:{{ config('voyager.primary_color','#22A7F0') }};
        }
    </style>
  </head>
  <body class="login_body vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    <div class="card-title text-center">
                        <div class="p-1">
                            <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                            @if($admin_logo_img == '')
                            <img width="200" src="{{ voyager_asset('images/logobetter.png') }}" alt="Better Trend">
                            @else
                            <img width="200" src="{{ Voyager::image($admin_logo_img) }}" alt="Better Trend">
                            @endif

                        </div>
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Login with Better Trend</span></h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal form-simple" action="{{ route('voyager.login') }}" method="POST">
                            {{ csrf_field() }}

                            @if(!$errors->isEmpty())
                                <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                      @foreach($errors->all() as $err)
                                          {{ $err }}
                                      @endforeach
                                </div>
                            @endif
                            <fieldset class="form-group position-relative has-icon-left" id="emailGroup">
                                <input type="email" name="email" id="user-name" value="{{ old('email') }}" placeholder="{{ __('voyager::generic.email') }}" class="form-control form-control-lg input-lg" required>

                                <div class="form-control-position">
                                    <i class="ft-user"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left" id="passwordGroup">
                                <input id="user-password" type="password" name="password" placeholder="{{ __('voyager::generic.password') }}" class="form-control form-control-lg input-lg" required>

                                <div class="form-control-position">
                                    <i class="la la-key"></i>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-6 col-12 text-center text-md-left">
                                    <fieldset>
                                        <input type="checkbox" name="remember" id="remember-me" class="chk-remember" value="1">
                                        <label for="remember-me" class="remember-me-text">{{ __('voyager::generic.remember_me') }}</label>
                                    </fieldset>
                                </div>
                                <!-- <div class="col-md-6 col-12 text-center text-md-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div> -->
                            </div>
                            <button type="submit" class="btn btn-info btn-lg btn-block">
                                <i class="ft-unlock"></i>
                                <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span>
                                <span class="signin">{{ __('voyager::generic.login') }}</span>
                            </button>


                            <!-- <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button> -->
                        </form>
                    </div>
                </div>
                <!-- <div class="card-footer">
                    <div class="">
                        <p class="float-sm-left text-center m-0"><a href="recover-password.html" class="card-link">Recover password</a></p>
                        <p class="float-sm-right text-center m-0">New to Moden Admin? <a href="register-simple.html" class="card-link">Sign Up</a></p>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="/backend/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="/backend/app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="/backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="/backend/app-assets/js/core/app-menu.js"></script>
    <script src="/backend/app-assets/js/core/app.js"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="/backend/app-assets/js/scripts/forms/form-login-register.js"></script>
    <!-- END PAGE LEVEL JS-->
    <script>
        var btn = document.querySelector('button[type="submit"]');
        var form = document.forms[0];
        var email = document.querySelector('[name="email"]');
        var password = document.querySelector('[name="password"]');
        btn.addEventListener('click', function(ev){
            if (form.checkValidity()) {
                btn.querySelector('.signingin').className = 'signingin';
                btn.querySelector('.signin').className = 'signin hidden';
            } else {
                ev.preventDefault();
            }
        });
        email.focus();
        document.getElementById('emailGroup').classList.add("focused");

        // Focus events for email and password fields
        email.addEventListener('focusin', function(e){
            document.getElementById('emailGroup').classList.add("focused");
        });
        email.addEventListener('focusout', function(e){
           document.getElementById('emailGroup').classList.remove("focused");
        });

        password.addEventListener('focusin', function(e){
            document.getElementById('passwordGroup').classList.add("focused");
        });
        password.addEventListener('focusout', function(e){
           document.getElementById('passwordGroup').classList.remove("focused");
        });

    </script>
  </body>
</html>