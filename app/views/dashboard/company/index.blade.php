
@extends('dashboard.main')
 @section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
     <!-- Breadcrumb -->
     <div class="ecommerce-title">
       <div class="row">
         <div class="col s12 m9 l10">
           {{--<h1>{{ $title }}</h1>--}}
           {{--<nav>--}}
             {{--<ul class="left">--}}
            {{--<li>--}}
            {{--<a href="/admin/hr">شئون العاملين </a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="/admin/accounts">الحسابات </a>--}}
            {{--</li>--}}
               {{--<li>--}}
               {{--<a href="/admin/product">الاصناف </a>--}}
               {{--</li>--}}
               {{--<li class="active"  >--}}
               {{--<a href="/admin/setting">بيانات الموقع</a>--}}
               {{--</li>--}}
                {{--<li>--}}
               {{--<a href="/admin">الرئيسية</a>--}}
               {{--</li>--}}
             {{--</ul>--}}
           {{--</nav>--}}

         </div>

       </div>
     </div>
     <!-- /Breadcrumb -->
 <!-- Store Settings  بيانات الشركة  -->


    <div class="card {{ isset($miniComInfo)?$miniComInfo:"minimized" }}">
      <div class="title">
        <h5><i class="fa fa-cog"></i>  @lang('main.companyInfo')</h5>
        <a class="minimize" href="#">
          <i class="mdi-navigation-expand-less"></i>
        </a>
      </div>
      <div class="content">
          {{ Form::model($companyInfo, array('route'=>array('updateCompanyInfo',Auth::user()->co_id),'data-parsley-validate')) }}

        <div class="row no-margin-top">
          <div class="col s12 l1">
            <label for="ecommerce-name">
                @lang('main.companyName')
            </label>
          </div>
          <div class="col s12 m6 l5">
            <div class="input-field">
              <i class="mdi mdi-action-home prefix"></i>
                <?php $companyName=Lang::get('main.companyName') ?>
              {{--<input name="co_name" id="ecommerce-name" type="text" placeholder="اسم الشركة">--}}
                {{ Form::text('co_name',null,array('required','placeholder'=>$companyName)) }}
            </div>
          </div>


          <div class="col s12 l1">
            <label for="ecommerce-adress">
                @lang('main.address')
            </label>
          </div>
          <div class="col s12 l5">
            <div class="input-field">
              <i class="mdi mdi-action-language prefix"></i>
                <?php $address=Lang::get('main.address') ?>
                {{ Form::text('co_address',null,array('required','placeholder'=>$address)) }}
                {{--<input name="co_adress" id="ecommerce-adress" type="text" placeholder="العنوان">--}}
            </div>
          </div>
        </div>

         <div class="row no-margin-top">
          <div class="col s12 l1">
            <label for="ecommerce-tel">
                @lang('main.phoneNum')
            </label>
          </div>
          <div class="col s12 l5">
            <div class="input-field">
              <i class="mdi mdi-communication-phone prefix"></i>
                <?php $phoneNum=Lang::get('main.phoneNum') ?>
                {{--<input name="co_tel" id="ecommerce-tel" type="text" placeholder="رقم الهاتف ">--}}
                {{ Form::text('co_tel',null,array('required','placeholder'=>$phoneNum)) }}

            </div>
          </div>


          <div class="col s12 l1">
              <?php $print_size=Lang::get('main.print_size') ?>
             {{ Form::label('ecommerce-printsize',$print_size) }}
                 </div>

             <div class="col s12 l5">

             <div class="input-field">


                 {{ Form::select('co_print_size', array('' => lang::get('main.print_size')) + $print_size_types,null,array('id'=>'ecommerce-printsize')) }}

                 <p dir="rtl" class="parsley-required">{{ $errors ->first('br_id') }} </p>
             </div>
          </div>
        </div>

        <div class="row">
          <div class="col s12 l1">
            <label for="ecommerce-currency">
                @lang('main.currency')
            </label>
          </div>
          <div class="col s12 l5">
            <div class="input-field">
              <i class="mdi mdi-editor-attach-money prefix"></i>
                <?php $currency=Lang::get('main.currency') ?>
                {{--<input name="co_carrency" id="ecommerce-currency" type="text" placeholder="العملة">--}}
            {{ Form::text('co_currency',null,array('required','placeholder'=>$currency)) }}
            </div>

          </div>
        </div>
          <hr />
                <div class="row">
          <div class="col s12 l2" style="padding-bottom:2% ">
            <label for="">
                @lang('main.settingSit')
            </label>
            </div>
                </div>

          <div class="row">
              <div class="col s12 l5">

            {{ Form::checkbox('co_use_serial', 1,null,array('id'=>'co_use_serial')) }}
          <label for="co_use_serial">@lang('main.co_use_serial')</label>
              </div>
              <div class="col s12 l5">
            {{ Form::checkbox('co_supplier_must', 1,null,array('id'=>'co_supplier_must')) }}
          <label for="co_supplier_must">@lang('main.co_supplier_must')</label>
                </div>
          </div>{{--end row --}}

          <div class="row">
              <div class="col s12 l5">

            {{ Form::checkbox('co_use_season', 1,null,array('id'=>'co_use_season')) }}
            <label for="co_use_season">@lang('main.co_use_season')</label>
              </div>
              <div class="col s12 l5">

            {{ Form::checkbox('co_use_markes_models', 1,null,array('id'=>'co_use_markes_models')) }}
            <label for="co_use_markes_models">@lang('main.co_use_markes_models')</label>
            </div>
              </div>



      <div class="row">
        <div class="col s12 l10" style="padding:2%;">

            <button  class="waves-effect btn">@lang('main.edit') </button>
            {{ Form::close() }}
        </div>
    </div>


      </div>

    </div>
    <!-- /Store Settings -->


    {{--<!-- Owner Information بيانات المالك  -->--}}
    {{--<div class="card minimized">--}}
      {{--<div class="title">--}}
        {{--<h5><i class="mdi mdi-social-person"></i> معلومات المالك</h5>--}}
        {{--<a class="minimize" href="#">--}}
          {{--<i class="mdi-navigation-expand-less"></i>--}}
        {{--</a>--}}
      {{--</div>--}}
      {{--<div class="content">--}}

        {{--<div class="row no-margin-top">--}}
          {{--<div class="col s12 l2">--}}
            {{--<label for="ecommerce-account-fname">--}}
              {{--الاسم--}}
            {{--</label>--}}
          {{--</div>--}}
          {{--<div class="col s12 m6 l4">--}}
            {{--<div class="input-field">--}}
              {{--<i class="mdi mdi-social-person prefix"></i>--}}
              {{--<input id="ecommerce-account-fname" type="text" placeholder="برجاء ادخال الاسم">--}}
            {{--</div>--}}
          {{--</div>--}}
          {{--<div class="col s12 m6 l5">--}}
            {{--<div class="input-field">--}}
              {{--<i class="mdi mdi-social-person prefix"></i>--}}
              {{--<input id="ecommerce-account-lname" type="text" placeholder="برجاء ادخال لقب العائلة">--}}
            {{--</div>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="row">--}}
          {{--<div class="col s12 l2">--}}
            {{--<label for="ecommerce-account-email">--}}
              {{--البريد الاكتروني--}}
            {{--</label>--}}
          {{--</div>--}}
          {{--<div class="col s12 l4">--}}
            {{--<div class="input-field">--}}
              {{--<i class="mdi mdi-communication-email prefix"></i>--}}
              {{--<input id="ecommerce-account-email" type="text" placeholder="عنوان برديك الاكتروني ">--}}
            {{--</div>--}}
          {{--</div>--}}

          {{--<div class="col s12 l1">--}}
            {{--<label for="ecommerce-account-phone">--}}
              {{--رقم الهاتف--}}
            {{--</label>--}}
          {{--</div>--}}
          {{--<div class="col s12 l4">--}}
            {{--<div class="input-field">--}}
              {{--<i class="mdi mdi-communication-phone prefix"></i>--}}
              {{--<input id="ecommerce-account-phone" type="text" placeholder="رقم الهاتف">--}}
            {{--</div>--}}
          {{--</div>--}}
        {{--</div>--}}
     {{--<div class="row">--}}
          {{--<div class="col s12 l2">--}}
            {{--<label for="ecommerce-account-phone">--}}
        {{--رقم الموبيل--}}
            {{--</label>--}}
          {{--</div>--}}
          {{--<div class="col s12 l4">--}}
            {{--<div class="input-field">--}}
              {{--<i class="mdi mdi-communication-phone prefix"></i>--}}
              {{--<input id="ecommerce-account-phone" type="text" placeholder="رقم الموبيل ">--}}
            {{--</div>--}}
                  {{--<div class="row">--}}
                    {{--<div class="col s12 l12">--}}


                        {{--<button class="waves-effect btn">تعديل </button>--}}
                    {{--</div>--}}
                {{--</div>--}}
          {{--</div>--}}

     {{--</div>--}}

      {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /Owner Information -->--}}
 <!-- الفروع -->

        <div class="card {{ isset($miniBranch)?$miniBranch:"minimized" }}">
          <div class="title">
            <h5><i class="mdi mdi-notification-event-available"></i> @lang('main.branches')</h5>
            <a class="minimize" href="#">
              <i class="mdi-navigation-expand-less"></i>
            </a>
          </div>
          <div class="content">
             @if(Route::currentRouteName() == "editBranch" )
                  {{ Form::open(array('route'=>array('updateBranch',$branch->id),'data-parsley-validate')) }}
                 @else
              {{ Form::open(array('route'=>array('storeBranch'),'data-parsley-validate')) }}
                @endif
              <div class="row no-margin-top">
          <div class="col s12 l2">
            <label for="branch-name">
                @lang('main.branchName')
            </label>
          </div>
          <div class="col s12 m6 l6">
            <div class="input-field">
              <i class="mdi mdi-social-person prefix"></i>
              <input value="{{ isset($branch->br_name)?$branch->br_name:null }}" name="branch_name" id="branch-name" type="text" placeholder=@lang('main.branchName')>
            </div>
          </div>

        </div>
                <div class="row no-margin-top">
                  <div class="col s12 l2">
                    <label for="branch-address">
                        @lang('main.branchAddress')
                    </label>
                  </div>
                  <div class="col s12 m6 l8">
                    <div class="input-field">
                      <i class="mdi mdi-social-person prefix"></i>
                      <input  value="{{ isset($branch->br_address)?$branch->br_address :null }}" name="branch_address" id="branch-address" type="text" placeholder= @lang('main.branchAddress')>
                    </div>
                  </div>

                </div>

                  <div class="row">
{{ form::close() }}


                      <div class="col s12 l12">
                          @if(Route::currentRouteName() == "editBranch" )
                              <button class="waves-effect btn">@lang('main.edit')</button>
                          @else
                              <button class="waves-effect btn">@lang('main.add') </button>
                          @endif
                      </div>
                </div>
        <!-- /عرض الفروع -->
@include('dashboard.company._branches_table_view')
          </div>
        </div>
        <!-- /Store Policies -->

  </section>
  <!-- /Main Content -->


  @stop