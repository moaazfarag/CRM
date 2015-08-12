 @extends('dashboard.main')
 @section('content')

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
                                  {{ Form::text('card_no',null,array('required','id'=>'card_no',)) }}
                                  {{ Form::label('card_no',  'الرقم القومى' )     }}
                                  <p class="parsley-required">{{ $errors ->first('card_no') }} </p>
                              </div>
                          </div>

                          <div class="col s2 l5">
                              <div class="input-field">
                                  <i class="fa fa-tag prefix"></i>
                                  {{ Form::text('ins_no',null,array('required','id'=>'ins_no',)) }}
                                  {{ Form::label('ins_no',  'رقم التامين' )     }}
                                  <p class="parsley-required">{{ $errors ->first('ins_no') }} </p>
                              </div>
                          </div>

                          </div>
                          <div class="row">
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{ Form::label('branch_id','الفرع') }}
                                  {{ Form::select('branch_id', array('' => ' ') + $co_info->branches->lists('br_name','id'),null,array('id'=>'branch_id')) }}
                                      <p class="parsley-required">{{ $errors ->first('branch_id') }} </p>
                                  </div>
                              </div>
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{ Form::label('job_id','الوظيفه') }}
                                  {{ Form::select('job_id', array('' => '') + $co_info->Models->lists('name','id'),null,array('id'=>'job_id')) }}
                                      <p class="parsley-required">{{ $errors ->first('job_id') }} </p>
                                  </div>
                              </div>
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{ Form::label('department_id','الاقسام') }}
                                  {{ Form::select('department_id', array('' => '') + $co_info->Items->lists('item_name','id'),null,array('id'=>'department_id')) }}
                                      <p class="parsley-required">{{ $errors ->first('department_id') }} </p>
                                  </div>
                              </div>
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{ Form::label('work_nature',' نوع التعاقد ') }}
                                  {{ Form::select('work_nature', array('' => '') + $co_info->Seasons->lists('name','id'),null,array('id'=>'work_nature')) }}
                                      <p class="parsley-required">{{ $errors ->first('work_nature') }} </p>
                                  </div>
                              </div>
                  </div>

                  <div class="row">

                      <div class="col s2 l4">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::text('salary',null,array('required','id'=>'salary',)) }}
                              {{ Form::label('salary',  ' الراتب ' )     }}
                              <p class="parsley-required">{{ $errors ->first('salary') }} </p>
                          </div>
                      </div>
                      <div class="col s2 l4">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::text('ins_salary',null,array('required','id'=>'ins_salary',)) }}
                              {{ Form::label('ins_salary',  ' مرتب التامينات ' )     }}
                              <p class="parsley-required">{{ $errors ->first('ins_salary') }} </p>
                          </div>
                      </div>
                      <div class="col s2 l4">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::text('ins_val',null,array('required','id'=>'ins_val',)) }}
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
                                    {{ Form::textarea('cancel_cause',null,array('id'=>'cancel_cause',)) }}
                                    {{ Form::label('cancel_cause',  ' سبب الالغاء ' )     }}
                                    <p class="parsley-required">{{ $errors ->first('cancel_cause') }} </p>
                                </div>
                            </div>
                      </div>
           <div class="row">
               <div class="col s12 l5">
                   {{--<i class="fa fa-tag prefix"></i>--}}
                   <div class="input-field">
                       {{ Form::label('sex','الجنس ') }}
                       {{ Form::select('sex', array('' => '') + $co_info->Accounts->lists('acc_name','id'),null,array('id'=>'sex')) }}
                       <p class="parsley-required">{{ $errors ->first('sex') }} </p>
                   </div>


               </div>
               <div class="col s12 l5">
                   {{--<i class="fa fa-tag prefix"></i>--}}
                   <div class="input-field">
                       {{ Form::label('marital',' الحاله الاجتماعيه  ') }}
                       {{ Form::select('marital', array('' => '') + $co_info->Seasons->lists('name','id'),null,array('id'=>'marital')) }}
                       <p class="parsley-required">{{ $errors ->first('marital') }} </p>
                   </div>


               </div>
           </div>
             <div class="row">
                     {{--<i class="fa fa-tag prefix"></i>--}}
                     <div class="col s12 l5">
                         {{--<i class="fa fa-tag prefix"></i>--}}
                         <div class="input-field">
                             {{ Form::label('religion','الديانه ') }}
                             {{ Form::select('religion', array('' => '') + $co_info->Seasons->lists('name','id'),null,array('id'=>'religion')) }}
                             <p class="parsley-required">{{ $errors ->first('religion') }} </p>
                         </div>
                     </div>
                 <div class="col s12 l5">
                         {{--<i class="fa fa-tag prefix"></i>--}}
                         <div class="input-field">
                             {{ Form::label('militaryService', 'موقف التجنيد') }}
                             {{ Form::select('militaryService', array('' => '') + $co_info->Seasons->lists('name','id'),null,array('id'=>'militaryService')) }}
                             <p class="parsley-required">{{ $errors ->first('militaryService') }} </p>
                         </div>
                     </div>

                     {{Form::submit('العمولات لمراحل التشغيل ')}}

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
                      {{ Form::label('certificate', 'الؤهل ')     }}
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
                          {{ Form::textarea('remark',null,array('id'=>'remark')) }}
                          {{ Form::label('remark',  ' ملاحظات  ' )     }}
                          <p class="parsley-required">{{ $errors ->first('remark') }} </p>
                      </div>
                  </div>
          </div>
              <div class="row">
                  {{Form::submit('  جديد ')}}
                  {{Form::submit('  حفظ ')}}
                  {{Form::submit('  الاقسام ')}}
                  {{Form::submit('  الوظائف ')}}
                  {{Form::submit(' بنود الاستحقاقات  ')}}
                  {{Form::submit(' بنود الراتب الثابته للموظف  ')}}

              </div>
                  <div class="row">
                      <div class="col s12 l12">
                          @if(Route::currentRouteName() == 'addEmp')
                              {{Form::submit('  اضف ')}}
                              {{--<button type="submit" class="waves-effect btn">اضف </button>--}}
                          @elseif(Route::currentRouteName() == 'editEmp')
                              {{Form::submit('  تعديل ')}}

                              {{--<button type="submit" class="waves-effect btn">تعديل </button>--}}
                          @endif
                      </div>
                      {{ Form::close() }}
                  </div>{{--submit  row end--}}


      </div>

    </div>
    <!-- /Store Settings -->

{{--@include('dashboard.hr_view_table')--}}


  </section>
  <!-- /Main Content -->

{{--@include('include.search')--}}
  @stop