@extends('layout.master')

@section('pageTitle', 'البحوث')
@section('pageStyle')
    {{--include here the style of the current page--}}
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{!! asset('assets/global/plugins/datatables/datatables.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css') !!}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('pageTitle', 'الرئيسية')


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
                    <a href="{{route('portalwelcome')}}">الرئيسية</a>
                        <i class="fa fa-angle-left"></i>
                    </li>
                    <li>
                            <i class="icon-chemistry"></i>
                        <span>ادارة البحوث</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->

         
            <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-graduation font-dark"></i>
                            <span class="caption-subject bold uppercase">لائحة البحوث بالنظام  </span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                            <thead>
                                <tr>
                                    
                                    <th class="all">الاسم</th>
                                    <th class="none">الاختصار</th>
                                    <th class="all">القسم</th>
                                    <th class="all">المبحث</th>
                                    <th class="all">الباحث</th>
                                    <th class="none"> الترتيب</th>
                                    <th class="all">الملف</th>
                                    <th class="all">الحالة</th>
                                    <th class="all">خيارات.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($searchs as $search)
                                <tr>
                                    
                                    <td>{{$search->Name}}</td>
                                    <td>{{$search->Alias}}</td>
                                    <td>{{$search->division->Name}}</td>
                                    <td>{{$search->divisionunit->Name}}</td>
                                    <td>{{$search->searcher->Fistname}} {{$search->searcher->LastName}}</td>
                                    <td>{{$search->Order}}</td>
                                    <td>
                                        <a href="{{ url('storage/searchs/'.$search->SearchURL) }}" >تحميل</a>
                                    </td>
                                    <td>  @if($search->Progress=='تم الرفع') 
                                        <span class="badge badge-warning">{{$search->Progress}}</span>
                                        @elseif($search->Progress=='رفض الادارة' || $search->Progress=='رفض المشرف' ) 
                                        <span class="badge badge-danger">{{$search->Progress}}</span>
                                        @elseif($search->Progress=='موافقة المشرف' || $search->Progress=='موافقة الادارة' ) 
                                        <span class="badge badge-success">{{$search->Progress}}</span>
                                        @endif                                    
                                    </td>
                                    <td>
                                        <div class="btn-group pull-right">
                                            <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">اختر
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                              
                                                <li>
                                                <a data-toggle="confirmation"
                                                data-btn-ok-label="نعم" data-btn-ok-class="btn-success"
                                                data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check"
                                                data-btn-cancel-label="لا" data-btn-cancel-class="btn-danger"
                                                data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close"
                                                data-title="هل تريد الموافقة ؟" href="{{route('updateProgressok',['id'=>$search->ID])}}">
                                                        <i class="fa fa-check"></i> موافقة الادارة </a>
                                                </li>
                                                <li>
                                                        <a data-toggle="confirmation"
                                                        data-btn-ok-label="نعم" data-btn-ok-class="btn-success"
                                                        data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check"
                                                        data-btn-cancel-label="لا" data-btn-cancel-class="btn-danger"
                                                        data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close"
                                                        data-title="هل تريد الرفض ؟" href="{{route('updateProgressko',['id'=>$search->ID])}}">
                                                                <i class="fa fa-close"></i> رفض الادارة </a>
                                                        </li>

                                            </ul>
                                        </div>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


        </div>
</div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    @section('pageScript')
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{!! asset('assets/global/scripts/datatable.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('assets/global/plugins/datatables/datatables.min.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}" type="text/javascript"></script>
         <script src="{!! asset('assets/pages/scripts/table-datatables-responsive.min.js') !!}" type="text/javascript"></script>

        <!-- END PAGE LEVEL PLUGINS -->
    @endsection
@endsection