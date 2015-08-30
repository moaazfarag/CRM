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
                      <div class="col s12 l7">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::text('name',null,array('required','id'=>'name',)) }}
                              {{ Form::label('name',  'اسم الموظف'   )     }}
                              <p class="parsley-required">{{ $errors ->first('name') }} </p>
                          </div>
                      </div>
                      <div class="col s12 l5">
                          <div class="input-field">
                              <i class="mdi mdi-action-language prefix"></i>
                              {{ Form::text('employee_date',null,array('required','id'=>'employee_date','class'=>'pikaday')) }}
                              <label for="employee_date">
                                                   ت التعيين
                              </label>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col s2 l7">
                              <div class="input-field">
                                  <i class="fa fa-tag prefix"></i>
                                  {{ Form::number('card_no',null,array('required','id'=>'card_no','length'=>"14")) }}
                                  {{ Form::label('card_no',  'الرقم القومى' )     }}
                                  <p class="parsley-required">{{ $errors ->first('card_no') }} </p>
                              </div>
                          </div>
                          <div class="col s2 l5">
                              <div class="input-field">

                                  {{ Form::text('ins_no',null,array('required','id'=>'ins_no',)) }}
                                  {{ Form::label('ins_no',  'رقم التامين' )     }}
                                  <p class="parsley-required">{{ $errors ->first('ins_no') }} </p>
                              </div>
                          </div>
                          </div>
                          <div class="row">
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{ Form::label('','') }}
                                  {{ Form::select('branch_id', array('' => ' الفرع') + $co_info->branches->lists('br_name','id'),null,array('id'=>'branch_id')) }}
                                      <p class="parsley-required">{{ $errors ->first('branch_id') }} </p>
                                  </div>
                              </div>
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{ Form::label('','') }}
                                  {{ Form::select('job_id', array('' => 'الوظيفه') + $co_info->jobs->lists('name','id'),null,array('id'=>'job_id')) }}
                                      <p class="parsley-required">{{ $errors ->first('job_id') }} </p>
                                  </div>
                              </div>
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{--{{ Form::label('','') }}--}}
                                  {{ Form::select('department_id', array('' => 'الاقسام') + $co_info->departments->lists('name','id'),null,array('id'=>'department_id')) }}
                                      <p class="parsley-required">{{ $errors ->first('department_id') }} </p>
                                  </div>
                              </div>
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{ Form::label('',' ') }}
                                  {{ Form::select('work_nature',$work_nature,null,array('id'=>'work_nature')) }}
                                      <p class="parsley-required">{{ $errors ->first('work_nature') }} </p>
                                  </div>
                              </div>
                  </div>
                  <div class="row">

                      <div class="col s2 l4">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::number('salary',null,array('required','id'=>'salary', 'step'=>'0.01')) }}
                              {{ Form::label('salary',  ' الراتب ' )     }}
                              <p class="parsley-required">{{ $errors ->first('salary') }} </p>
                          </div>
                      </div>
                      <div class="col s2 l4">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::number('ins_salary',null,array('required','id'=>'ins_salary','step'=>'0.01')) }}
                              {{ Form::label('ins_salary',  ' مرتب التامينات ' )     }}
                              <p class="parsley-required">{{ $errors ->first('ins_salary') }} </p>
                          </div>
                      </div>
                      <div class="col s2 l4">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::number('ins_val',null,array('required','id'=>'ins_val','step'=>'0.01')) }}
                              {{ Form::label('ins_val',  ' خصم التامين' )     }}
                              <p class="parsley-required">{{ $errors ->first('ins_val') }} </p>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col s2 l2">
                          <div class="input-field">
                              {{--<i class="fa fa-tag prefix"></i>--}}
                              {{ Form::checkbox('cancel_date',1,null,array('id'=>'cancel_date')) }}
                              {{ Form::label('cancel_date','الغاء العمل فى تاريخ') }}
                              <p class="parsley-required">{{ $errors ->first('cancel_date') }} </p>
                          </div>
                      </div>
                      <div class="col s2 l4">
                      <div class="input-field">
                          {{--<i class="mdi mdi-action-language prefix"></i>--}}
                          {{ Form::text('cancel_date',null,array('required','id'=>'cancel_date','class'=>'pikaday')) }}
                      </div>
                      </div>
                 </div>
                      <div class="row">
                            <div class="col s2 l12">
                                <div class="input-field" >
                                    <i class="fa fa-tag prefix"></i>
                                    {{ Form::textarea('cancel_cause',null,array('id'=>'cancel_cause','class'=>"materialize-textarea" ,'length'=>"200")) }}
                                    {{ Form::label('cancel_cause',  ' سبب الالغاء ' )     }}
                                    <p class="parsley-required">{{ $errors ->first('cancel_cause') }} </p>
                                </div>
                            </div>
                      </div>
           <div class="row">
               <div class="col s12 l5">
                   {{--<i class="fa fa-tag prefix"></i>--}}
                   <div class="input-field">
                       {{ Form::label(' ',' ') }}
                       {{ Form::select('sex',$sex ,null,array('id'=>'sex')) }}
                       <p class="parsley-required">{{ $errors ->first('sex') }} </p>
                   </div>
               </div>
               <div class="col s12 l5">
                   {{--<i class="fa fa-tag prefix"></i>--}}
                   <div class="input-field">
                       {{ Form::label('','  ') }}
                       {{ Form::select('marital', $marital ,null,array('id'=>'marital')) }}
                       <p class="parsley-required">{{ $errors ->first('marital') }} </p>
                   </div>
               </div>
           </div>
             <div class="row">
                     {{--<i class="fa fa-tag prefix"></i>--}}
                     <div class="col s12 l5">
                         {{--<i class="fa fa-tag prefix"></i>--}}
                         <div class="input-field">
                             {{ Form::label('',' ') }}
                             {{ Form::select('religion',  $religion,null,array('id'=>'religion')) }}
                             <p class="parsley-required">{{ $errors ->first('religion') }} </p>
                         </div>
                     </div>
                 <div class="col s12 l5">
                         {{--<i class="fa fa-tag prefix"></i>--}}
                         <div class="input-field">
                             {{ Form::label('', '') }}
                             {{ Form::select('military_service', $military_service ,null,array('id'=>'military_service')) }}
                             <p class="parsley-required">{{ $errors ->first('military_service') }} </p>
                         </div>
                     </div>
                 </div>
            </div>
      <div class="row">
          <div class="col s12 l9">
              <div class="input-field">
                  <i class="fa fa-tag prefix"></i>
                  {{ Form::text('address',null,array('required','id'=>'address',)) }}
                  {{ Form::label('address', 'العنوان')     }}
                  <p class="parsley-required">{{ $errors ->first('address') }} </p>
              </div>
          </div>
          <div class="col s12 l9">
              <div class="input-field">
                  <i class="fa fa-tag prefix"></i>
                  {{ Form::text('tel',null,array('required','id'=>'tel',)) }}
                  {{ Form::label('tel', 'ارقام الهاتف')     }}
                  <p class="parsley-required">{{ $errors ->first('tel') }} </p>
              </div>
          </div>
    </div>
          <div class="row">
              <div class="col s2 l1">
                  <div class="input-field">
                      {{--<i class="fa fa-tag prefix"></i>--}}
                      {{ Form::checkbox('birth_date',1,null,array('id'=>'birth_date')) }}
                      {{ Form::label('birth_date','تاريخ الميلاد    ') }}

                      <p class="parsley-required">{{ $errors ->first('birth_date') }} </p>
                  </div>
              </div>
              <div class="col s2 l2">
                  <div class="input-field">
                      {{--<i class="mdi mdi-action-language prefix"></i>--}}
                      {{ Form::text('birth_date',null,array('required','id'=>'birth_date','class'=>'pikaday')) }}
                  </div>
              </div>
              <div class="col s12 l9">
                  <div class="input-field">
                      <i class="fa fa-tag prefix"></i>
                      {{ Form::text('certificate',null,array('required','id'=>'certificate')) }}
                      {{ Form::label('certificate', 'المؤهل ')     }}
                      <p class="parsley-required">{{ $errors ->first('certificate') }} </p>
                  </div>
              </div>
          </div>
              <div class="row">
              <div class="col s2 l1">
                  <div class="input-field">
                      {{--<i class="fa fa-tag prefix"></i>--}}
                      {{ Form::checkbox('cert_date',1,null,array('id'=>'cert_date')) }}
                      {{ Form::label('cert_date','تاريخ المؤهل    ') }}
                      <p class="parsley-required">{{ $errors ->first('cert_date') }} </p>
                  </div>
              </div>
              <div class="col s2 l2">
                  <div class="input-field">
                      {{--<i class="mdi mdi-action-language prefix"></i>--}}
{{--                      {{ Form::text('certDate',null,array('required','id'=>'certificate',)) }}--}}
                      {{ Form::text('cert_date',null,array('required','id'=>'cert_date','class'=>'pikaday')) }}
                  </div>
              </div>
              <div class="col s12 l9">
                  <div class="input-field">
                      <i class="fa fa-tag prefix"></i>
                      {{ Form::text('cert_location',null,array('required','id'=>'cert_location')) }}
                      {{ Form::label('cert_location', 'جهه المؤهل ')     }}
                      <p class="parsley-required">{{ $errors ->first('cert_location') }} </p>
                  </div>
              </div>
                  <div class="col s2 l12">
                      <div class="input-field" >
                          <i class="fa fa-tag prefix"></i>
                          {{ Form::textarea('remark',null,array('id'=>'remark','class'=>"materialize-textarea" ,'length'=>"200")) }}
                          {{ Form::label('remark',  ' ملاحظات  ' )     }}
                          <p class="parsley-required">{{ $errors ->first('remark') }} </p>
                      </div>
                  </div>
          </div>
                  <div class="row">
                      <div class="col s12 l12">
                          @if(Route::currentRouteName() == 'addEmp')
                              {{--{{Form::submit('  اضف ')}}--}}
                              <button type="submit" class="waves-effect btn">اضف </button>
                          @elseif(Route::currentRouteName() == 'editEmp')
                              {{--{{Form::submit('  تعديل ')}}--}}
                                  <!-- POPUP form بنود الاستحقاقات  الثابته زرار Trigger -->
                              <a class="waves-effect waves-light btn modal-trigger" href="#addDud">
                                  بنود الراتب الثابته للموظف

                              </a>

                              <!-- pop up بنود الاستحاقات الثابته -->
                          @include('dashboard.hr.employee._pop_up')
                              <!-- end pop up بنود الاستحاقات الثابته -->
                              <button type="submit" class="waves-effect btn" style="float:left">تعديل </button>
                          @endif
                      </div>
                      {{ Form::close() }}
                  </div>
      </div>
        </div>
@include('dashboard.hr.employee._view_table')
  </section>
  @stop