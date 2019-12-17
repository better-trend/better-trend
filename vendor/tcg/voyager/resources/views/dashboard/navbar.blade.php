<?php 
  use App\Language;
  use App\Notification;
?>

<?php $lang = json_decode(Auth::user()->settings)->locale;
  $getcurrentLanguage = Language::where('code', $lang)->first();
  $allLanguages = Language::get();
?>


<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="hamburger btn-link is-active">
                <span class="hamburger-inner">
                  <i class="fa fa-bars" aria-hidden="true"></i>
                </span>
            </button>
        </div>
      <ul class="nav navbar-nav top_nav">
          <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1">Hello,<span class="user-name"><b>{{ app('VoyagerAuth')->user()->name }}</b></span></span><span class="avatar avatar-online"><img class="" src="{{ $user_avatar }}" alt="avatar"><i></i></span></a>
            <div class="dropdown-menu dropdown-menu-{{ $lang == 'en' ? 'right' : 'left' }}">
                <a href="{{ route('voyager.profile') }}" class="dropdown-item"><i class="fa fa-user-o"></i> &nbsp; Edit Profile</a>
                <a href="/{{ $lang }}/admin" class="dropdown-item"><i class="fa fa-home"></i> &nbsp; Home</a>
                  <div class="dropdown-divider"></div>

                  <form action="{{ route('voyager.logout') }}" method="POST">
                      {{ csrf_field() }}
                      <button type="submit" class="dropdown-item logout_bck_btn">
                          <i class="voyager-power"></i>
                          Logout
                      </button>
                  </form>

            </div>
          </li>
          <li class="dropdown dropdown-language nav-item">
            <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon {{ $getcurrentLanguage->flag_code }}"></i><span class="selected-language"></span></a>
            <div class="dropdown-menu dropdown-menu-{{ $lang == 'en' ? 'right' : 'left' }}" aria-labelledby="dropdown-flag">
              <?php if ($allLanguages): ?>
                <?php foreach ($allLanguages as $key => $language): ?>
                  
                  <a class="dropdown-item dropdown-item-langChange" data-locale="{{ $language->code }}" href="#"><i class="flag-icon {{ $language->flag_code }}"></i> {{ $language->name }}</a>

                <?php endforeach ?>
                
              <?php endif ?>
            </div>
          </li>
          <?php  

              $newNotifications = Notification::where('status', 0)->orderBy('id', 'DESC')->get();

              $all_notifications = Notification::orderBy('id', 'DESC')->limit(5)->get();

              $notificationCount = count($newNotifications);

          ?>
          <?php $userRole = Auth::user()->role_id; ?>
          <?php if ($userRole == 1): ?>            
          <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="fa fa-bell-o" aria-hidden="true"></i><span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow notif_count {{ $notificationCount == 0 ? 'hide' : NULL }}">{{ $notificationCount }}</span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-{{ $lang == 'en' ? 'right' : 'left' }}">
              <li class="dropdown-menu-header">
                <h6 class="dropdown-header"><span class="grey darken-2">Notifications</span></h6>
                <span class="notification-tag badge badge-default badge-danger {{ $notificationCount == 0 ? 'hide' : NULL }}">
                  <span class="notif_count">{{ $notificationCount }}</span> New
                </span>
                <input type="hidden" class="notif_count_val" value="{{ $notificationCount }}" />
              </li>
              <li class="scrollable-container media-list w-100">
                
                <?php if (count($all_notifications) > 0): ?>
                  <?php foreach ($all_notifications as $key => $notification): ?>
                    <?php
                      if ($notification->slug == 'applied-coach') {
                        $title_class = '';
                      } else {
                        $title_class = '';
                      }
                    ?>
                  <a href="{{ lang_url($notification->url) }}" class="{{ $notification->status == 0 ? 'unread_notification' : NULL }}" data-notif_id="{{ $notification->id }}">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                      <div class="media-body">
                        <input type="hidden" class="notification_id" value="{{ $notification->id }}" />
                        <h6 class="media-heading {{ $title_class }}">{{ $notification->title }}</h6>
                        <p class="notification-text font-small-3 text-muted">{{ $notification->short_desc }}</p><small>
                          <time class="media-meta text-muted">
                            <?php 
                              $date = \Carbon\Carbon::parse($notification->created_at);
                              $duration = $date->diffForHumans(\Carbon\Carbon::now());
                              echo $duration;
                             ?>
                          </time></small>
                      </div>
                    </div>
                  </a>
                  <?php endforeach ?>
                <?php else: ?>
                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i></div>
                      <div class="media-body">
                        <h6 class="media-heading">&nbsp;</h6>
                        <p class="notification-text font-small-3 text-muted">You don't have any notification!</p><small>
                      </div>
                    </div>
                  </a>
                <?php endif ?>
                </li>
                <?php if (count($all_notifications) > 0): ?>
                  <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="{{ lang_url('admin/notification') }}">Read all notifications</a></li>
                <?php endif ?>
            </ul>
          </li>
          <?php endif ?>
        </ul>        
    </div>
</nav>