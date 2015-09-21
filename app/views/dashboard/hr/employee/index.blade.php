 @extends('dashboard.main')
 @section('content')
         <!-- Main Content -->
 <section class="content-wrap ecommerce-dashboard">
        @if(Route::currentRouteName() == 'addEmp')
            {{ Form::open(array('route'=>array('storeEmp'))) }}
        @elseif(Route::currentRouteName() == 'editEmp')
            {{ Form::model($employee,array('route'=>array('updateEmp',$employee->id))) }}
        @endif
{{--{{ Form::model($employee,array('route'=>array('updateEmp',1))) }}--}}
    <div class=" card ">
      <div class="title">
                <h5>
                    <i class="fa fa-cog"></i> @lang('main.addEmployee')  </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
              <div class="content">
                  <div class="row no-margin-top">
                      <div class="col s12 l6">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::text('name',null,array('required','id'=>'name',)) }}
                              {{ Form::label('name',lang::get('main.employe_name'))     }}
                              <p class="parsley-required">{{ $errors ->first('name') }} </p>
                          </div>
                      </div>
                      <div class="col s12 l5">
                          <div class="input-field">
                              <i class="mdi mdi-action-language prefix"></i>
                              {{ Form::text('employee_date',null,array('required','id'=>'employee_date','class'=>'pikaday')) }}
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
                                  <i class="fa fa-tag prefix"></i>
                                  {{ Form::number('card_no',null,array('required','id'=>'card_no','length'=>"14")) }}
                                  {{ Form::label('card_no',lang::get('main.national_id'))     }}
                                  <p class="parsley-required">{{ $errors ->first('card_no') }} </p>
                              </div>
                          </div>
                          <div class="col s12 l5">
                              <div class="input-field">
                                  <i class="fa fa-tag prefix"></i>

                                  {{ Form::text('ins_no',null,array('id'=>'ins_no',)) }}
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

                      <div class="col s12 l4">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::number('salary',null,array('id'=>'salary', 'step'=>'0.01')) }}
                              {{ Form::label('salary',lang::get('main.salary'))     }}
                              <p class="parsley-required">{{ $errors ->first('salary') }} </p>
                          </div>
                      </div>
                      <div class="col s12 l3">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::number('ins_salary',null,array('id'=>'ins_salary','step'=>'0.01')) }}
                              {{ Form::label('ins_salary',lang::get('main.insurance_salary'))   }}
                              <p class="parsley-required">{{ $errors ->first('ins_salary') }} </p>
                          </div>
                      </div>
                      <div class="col s12 l4">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::number('ins_val',null,array('id'=>'ins_val','step'=>'0.01')) }}
                              {{ Form::label('ins_val',lang::get('main.discount_insurance'))    }}
                              <p class="parsley-required">{{ $errors ->first('ins_val') }} </p>
                          </div>
                      </div>
                  </div>
                  <div class="row">

                      <div class="col s12 l4">
                      <div class="input-field">
                          <i class="fa fa-tag prefix"></i>
                          {{ Form::label('cancel_date',lang::get('main.cancellation_work')) }}

                          {{ Form::text('cancel_date',null,array('id'=>'cancel_date','class'=>'pikaday')) }}
                          <p class="parsley-required">{{ $errors ->first('cancel_date') }} </p>

                      </div>
                      </div>

                      <div class="col s12 l7">
                          <div class="input-field" >
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::label('cancel_cause',lang::get('main.cancellation_reason'))     }}
                              {{ Form::text('cancel_cause',null,array('id'=>'cancel_cause','class'=>"materialize-textarea" ,'length'=>"200")) }}
                              <p class="parsley-required">{{ $errors ->first('cancel_cause') }} </p>
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
          <div class="col s12 l11">
              <div class="input-field">
                  <i class="fa fa-tag prefix"></i>
                  {{ Form::text('address',null,array('id'=>'address','length'=>"200")) }}
                  {{ Form::label('address',lang::get('main.address'))   }}
                  <p class="parsley-required">{{ $errors ->first('address') }} </p>
              </div>
          </div>
      </div>
      <div class="row">

          <div class="col s12 l4">
              <div class="input-field">
                  <i class="fa fa-tag prefix"></i>
                  {{ Form::text('tel',null,array('id'=>'tel',)) }}
                  {{ Form::label('tel',lang::get('main.phone_number_1') )      }}
                  <p class="parsley-required">{{ $errors ->first('tel') }} </p>
              </div>
          </div>

          <div class="col s12 l4">
              <div class="input-field">
                  <i class="fa fa-tag prefix"></i>
                  {{ Form::text('tel2',null,array('id'=>'tel',)) }}
                  {{ Form::label('tel2',lang::get('main.phone_number_2'))     }}
                  <p class="parsley-required">{{ $errors ->first('tel') }} </p>
              </div>
          </div>
          <div class="col s12 l3">
              <div class="input-field">
                  <i class="fa fa-tag prefix"></i>
                  {{ Form::text('birth_date',null,array('id'=>'birth_date','class'=>'pikaday')) }}
                  {{ Form::label('birth_date',lang::get('main.birthday')) }}

                  <p class="parsley-required">{{ $errors ->first('birth_date') }} </p>
              </div>
          </div>
    </div>


          <div class="row">


              <div class="col s12 l4">
                  <div class="input-field">
                      <i class="fa fa-tag prefix"></i>
                      {{ Form::text('certificate',null,array('id'=>'certificate')) }}
                      {{ Form::label('certificate' ,lang::get('main.qualification'))   }}
                      <p class="parsley-required">{{ $errors ->first('certificate') }} </p>
                  </div>
              </div>

              <div class="col s12 l4">
                  <div class="input-field">
                      <i class="fa fa-tag prefix"></i>
                      {{ Form::text('cert_location',null,array('id'=>'cert_location')) }}
                      {{ Form::label('cert_location' ,lang::get('main.face_qualification'))   }}
                      <p class="parsley-required">{{ $errors ->first('cert_location') }} </p>
                  </div>
              </div>

              <div class="col s12 l3">
                  <div class="input-field">
                      <i class="fa fa-tag prefix"></i>
                      {{ Form::text('cert_date',null,array('id'=>'cert_date','class'=>'pikaday')) }}
                      {{ Form::label('cert_date',lang::get('main.date_qualification'))   }}
                      <p class="parsley-required">{{ $errors ->first('cert_date') }} </p>
                  </div>
              </div>

          </div>
                  <div class="row">

                  <div class="col s12 l11">
                      <div class="input-field" >
                          <i class="fa fa-tag prefix"></i>
                          {{ Form::textarea('remark',null,array('id'=>'remark','class'=>"materialize-textarea" ,'length'=>"200")) }}
                          {{ Form::label('remark',lang::get('main.comments'))    }}
                          <p class="parsley-required">{{ $errors ->first('remark') }} </p>
                      </div>
                  </div>
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
                              <button type="submit" class="waves-effect btn" style="float:left"> @lang('main.edit') </button>
                          @endif
                      </div>
                      {{ Form::close() }}
                  </div>
      </div>
        </div>
@include('dashboard.hr.employee._view_table')
  </section>
  @stop