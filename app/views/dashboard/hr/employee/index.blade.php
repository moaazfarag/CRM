@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    @if(Route::currentRouteName() == 'addEmp')
        {{ Form::open(array('route'=>array('storeEmp'),'files'=>'true')) }}
    @elseif(Route::currentRouteName() == 'editEmp')
        {{ Form::model($employee,array('route'=>array('updateEmp',$employee->id),'files'=>'true')) }}
    @endif
    @if(PerC::isShow('hr','Employees','edit','editEmp')||PerC::isShow('hr','Employees','add','addEmp'))
        <div class=" card ">
            <div class="title">
                <h5>
                    <i class="fa fa-cog"></i> @lang('main.addEmployee')  </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content">
                @include('include.messages')

                <div class="row no-margin-top">
                    <div class="col s12 l6">
                        <div class="input-field">
                            <i class="mdi mdi-action-account-box prefix"></i>
                            {{ Form::text('name',null,array('data-parsley-id'=>'4370','class'=>($errors->first('name'))?'parsley-error':null,'required','id'=>'name',)) }}
                            {{ Form::label('name',lang::get('main.employe_name'))     }}
                            <p class="parsley-required">{{ $errors ->first('name') }} </p>
                        </div>
                    </div>
                    <div class="col s12 l5">
                        <div class="input-field">
                            <i class="fa fa-calendar prefix"></i>
                            {{ Form::text('employee_date',null,array('data-parsley-id'=>'4370','class'=>($errors->first('employee_date'))?'parsley-error pikaday':'pikaday','required','id'=>'employee_date')) }}
                            <p class="parsley-required">{{ $errors ->first('employee_date') }} </p>

                            <label for="employee_date">
                                ت التعيين
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l6">
                        <div class="input-field">
                            <i class="mdi mdi-av-web prefix"></i>
                            {{ Form::number('card_no',null,array('data-parsley-id'=>'4370','class'=>($errors->first('card_no'))?'parsley-error':null,'required','id'=>'card_no','length'=>"14")) }}
                            {{ Form::label('card_no',lang::get('main.national_id'))     }}
                            <p class="parsley-required">{{ $errors ->first('card_no') }} </p>
                        </div>
                    </div>
                    <div class="col s12 l5">
                        <div class="input-field">
                            <i class="mdi mdi-av-subtitles prefix"></i>

                            {{ Form::text('ins_no',null,array('data-parsley-id'=>'4370','class'=>($errors->first('ins_no'))?'parsley-error':null,'id'=>'ins_no',)) }}
                            {{ Form::label('ins_no',lang::get('main.insurance_number'))  }}
                            <p class="parsley-required">{{ $errors ->first('ins_no') }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l2">
                        <div class="input-field">


                            {{ Form::select('br_id', array('' => lang::get('main.branch')) + $co_info->branches->lists('br_name','id'),null,array('id'=>'br_id')) }}

                            <p dir="rtl" class="parsley-required">{{ $errors ->first('br_id') }} </p>
                        </div>
                    </div>
                    <div class="col s12 l3">
                        <div class="input-field">
                            {{ Form::select('job_id', array('' => lang::get('main.position')) + $co_info->jobs->lists('name','id'),null,array('id'=>'job_id')) }}
                            <p class="parsley-required">{{ $errors ->first('job_id') }} </p>
                        </div>
                    </div>
                    <div class="col s12 l3">
                        <div class="input-field">
                            {{ Form::select('department_id', array('' => lang::get('main.departments')) + $co_info->departments->lists('name','id'),null,array('id'=>'department_id')) }}
                            <p class="parsley-required">{{ $errors ->first('department_id') }} </p>
                        </div>
                    </div>
                    <div class="col s12 l3">
                        <div class="input-field">
                            {{ Form::select('work_nature',$work_nature,null,array('id'=>'work_nature')) }}
                            <p class="parsley-required">{{ $errors ->first('work_nature') }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l2">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        <div class="input-field">
                            {{ Form::select('sex',$sex ,null,array('id'=>'sex')) }}
                            <p class="parsley-required">{{ $errors ->first('sex') }} </p>
                        </div>
                    </div>
                    <div class="col s12 l3">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        <div class="input-field">
                            {{ Form::select('marital', $marital ,null,array('id'=>'marital')) }}

                            {{--<select>--}}
                                {{--@foreach($marital as $v=>$k)--}}
                                {{--<option  value="{{ $k }}" @if($employee && $employee->marital == $v)  selected="selected" @endif >{{ $k }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                            <p class="parsley-required">{{ $errors ->first('marital') }} </p>
                        </div>
                    </div>

                    <div class="col s12 l3">
                        <div class="input-field">
                            {{ Form::select('religion',  $religion,null,array('id'=>'religion')) }}
                            <p class="parsley-required">{{ $errors ->first('religion') }} </p>
                        </div>
                    </div>
                    <div class="col s12 l3">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        <div class="input-field">
                            {{ Form::select('military_service', $military_service ,null,array('id'=>'military_service')) }}
                            <p class="parsley-required">{{ $errors ->first('military_service') }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col s12 l4">
                        <div class="input-field">
                            <i class="fa fa-money prefix"></i>
                            {{ Form::number('salary',null,array('data-parsley-id'=>'4370','class'=>($errors->first('salary'))?'parsley-error':null,'id'=>'salary', 'step'=>'0.01')) }}
                            {{ Form::label('salary',lang::get('main.salary'))     }}
                            <p class="parsley-required">{{ $errors ->first('salary') }} </p>
                        </div>
                    </div>
                    <div class="col s12 l4">
                        <div class="input-field">
                            <i class="fa fa-medkit prefix"></i>
                            {{ Form::number('ins_salary',null,array('data-parsley-id'=>'4370','class'=>($errors->first('ins_salary'))?'parsley-error':null,'id'=>'ins_salary','step'=>'0.01')) }}
                            {{ Form::label('ins_salary',lang::get('main.insurance_salary'))   }}
                            <p class="parsley-required">{{ $errors ->first('ins_salary') }} </p>
                        </div>
                    </div>
                    <div class="col s12 l3">
                        <div class="input-field">
                            <i class="mdi mdi-content-remove-circle prefix"></i>
                            {{ Form::number('ins_val',null,array('data-parsley-id'=>'4370','class'=>($errors->first('ins_val'))?'parsley-error':null,'id'=>'ins_val','step'=>'0.01')) }}
                            {{ Form::label('ins_val',lang::get('main.discount_insurance'))    }}
                            <p class="parsley-required">{{ $errors ->first('ins_val') }} </p>
                        </div>
                    </div>
                </div>
                {{--<div class="row">--}}

                {{--<div class="col s12 l4">--}}
                {{--<div class="input-field">--}}
                {{--<i class="fa fa-tag prefix"></i>--}}
                {{--{{ Form::label('cancel_date',lang::get('main.cancellation_work')) }}--}}

                {{--{{ Form::text('cancel_date',null,array('id'=>'cancel_date','class'=>'pikaday')) }}--}}
                {{--<p class="parsley-required">{{ $errors ->first('cancel_date') }} </p>--}}

                {{--</div>--}}
                {{--</div>--}}

                {{--<div class="col s12 l7">--}}
                {{--<div class="input-field" >--}}
                {{--<i class="fa fa-tag prefix"></i>--}}
                {{--{{ Form::label('cancel_cause',lang::get('main.cancellation_reason'))     }}--}}
                {{--{{ Form::text('cancel_cause',null,array('id'=>'cancel_cause','class'=>"materialize-textarea" ,'length'=>"200")) }}--}}
                {{--<p class="parsley-required">{{ $errors ->first('cancel_cause') }} </p>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}


                <div class="row">

                    <div class="col s12 l4">
                        <div class="input-field">
                            <i class="fa fa-phone-square prefix"></i>
                            {{ Form::text('tel',null,array('data-parsley-id'=>'4370','class'=>($errors->first('tel'))?'parsley-error':null,'id'=>'tel',)) }}
                            {{ Form::label('tel',lang::get('main.phone_number_1') )      }}
                            <p class="parsley-required">{{ $errors ->first('tel') }} </p>
                        </div>
                    </div>

                    <div class="col s12 l4">
                        <div class="input-field">
                            <i class="fa fa-phone prefix"></i>
                            {{ Form::text('tel2',null,array('data-parsley-id'=>'4370','class'=>($errors->first('tel2'))?'parsley-error':null,'id'=>'tel2',)) }}
                            {{ Form::label('tel2',lang::get('main.phone_number_2'))     }}
                            <p class="parsley-required">{{ $errors ->first('tel2') }} </p>
                        </div>
                    </div>
                    <div class="col s12 l3">
                        <div class="input-field">
                            <i class="fa fa-birthday-cake prefix"></i>
                            {{ Form::text('birth_date',null,array('data-parsley-id'=>'4370','class'=>($errors->first('birth_date'))?'parsley-error pikaday':'pikaday','id'=>'birth_date','class'=>'pikaday')) }}
                            {{ Form::label('birth_date',lang::get('main.birthday')) }}

                            <p class="parsley-required">{{ $errors ->first('birth_date') }} </p>
                        </div>
                    </div>
                </div>


                <div class="row">


                    <div class="col s12 l4">
                        <div class="input-field">
                            <i class="fa fa-graduation-cap  prefix"></i>
                            {{ Form::text('certificate',null,array('data-parsley-id'=>'4370','class'=>($errors->first('certificate'))?'parsley-error':null,'id'=>'certificate')) }}
                            {{ Form::label('certificate' ,lang::get('main.qualification'))   }}
                            <p class="parsley-required">{{ $errors ->first('certificate') }} </p>
                        </div>
                    </div>

                    <div class="col s12 l4">
                        <div class="input-field">
                            <i class="fa fa-institution prefix"></i>
                            {{ Form::text('cert_location',null,array('data-parsley-id'=>'4370','class'=>($errors->first('cert_location'))?'parsley-error':null,'id'=>'cert_location')) }}
                            {{ Form::label('cert_location' ,lang::get('main.face_qualification'))   }}
                            <p class="parsley-required">{{ $errors ->first('cert_location') }} </p>
                        </div>
                    </div>

                    <div class="col s12 l3">
                        <div class="input-field">
                            <i class="fa fa-calendar prefix"></i>
                            {{ Form::text('cert_date',null,array('data-parsley-id'=>'4370','class'=>($errors->first('cert_date'))?'parsley-error pikaday':'pikaday','id'=>'cert_date','class'=>'pikaday')) }}
                            {{ Form::label('cert_date',lang::get('main.date_qualification'))   }}
                            <p class="parsley-required">{{ $errors ->first('cert_date') }} </p>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col s12 l11">
                        <div class="input-field">
                            <i class="fa fa-home prefix"></i>
                            {{ Form::text('address',null,array('data-parsley-id'=>'4370','class'=>($errors->first('address'))?'parsley-error':null,'id'=>'address','length'=>"200")) }}
                            {{ Form::label('address',lang::get('main.address'))   }}
                            <p class="parsley-required">{{ $errors ->first('address') }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col s12 l11">
                        <div class="input-field">
                            <i class="fa fa-pencil-square-o prefix"></i>
                            {{ Form::textarea('remark',null,array('data-parsley-id'=>'4370','class'=>($errors->first('remark'))?'parsley-error':null,'id'=>'remark','class'=>"materialize-textarea" ,'length'=>"200")) }}
                            {{ Form::label('remark',lang::get('main.comments'))    }}
                            <p class="parsley-required">{{ $errors ->first('remark') }} </p>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col s12 l1">

                        <?php $photo = Lang::get('main.employee_photo') ?>
                        {{ Form::label('photo',$photo) }}
                    </div>
                    @if(isset($employee) && !empty($employee->photo))
                        <div class="col s12 l2">
                            <div class="imagedropshadow">
                                <img src='{{ URL::asset("$employee->photo") }}' style="width:100%; height:80px;">
                            </div>
                        </div>
                    @endif
                    <div class="col s12 l2">
                        <div class="input-field">
                            {{ Form::file('photo',null,array('required',null,@$readOnly)) }}
                            <p class="parsley-required error-validation">{{ $errors->first('photo') }} </p>
                        </div>
                    </div>
<br/>
<br/>
                </div>
                <div class="row">
                    <div class="col s12 l12">
                        @if(Route::currentRouteName() == 'addEmp')
                            {{--{{Form::submit('  اضف ')}}--}}
                            <button type="submit" class="waves-effect btn"> @lang('main.add') </button>
                            @elseif(Route::currentRouteName() == 'editEmp')
                            {{--{{Form::submit('  تعديل ')}}--}}
                                    <!-- POPUP form بنود الاستحقاقات  الثابته زرار Trigger -->
                            <a class="waves-effect waves-light btn modal-trigger" href="#addDud">
                                @lang('main.other_fixed_salary')
                            </a>

                            <!-- pop up بنود الاستحاقات الثابته -->
                            @include('dashboard.hr.employee._pop_up')
                                    <!-- end pop up بنود الاستحاقات الثابته -->
                            <button type="submit" class="waves-effect btn"
                                    style="float:left"> @lang('main.edit') </button>
                        @endif
                    </div>
                    {{ Form::close() }}
                </div>
                <br/>

            </div>
        </div>
    @endif
    @if(PerC::isShow('hr','Employees','add_show_edit'))
        <br/>
        @include('dashboard.hr.employee._view_table')
    @endif
</section>
@stop