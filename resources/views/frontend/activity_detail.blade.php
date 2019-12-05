<?php use App\User; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
    <div class="main-content">
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
                 data-bg-img="/frontend/_assets/images/breadcrumb-bg.png">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb text-right text-black mb-0 mt-40">
                                <li><a href="{{ lang_url('') }}">@t('Home')</a></li>
                                <li class="active text-gray-silver">@t('Activity Detail')</li>
                            </ol>
                            <h2 class="title text-white">@t('Activity Detail')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container pb-50">
            <div class="main-heading-overview">
                <a href="#" class="resp-menu" onclick="openNav()">☰</a>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ lang_url('training_activities') }}" style="margin-bottom: 20px; display: block" class="btn btn-dark btn-xl btn-blue pull-left">@t('Back to Training Activities Page')</a>
                    </div>
                    <div class="col-md-12">
                        <div class="elegant-special-heading-wrapper">
                            <h2 class="special-heading-title" style="color: #41a161;">@t('Activity Detail')</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="podcast-detail pt-5 pb-5" style="padding: 10px 0 ">
                <div class="row">
                    <div class="col-md-12" style="overflow-x: scroll;">
                        <table class="activity-detail table-bordered">
                            <thead>

                            <tr>
                                <th>@t('Event Subject')</th>
                                <th>@t('Subscription date')</th>
                                <th>@t('Event Type')</th>
                                <th>@t('Event Classification')</th>
                                <th>@t('Online Link')</th>
                                <th>@t('Venue')</th>
                                <th>@t('Days')</th>
                                <th>@t('Event Date')</th>
                                <!-- <th>Period (days)</th> -->
                                <th>@t('Hours')</th>
                                <th>@t('Price (SAR)')</th>
                                <th>@t('Paid (SAR)')</th>
                                <th>@t('Balance (SAR)')</th>
                                <th>@t('Payment Status')</th>
                                <th>@t('Number of students')</th>
                                <th>@t('Status')</th>
                                <?php if ($training_activity->payment_status == 'Partially Paid'): ?>
                                <th>@t('Pay Remaining')</th>
                                <?php endif ?>
                            </tr>

                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $training_activity->name }}</td>
                                <td>
                                    <?php
                                    $dt = new DateTime($training_activity->enroll_date);
                                    echo $dt->format('d-m-Y');
                                    ?>
                                </td>
                                <td>{{ ucwords(str_replace('_', ' ', $training_activity->type)) }}</td>
                                <?php if (request()->segments()[0] == "ar") : ?>
                                    <td>@t('online')</td>
                                <?php else : ?>
                                    <td>{{ $training_activity->classification }}</td>
                                <?php endif; ?>
                                <td class="half-gray"><a style="color:blue;" href="{{ $training_activity->zoom_link }}">Click
                                        here</a></td>
                                <?php if (request()->segments()[0] == "ar") : ?>
                                    <td>@t('online')</td>
                                <?php else : ?>
                                    <td>{{ $training_activity->location }}</td>
                                <?php endif; ?>
                                <td>
                                    <?php
                                    $start = new DateTime($training_activity->start_date);
                                    $end = new DateTime($training_activity->end_date);
                                    $days = $start->diff($end);
                                    echo $days->days;
                                    ?>
                                </td>
                                <td>
                                    <?php

                                    $dt = new DateTime($training_activity->start_date);
                                    echo $dt->format('d-m-Y');

                                    ?>
                                </td>
                            <!-- <td>{{-- $training_activity->days --}}</td> -->
                                <td>
                                    <?php $hours = explode(":", $training_activity->hours) ?>
                                   {{ $hours[0].":".$hours[1] }}
                                </td>
                                <td>
                                    <?php

                                    $coperativeActivity = DB::table('course_subscriptions')
                                        ->join('events', 'course_subscriptions.event_id', '=', 'events.id')
                                        ->select('course_subscriptions.*', 'events.*')
                                        ->where([['events.type', $training_activity->type], ['course_subscriptions.status', 'active']])
                                        ->groupBy('course_subscriptions.user_id')
                                        ->get();

                                    ?>
                                    <?php if ($training_activity->type == 'cooperative_courses'): ?>

                                    <div class='text-success'>
                                        <b> {{ $training_activity->price/count($coperativeActivity) }} </b></div>

                                    <?php else: ?>
                                    {{ $training_activity->price }}
                                    <?php endif ?>
                                </td>
                                <td>{{ $training_activity->paid }}</td>
                                <td>
                                    <?php if ($training_activity->type == 'cooperative_courses'): ?>

                                    <?php else: ?>
                                        <?php $remaining = $training_activity->price - $training_activity->paid; ?>

                                        {{ $remaining  }}
                                    <?php endif ?>

                                </td>
                                <?php if (request()->segments()[0] == "ar") : ?>
                                    <td>@t('Fully paid')</td>
                                <?php else : ?>
                                    <td>{{ $training_activity->payment_status }}</td>
                                <?php endif; ?>
                                <td>
                                    <?php 
                                    $eventSubs = DB::table('course_subscriptions')
                                                ->select('*')
                                                ->where(["event_id" => $training_activity->event_id])
                                                ->count();
                                    ?>
                                    {{ $eventSubs }}
                                </td>
                                <?php if (request()->segments()[0] == "ar") : ?>
                                    <td>@t('Open registration')</td>
                                <?php else : ?>
                                    <td>{{ ucwords(str_replace('_', ' ', $training_activity->course_enroll_status)) }}</td>
                                <?php endif; ?>
                                <?php if ($training_activity->payment_status == 'Partially Paid'): ?>
                                <td>
                                    <a href="{{ lang_url($training_activity->event_id.'/payment_course/'.$training_activity->subscriptionID ) }}">
                                        <button class="btn btn-default">@t('Pay')</button>
                                    </a>
                                </td>
                                <?php endif ?>

                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="activity-detail-one">
                            <tr>
                                <td>@t('Coach')</td>
                                <td>
                                    <?php

                                    $coach = User::findOrFail($training_activity->coach_id);
                                    echo $coach->name . ' ' . $coach->last_name;

                                    ?>

                                </td>
                            </tr>
                            <tr>
                                <td>@t('Venue Details')</td>
                                <td>{{ $training_activity->location }}</td>
                            </tr>
                            <tr>
                                <td>@t('Description')</td>
                                <td>{{$training_activity->description}}</td>
                            </tr>
                        <!-- <tr>
           <td>Days</td>
           <td>{{-- $training_activity->days --}}</td>
         </tr> -->
                            <!-- <tr>
                              <td>Time</td>
                              <td>From 6:30 PM to 9:30 PM</td>
                            </tr>
                            <tr>
                              <td>Spesefication</td>
                              <td>Free Master File</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td>Free Book</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td>Free online access for a month</td>
                            </tr> -->
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        $image = json_decode($training_activity->attachment);
                        $video = json_decode($training_activity->video);
                        ?>
                        <?php if ($video) : ?>
                            <video src="/storage/<?= $video[0]->download_link ?>" width="350" height="280" controls></video>
                            <p style="font-size: 20px"><?= $training_activity->video_name ?></p>
                        <?php endif; ?>
                        <?php if ($image) : ?>
                            <img src="/storage/<?= $image[0]->download_link ?>" >
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row mt-20">
                    <div class="col-sm-12">
                        @if($additionalRecords)
                            @foreach($additionalRecords as $record)
                                <?php if ($record->video) : ?>
                                    <div class="col-sm-4">
                                        <video src="/storage/events/videos/<?= $record->video ?>" width="350" height="280"
                                               controls></video>
                                        <div><?= $record->name ?></div>
                                        <div class="attach">
                                            <a style="color: blue" href="/storage/events/attachments/<?= $record->attachment ?>"
                                               download>
                                                @t('Download Attachment')
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop