




<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
<head>
    <title>@yield('page_title', setting('admin.title') . " - " . setting('admin.description'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="assets-path" content="{{ route('voyager.assets') }}"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Google Fonts -->
    
    <!-- Font Awsome -->
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/font-awesome.min.css">
    <!-- Font Awsome -->
    <!-- Flag library -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css'>
    <!-- Flag library -->


    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon_btr.ico" type="image/x-icon">

    <!-- Menu styling css -->

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/fonts/simple-line-icons/style.css">



    
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/fonts/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/vendors/css/forms/icheck/polaris/polaris.css">

    @if(__('voyager::generic.is_rtl') == 'true')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
        <link rel="stylesheet" href="{{ voyager_asset('css/rtl.css') }}">
        <link rel="stylesheet" href="{{ voyager_asset('css/custom.css') }}"> 
        <link rel="stylesheet" href="{{ voyager_asset('css/customrtl.css') }}">
    @else
        <link rel="stylesheet" href="{{ voyager_asset('css/custom.css') }}"> 
    @endif
    
@yield('css')
      

    <!-- Few Dynamic Styles -->
    <style type="text/css">
        .voyager .side-menu .navbar-header {
            background:{{ config('voyager.primary_color','#22A7F0') }};
            border-color:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .widget .btn-primary{
            border-color:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .widget .btn-primary:focus, .widget .btn-primary:hover, .widget .btn-primary:active, .widget .btn-primary.active, .widget .btn-primary:active:focus{
            background:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .voyager .breadcrumb a{
            color:{{ config('voyager.primary_color','#22A7F0') }};
        }
    </style>

    @if(!empty(config('voyager.additional_css')))<!-- Additional CSS -->
        @foreach(config('voyager.additional_css') as $css)<link rel="stylesheet" type="text/css" href="{{ asset($css) }}">@endforeach
    @endif

    @yield('head')
</head>

<body class="voyager @if(isset($dataType) && isset($dataType->slug)){{ $dataType->slug }}@endif">

<div id="voyager-loader">
    <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
    @if($admin_loader_img == '')
        <!-- <img src="{{ voyager_asset('images/logo-icon.png') }}" alt="Voyager Loader"> -->
    @else
        <!-- <img src="{{ Voyager::image($admin_loader_img) }}" alt="Voyager Loader"> -->
    @endif
</div>

<?php
if (starts_with(app('VoyagerAuth')->user()->avatar, 'http://') || starts_with(app('VoyagerAuth')->user()->avatar, 'https://')) {
    $user_avatar = app('VoyagerAuth')->user()->avatar;
} else {
    $user_avatar = Voyager::image(app('VoyagerAuth')->user()->avatar);
}
?>

<div class="app-container">
    <div class="fadetoblack visible-xs"></div>
    <div class="row content-container">
     

        @include('voyager::dashboard.navbar')


        @include('voyager::dashboard.sidebar')
        <script>
            (function(){
                    var appContainer = document.querySelector('.app-container'),
                        sidebar = appContainer.querySelector('.side-menu'),
                        navbar = appContainer.querySelector('nav.navbar.navbar-top'),
                        loader = document.getElementById('voyager-loader'),
                        hamburgerMenu = document.querySelector('.hamburger'),
                        sidebarTransition = sidebar.style.transition,
                        navbarTransition = navbar.style.transition,
                        containerTransition = appContainer.style.transition;

                    sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition =
                    appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition =
                    navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = 'none';

                    if (window.localStorage && window.localStorage['voyager.stickySidebar'] == 'true') {
                        appContainer.className += ' expanded no-animation';
                        loader.style.left = (sidebar.clientWidth/2)+'px';
                        hamburgerMenu.className += ' is-active no-animation';
                    }

                   navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = navbarTransition;
                   sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition = sidebarTransition;
                   appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition = containerTransition;
            })();
        </script>
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="side-body padding-top">
                @yield('page_header')
                <div id="voyager-notifications"></div>
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('voyager::partials.app-footer')

<!-- Javascript Libs -->


<script src="/backend/app-assets/vendors/js/vendors.min.js"></script>
<script src="/backend/app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
<script src="/backend/app-assets/vendors/js/forms/toggle/switchery.min.js"></script>
<script src="/backend/app-assets/js/core/app-menu.js"></script>
<script src="/backend/app-assets/js/scripts/dropdowns/dropdowns.js"></script>
<script type="text/javascript" src="{{ voyager_asset('js/app.js') }}"></script>

<script>


    jQuery(document).ready(function($) {
      $('.dropdown-item-langChange').on('click', function(e) {
        e.preventDefault();
        var $this = $(this),
            locale = $this.attr('data-locale');
            if (locale != '{{ json_decode(Auth::user()->settings)->locale }}') {
              
              $.ajax({
                  type: 'POST',
                  url: '{{ lang_url("changLangAdminPanel") }}',
                  data: {"_token": "{{ csrf_token() }}", 'locale':locale},
              })
              .done(function(response) {
                var url = window.location.pathname,
                    urlArray = url.split('/'),
                    newPathname = url.replace(urlArray[1], locale);
                
                window.location.href = newPathname;

              });

            }

      });

      $('.dropdown a.nav-link').on('click',  function(e) {
        var $this = $(this);
        $this.find('span.notif_count').addClass('hide');
      });

      $(document).on('click', '.unread_notification', function(e) {
          e.preventDefault();
          var $this = $(this);
          var newPathname = $this.attr('href');
          var notification_id = $this.attr('data-notif_id');
          $.ajax({
                 type: 'POST',
                 url: '{{ lang_url("read_notification") }}',
                 data: {
                  '_token' : '{{ csrf_token() }}',
                  'notification_id' : notification_id
                 }
             })
            .done(function(response) {
                window.location.href = newPathname;
            })
      });
      var userRole = '{{ Auth::user()->role_id }}';

      if (userRole == '1') {
        setInterval(function(){ 
            var notification_id = $('input.notification_id').eq(0).val();
               $.ajax({
                   type: 'POST',
                   url: '{{ lang_url("getnotifications") }}',
                   data: {
                    '_token' : '{{ csrf_token() }}',
                    'notification_id' : notification_id
                   }
               })
               .done(function(response) {

                var responseData = jQuery.parseJSON(response.trim());

                  if (responseData.count > 0) {
                      $('.dropdown-menu li.media-list').prepend(responseData.htmlContent);

                      var newCount = parseInt($('.notif_count_val').val()) + parseInt(responseData.count);

                      $('.dropdown span.notif_count').text(newCount).removeClass('hide');
                      $('.notification-tag').text(newCount).removeClass('hide'); 
                      $('.notif_count_val').val(newCount);

                      $('span.notificatio_count').html(responseData.count);

                  }
                

               });
        }, 5000);
    }

    });


    @if(Session::has('alerts'))
        let alerts = {!! json_encode(Session::get('alerts')) !!};
        helpers.displayAlerts(alerts, toastr);
    @endif

    @if(Session::has('message'))

    // TODO: change Controllers to use AlertsMessages trait... then remove this
    var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
    var alertMessage = {!! json_encode(Session::get('message')) !!};
    var alerter = toastr[alertType];

    if (alerter) {
        alerter(alertMessage);
    } else {
        toastr.error("toastr alert-type " + alertType + " is unknown");
    }
    @endif
</script>
@include('voyager::media.manager')
@include('voyager::menu.admin_menu')
<script>
new Vue({
    el: '#adminmenu',
});
</script>
@yield('javascript')
@stack('javascript')
@if(!empty(config('voyager.additional_js')))<!-- Additional Javascript -->
    @foreach(config('voyager.additional_js') as $js)<script type="text/javascript" src="{{ asset($js) }}"></script>@endforeach
@endif

</body>
</html>
