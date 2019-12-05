@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Start main-content -->
<div class="main-content media_page">
  <!-- Section: inner-header -->
  <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="/frontend/_assets/images/breadcrumb-bg.png">
    <div class="container pt-70 pb-20">
      <!-- Section Content -->
      <div class="section-content">
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb text-right text-black mb-0 mt-40">
              <li><a href="{{ lang_url('') }}">@t('Home')</a></li>
              <li class="active text-gray-silver">@t('Educational Library')</li>
            </ol>
            <h2 class="title text-white">@t('Educational Library')</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Divider: about -->
  <section class="divider">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <ul id="myTab" class="nav nav-tabs boot-tabs text-center">
            <li class="active"><a href="#subtab1" data-toggle="tab">@t('the video')</a></li>
            <li><a href="#subtab2" data-toggle="tab">@t('Pictures')</a></li>
            <li><a href="#subtab3" data-toggle="tab">@t('the documents')</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="subtab1">
              <div class="row mt-50 mb-30">
                <div class="col-md-12">
                  <div class="col-md-4 col-sm-12 p-0 text-left">
                    <div class="form-group">
                      <select class="form-control mt-0" id="end_period_video">
                        <option value="0">— @t('Select Category') —</option>
                        <?php if ($videosCategories): ?>
                          <?php foreach ($videosCategories as $key => $category): ?>
                            <option value="{{ $category->category }}">{{ ucfirst($category->category) }}</option>
                          <?php endforeach ?>
                        <?php endif ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <?php if ($youtubeVideos): ?>
                    <?php foreach ($youtubeVideos as $key => $singleVideo): ?>
                    <div class="col-md-4 col-md-12 mb-30 all_videos category_{{ str_replace(' ', '_', $singleVideo->category) }}">
                      <div class="fluid-video-wrapper">
                        <div class="title_video" style="font-size: 20px;margin-bottom: 8px;">{{ $singleVideo->title }}</div>
                        <iframe id="player{{ $singleVideo->id }}" class="yt_players" width="560" height="275" src="{{ $singleVideo->link.'?rel=0&wmode=Opaque&enablejsapi=1;showinfo=1;controls=1' }}" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <div class="video_video text-right">{{ $singleVideo->description }}</div>
                        <div class="attach_video text-right"><a style="color:#337ab7;" target="_blank" href="{{ $singleVideo->attachment_link }}">{{ $singleVideo->attachment_link }}</a></div>
                      </div>
                    </div>
                    <?php endforeach ?>
                  <?php else: ?>
                    <p>@t('No Video found')</p>
                  <?php endif ?>
                </div>
              </div>
            </div>
            

            <div class="tab-pane fade in active" id="subtab2">
              <div class="row mt-50 mb-30">
                <div class="col-md-12">
                  <div class="col-md-4 col-sm-12 p-0 text-left">
                    <div class="form-group">
                      <select class="form-control mt-0" id="end_period_images">
                        <option value="0">— @t('Select Category') —</option>
                        <?php if ($mediaImages): ?>
                          <?php foreach ($mediaImages as $key => $image): ?>
                            <option value="{{ $image->category }}">{{ ucfirst($image->category) }}</option>
                          <?php endforeach ?>
                        <?php endif ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="gallery-isotope grid-4 gutter-small " data-lightbox="gallery" >
                        <!-- Portfolio Item Start -->
                      <?php if ($mediaImages): ?>
                        <?php foreach ($mediaImages as $key => $image): ?>
                          <div class="gallery-item mb-20 all_images image_category_{{ str_replace(' ', '_', $image->category) }}">
                            <div class="thumb">
                              <img class="img-fullwidth" src="/storage/{{ str_replace('/\/', '/', $image->image) }}" alt="project">
                              <div class="overlay-shade"></div>
                              <div class="text-holder">
                                <div class="title text-center"> {{ $image->title }} </div>
                              </div>
                              <div class="icons-holder">
                                <div class="icons-holder-inner">
                                  <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                    <a href="/storage/{{ str_replace('/\/', '/', $image->image) }}" data-lightbox-gallery="gallery" title="{{ $image->title }}"><i class="fa fa-picture-o"></i></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="video_video text-right"><b>Description: </b>{{ $image->description }}</div>
                          </div>
                        <?php endforeach ?>
                      <?php else: ?>
                        <p>No Images found</p>
                      <?php endif ?>
                        <!-- Portfolio Item Start -->
                  </div>
                </div>
              </div>
            </div>


            <div class="tab-pane fade in active" id="subtab3">
              <div class="row mt-50 mb-30">
                <div class="col-md-12">
                  <div class="col-md-4 col-sm-12 p-0 text-left">
                    <div class="form-group">
                      <select class="form-control mt-0" id="end_period_document">
                        <option value="0">— @t('Select Category') —</option>
                        <?php if ($mediadocuments): ?>
                          <?php foreach ($mediadocuments as $key => $category): ?>
                            <option value="{{ $category->category }}">{{ ucfirst($category->category) }}</option>
                          <?php endforeach ?>
                        <?php endif ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <?php if ($mediadocuments): ?>
                    <?php foreach ($mediadocuments as $key => $document): ?>
                      <div class="gallery-item mb-20 doc_cat all_documents document_category_{{ str_replace(' ', '_', $document->category) }}" style="position: unset !important;">

                        <div class="title_documents"><b>@t('Title'): </b><span class="doc_text">{{ $document->title }}</span></div>
                        <div class="desc_documents"><b>@t('Description'): </b><span class="doc_text">{{ $document->description }}</span></div>
                        <div class="link_documents"><b>@t('Link'): </b><a target="_blank" style="color:#337ab7;" href="{{ $document->link }}">
                          <span class="doc_text">{{ $document->link }}</span></a></div>
                        <div class="attach_documents"><b>@t('Attachments'):</b>
                          <ul>
                             <?php $decodedAttachment = json_decode($document->attachment); ?>
                             <?php if ($decodedAttachment): ?>
                               <?php foreach ($decodedAttachment as $key => $attch): ?>
                                <li><a target="_blank" style="color:#337ab7;" href="/storage/{{ $attch->download_link}}"><span class="doc_text">{{ $attch->original_name }}</span></a></li>
                               <?php endforeach ?>
                             <?php endif ?>
                          </ul>
                        </div>
                      </div>
                    <?php endforeach ?>
                  <?php else: ?>
                    <p>No Documents found</p>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- end main-content -->
@push('scripts')
<script src="https://www.youtube.com/player_api"></script>
<script>
  $( window ).load(function() {
  players = new Array();

  function onYouTubeIframeAPIReady() {
      var temp = $("iframe.yt_players");
      for (var i = 0; i < temp.length; i++) {
          var t = new YT.Player($(temp[i]).attr('id'), {
              events: {
                  'onStateChange': onPlayerStateChange
              }
          });
          players.push(t);
      }

  }



    /*$("#subtab2").html($('.append-content1').html());    
    $('.append-content1').remove();

    $("#subtab3").html($('.append-content2').html());    
    $('.append-content2').remove();*/

  // });
  
  onYouTubeIframeAPIReady();

  function onPlayerStateChange(event) {

      if (event.data == YT.PlayerState.PLAYING) {
          var temp = event.target.a.src;
          var tempPlayers = $("iframe.yt_players");
          for (var i = 0; i < players.length; i++) {
              if (players[i].a.src != temp) players[i].pauseVideo();
          }
      }
  }

  });

</script>
<script>

  jQuery(document).ready(function($) {

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var iframes = $(e.relatedTarget.hash).find('iframe');
        iframes.each(function(index, iframe){
          $(iframe).attr("src", $(iframe).attr("src"));
        });
      });

    $('#end_period_video').on('input', function(e) {
      e.preventDefault();
      var $this = $(this),
          category = $this.val();
          $('iframe').each(function(index, iframe){
            $(iframe).attr("src", $(iframe).attr("src"));
          });
          
          if (category == '0') {
            $('.all_videos').show();
          } else {
            var catClass = category.replace(/ /g,"_");
            $('.all_videos').hide();
            $('.category_'+catClass).show();
          }
    });

    $('#end_period_images').on('input', function(e) {
        e.preventDefault();
        var $this = $(this),
        category = $this.val();
        console.log(category)
        if (category == '0') {
          $('.all_images').show();
          let left = 0
          $.each($(".all_images"), function () {
              $(this).css("left", left)
              left += 285
          })
        } else {
          var catClass = category.replace(/ /g,"_");
          $('.all_images').hide();
          $('.image_category_'+catClass).show();
          let left = 0
          $.each($(".all_images:visible"), function () {
              $(this).css("left", left)
              left += 285
          })
        }
    });

    $('#end_period_document').on('input', function(e) {
      e.preventDefault();
        var $this = $(this),
          category = $this.val();
          if (category == '0') {
            $('.all_documents').show();
            let left = 0
            $.each($(".all_documents"), function () {
                $(this).css("left", left)
                left += 285
            })
          } else {
            var catClass = category.replace(/ /g,"_");
            $('.all_documents').hide();
            $('.document_category_'+catClass).show();
            let left = 0
            $.each($(".all_documents:visible"), function () {
                $(this).css("left", left)
                left += 285
            })
          }
    });

  });
</script>
@endpush

@stop