@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<?php session_start() ?>
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
                     <li class="active text-gray-silver">@t('My Online School')</li>
                  </ol>
                  <h2 class="title text-white">@t('My Online School')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: about -->
   <section class="divider">
      <div class="container">
         <div class="row pt-30 <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?>">
            <div class="col-md-12">
                <a href="{{ lang_url('schools') }}" style="margin-bottom: 20px; display: block" class="btn btn-dark btn-xl btn-blue pull-left">@t('Back to Schools Page')</a>
               <table id="school-Datatable" class="display custom-table table-bordered" width="100%">
                  <thead>
                     <tr>
                        <th style="text-align: center">@t('Sr') #</th>
                        <th style="text-align: center">@t('Test Name')</th>
                        <th style="text-align: center">@t('Minimum Percentage')</th>
                        <th style="text-align: center">@t('My Percentage')</th>
                        <th style="text-align: center">@t('Result')</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (count($allTests) > 0): ?>
                     <?php foreach ($allTests as $key => $allTest): ?>
                     <tr>
                        <?php
                        $question = \App\TestQuestion::where("exam_id", "=", $allTest->exam_id)->count();
                        $correct_answers = DB::table('test_answers_users')->where(["user_id" => \Auth::user()->id, "exam_id" => $allTest->exam_id, "answer_status" => 1])->count();
                        $perc = $correct_answers / $question;
                        ?>
                        <td style="text-align: center">{{ $key + 1 }}</td>
                        <td style="text-align: center">{{ $allTest->exam->exam_title }}</td>
                        <td style="text-align: center">{{ $allTest->exam->min_pass }} %</td>
                        <td style="text-align: center">{{ $allTest->percentage }} %</td>
                        <?php if (request()->segments()[0]) : ?>
                           <td style="text-align: center">{{ ($allTest->exam->min_pass > $allTest->percentage) ? "لم ينجح" : "تم الاجتياز بنجاح" }}</td>
                        <?php else : ?>
                           <td style="text-align: center">{{ ($allTest->exam->min_pass > $allTest->percentage) ? "Not passed" : "Passed" }}</td>
                        <?php endif; ?>
                     </tr>
                     <?php endforeach ?>
                     <?php endif ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="separator separator-rounedd"></div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop