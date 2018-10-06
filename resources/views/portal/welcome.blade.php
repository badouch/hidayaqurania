@extends('layout.master')

@section('pageTitle', 'الرئيسية')
@section('pageStyle')
    {{--include here the style of the current page--}}
@endsection



@section('content')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->


            <h1 class="page-title"> البوابة الالكترونية لموسوعة الهدايات القرآنية

            </h1>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="index.html">الرئيسية</a>
                        <i class="fa fa-angle-left"></i>
                    </li>
                    <li>
                        <span>إدارة الباحثين</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->

            <div class="note note-info">
                <p> هذه الصفحة الرئيسية للبوابة الالكترونية </p>
            </div>



        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

@endsection