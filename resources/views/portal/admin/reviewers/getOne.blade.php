@extends('layout.master')

@section('pageTitle', 'الموسوعة العالمية للهدايات القرآنية')
@section('pageStyle')
    {{--include here the style of the current page--}}
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{!! asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')!!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('assets/pages/css/profile-rtl.min.css')!!}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('pageTitle', 'الرئيسية')


@section('content')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->



            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                    <a href="{{route('portalwelcome')}}">الرئيسية</a>
                        <i class="fa fa-angle-left"></i>
                    </li>
                    <li>
                            <i class="icon-user"></i>
                        <span>معلومات الباحث المساعد</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->

         
            <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet ">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                @if($registration->PictureURL == null)

                                @else
                                <img src="{{ asset('storage/registrations/default.jpg') }}" class="img-responsive" alt="">
                                @endif
                            </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> {{$registration->Fistname}} {{$registration->LastName}}</div>
                                <div class="profile-usertitle-job"> محكم </div>
                            </div>

                            <div class="profile-userbuttons">
                                <a type="button"  href=" {{ url('https://api.whatsapp.com/send?phone='.$registration->Phonne2) }}" target="_blank" class="btn btn-circle green btn-sm">تواصل عبر الواتس</a>
                                <a type="button"  href=" {{ url('mailto:'.$user->email.'?subject=موسوعة الهدايات القرآنية') }}" target="_blank" class="btn btn-circle red btn-sm">ارسال بريد الكتروني</a>

                             </div>

                            <!-- END SIDEBAR USER TITLE -->
                           
                            <!-- SIDEBAR MENU -->
                            <div class="profile-usermenu">
                                <ul class="nav">
                                   
                                    <li class="active">
                                            <a href="{{route('getAllReviewerSearchs',['id'=>$registration->ID])}}">
                                            <i class="icon-settings"></i> الابحاث </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END MENU -->
                        </div>
                        <!-- END PORTLET MAIN -->
                      
                    </div>
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light ">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <div class="caption-subject font-yellow-madison bold uppercase">حساب المحكم </div>

                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">معلومات شخصية</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                <form role="form" class="form-horizontal" action="{{route('reviewerProfileEdit')}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id_registration" value="{{$registration->ID}}" />



                                                    <h4 class="block myfont">معلومات أساسية</h4>



                                                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">الاسم الأول </label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="الاسم كاملا" data-container="body"></i>
                                                                <input required value="{{$registration->Fistname}}" class="form-control placeholder-no-fix" type="text" placeholder="الاسم العائلي" name="firstname" />
                                                                @if ($errors->has('firstname'))
                                                                    <span class="help-block">
                                                            <strong>{{ 'المرجو ادخال الاسم '}}</strong>
                                                            </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">اللقب</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="اسم العائلة" data-container="body"></i>
                                                                <input required value="{{$registration->LastName}}"  class="form-control placeholder-no-fix" type="text" placeholder="الاسم الشخصي" name="lastname" />
                                                                @if ($errors->has('lastname'))
                                                                    <span class="help-block">
                                                            <strong>{{ 'المرجو ادخال  اللقب'}}</strong>
                                                        </span>
                                                                @endif
                                                            </div>
                                                    </div>
                                                    </div>




                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">الجنس</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="الجنس" data-container="body"></i>
                                                                <select name="gender" class="form-control">
                                                                    <option @if($registration->Gender=='ذكر') selected @endif value="ذكر"> ذكر</option>
                                                                    <option @if($registration->Gender=='أنثى') selected @endif value="أنثى"> أنثى</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>





                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">تاريخ الميلاد </label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="تاريخ الميلاد" data-container="body"></i>
                                                                <input required value="{{$registration->BirthDate}}" class="form-control placeholder-no-fix" type="date" placeholder="تاريخ الولادة" name="birthdate" />

                                                            </div>
                                                        </div>
                                                    </div>





                                                    <div class="form-group{{ $errors->has('BirthCity') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">مكان الميلاد </label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="مكان الميلاد" data-container="body"></i>
                                                                <input required value="{{$registration->BirthCity}}" class="form-control placeholder-no-fix" type="text" placeholder="مكان الميلاد" name="BirthCity" />
                                                                @if ($errors->has('BirthCity'))
                                                                    <span class="help-block">
                                                            <strong>{{ 'المرجو ادخال مكان الميلاد'}}</strong>
                                                        </span>
                                                                @endif
                                                            </div>

                                                            </div>
                                                        </div>




                                                    <div class="form-group{{ $errors->has('nationalitie') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">الجنسية</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="الجنسية" data-container="body"></i>
                                                                <select name="nationalitie" class="form-control">
                                                                    @foreach($nationalities as $nationalitie)
                                                                        <option @if($registration->Nationalitie==$nationalitie->ID) selected @endif value="{{$nationalitie->ID}}">{{$nationalitie->Name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="form-group{{ $errors->has('PassportNumber') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">رقم جواز السفر</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="رقم جواز السفر" data-container="body"></i>
                                                                <input required value="{{$registration->PassportNumber}}" class="form-control placeholder-no-fix" type="text" placeholder="رقم جواز السفر" name="PassportNumber" />
                                                                @if ($errors->has('PassportNumber'))
                                                                    <span class="help-block">
                                                            <strong>{{ 'المرجو ادخال رقم الجواز'}}</strong>
                                                        </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="form-group{{ $errors->has('NationalNumber') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">رقم الهوية الوطنية</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="رقم الهوية" data-container="body"></i>
                                                                <input required value="{{$registration->NationalNumber}}" class="form-control placeholder-no-fix" type="text" placeholder="الرقم الوطني" name="NationalNumber" />
                                                                @if ($errors->has('NationalNumber'))
                                                                    <span class="help-block">
                                                            <strong>{{ 'المرجو ادخال رقم الهوية الوطنية'}}</strong>
                                                        </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>






                                                    <hr>




                                                    <h4 class="block myfont">معلومات الإقامة</h4>



                                                    <div  class="form-group{{ $errors->has('countrie') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">دولة الإقامة</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="دولة الإقامة" data-container="body"></i>
                                                                <select name="countrie" class="form-control">
                                                                    @foreach($countries as $countrie)
                                                                        <option @if($registration->Countrie==$countrie->ID) selected @endif value="{{$countrie->ID}}">{{$countrie->Name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="form-group{{ $errors->has('city1') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">مدينة الإقامة</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="مدينة الإقامة" data-container="body"></i>
                                                                <input required value="{{$registration->City}}" class="form-control placeholder-no-fix" type="text" placeholder="المدينة" name="city1" />

                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">العنوان</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="العنوان" data-container="body"></i>
                                                                <input required value="{{$registration->Location}}" class="form-control placeholder-no-fix" type="text" placeholder="العنوان" name="location" />
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <hr>


                                                    <h4 class="block myfont">معلومات المؤهل العلمي</h4>


                                                    <div class="form-group{{ $errors->has('University') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">الجامعة</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="الجامعة" data-container="body"></i>
                                                                <input required value="{{$registration->University}}" class="form-control placeholder-no-fix" type="text" placeholder="الجامعة" name="University" />
                                                            </div>
                                                        </div>
                                                    </div>






                                                    <div class="form-group{{ $errors->has('Faculty') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">الكلية</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="الكلية" data-container="body"></i>
                                                                <input required value="{{$registration->Faculty}}" class="form-control placeholder-no-fix" type="text" placeholder="الكلية" name="Faculty" />
                                                            </div>
                                                        </div>
                                                    </div>






                                                    <div class="form-group{{ $errors->has('CertificateType') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">نوع الشهادة</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="نوع الشهادة" data-container="body"></i>
                                                                <input required value="{{$registration->CertificateType}}" class="form-control placeholder-no-fix" type="text" placeholder="نوع الشهادة" name="CertificateType" />
                                                            </div>
                                                        </div>
                                                    </div>







                                                    <div class="form-group{{ $errors->has('CertificateType') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">الدرجة العلمية</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="الدرجة العلمية" data-container="body"></i>
                                                                <input required value="{{$registration->CertificateDegree}}" class="form-control placeholder-no-fix" type="text" placeholder="درجة الشهادة" name="CertificateDegree" />
                                                            </div>
                                                        </div>
                                                    </div>






                                                    <div class="form-group{{ $errors->has('InscriptionDate') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">تاريخ التسجيل</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="تاريخ التسجيل" data-container="body"></i>
                                                                <input required value="{{$registration->InscriptionDate}}" class="form-control placeholder-no-fix" type="date" placeholder="تاريخ التسجيل" name="InscriptionDate" />
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <hr>



                                                    <h4 class="block myfont">معلومات الاتصال</h4>

                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">البريد الالكتروني الخاص بالحساب</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="البريد الالكتروني" data-container="body"></i>
                                                            <input class="form-control placeholder-no-fix" type="email" autocomplete="off" required value="{{$user->email}}" placeholder="البريد الالكتروني" name="Email"  />
                                                               
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('Phonne1') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">رقم الهاتف 1</label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="رقم الهاتف 1" data-container="body"></i>
                                                                <input required value="{{$registration->Phonne1}}" class="form-control placeholder-no-fix" type="text" placeholder="رقم الهاتف 1" name="Phonne1" />
                                                            </div>
                                                        </div>
                                                    </div>







                                                    <div class="form-group{{ $errors->has('Phonne2') ? ' has-error' : '' }}">
                                                        <label class="col-md-2 control-label">رقم الواتس اب </label>
                                                        <div class="col-md-10">
                                                            <div class="input-icon right">
                                                                <i class="fa fa-info-circle tooltips" data-original-title="رقم الهاتف 2" data-container="body"></i>
                                                                <input required value="{{$registration->Phonne2}}" class="form-control placeholder-no-fix" type="text" placeholder="رقم الهاتف 2" name="Phonne2" />
                                                            </div>
                                                        </div>
                                                    </div>


                                    
                                                  
                                                </form>
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->





                                            


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>


        </div>
</div>
        <!-- END CONTENT BODY -->
    </div>
        </div>
    <!-- END CONTENT -->
    @section('pageScript')
        <!-- BEGIN PAGE LEVEL PLUGINS -->
     
         <script src="{!! asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')!!}" type="text/javascript"></script>
         <script src="{!! asset('assets/global/plugins/jquery.sparkline.min.js')!!}" type="text/javascript"></script>
         <script src="{!! asset('assets/pages/scripts/profile.min.js')!!}" type="text/javascript"></script>
       
        <!-- END PAGE LEVEL PLUGINS -->
    @endsection
@endsection