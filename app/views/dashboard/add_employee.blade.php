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
                              {{ Form::text('empName',null,array('required','id'=>'empName',)) }}
                              {{ Form::label('empName',  'اسم الموظف'   )     }}
                              <p class="parsley-required">{{ $errors ->first('empName') }} </p>
                          </div>
                      </div>

                      <div class="col s12 l5">
                          <div class="input-field">
                              <i class="mdi mdi-action-language prefix"></i>
                              {{ Form::text('empDate',null,array('required','id'=>'empDate','class'=>'pikaday')) }}
                              <label for="empDate">
                                                   ت التعيين
                              </label>
                          </div>
                      </div>


                      <div class="row">
                          <div class="col s2 l7">
                              <div class="input-field">
                                  <i class="fa fa-tag prefix"></i>
                                  {{ Form::text('idCardNo',null,array('required','id'=>'idCardNo',)) }}
                                  {{ Form::label('idCardNo',  'الرقم القومى' )     }}
                                  <p class="parsley-required">{{ $errors ->first('idCardNo') }} </p>
                              </div>
                          </div>

                          <div class="col s2 l5">
                              <div class="input-field">
                                  <i class="fa fa-tag prefix"></i>
                                  {{ Form::text('insNo',null,array('required','id'=>'insNo',)) }}
                                  {{ Form::label('insNo',  'رقم التامين' )     }}
                                  <p class="parsley-required">{{ $errors ->first('insNo') }} </p>
                              </div>
                          </div>

                          </div>
                          <div class="row">
                              {{--<div class="col s8 l3">--}}
                                  {{--<i class="fa fa-tag prefix"></i>--}}
                                  {{--<select name="branchCode" id="branchCode">--}}
                                      {{--<option selected value="0" disabled> الفرع </option>--}}
                                      {{--<option value="big_size" > الدقى  </option>--}}
                                      {{--<option value="mid_size" >النزهه </option>--}}
                                      {{--<option value="small_size">  الجيزه</option>--}}
                                  {{--</select>--}}
                              {{--</div>--}}
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{ Form::label('branchCode','الفرع') }}
                                  {{ Form::select('branchCode', array('' => ' ') + $co_info->branches->lists('br_name','id'),null,array('id'=>'branchCode')) }}
                                      <p class="parsley-required">{{ $errors ->first('branchCode') }} </p>
                                  </div>
                              </div>
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{ Form::label('jobCode','الوظيفه') }}
                                  {{ Form::select('jobCode', array('' => '') + $co_info->Models->lists('name','id'),null,array('id'=>'jobCode')) }}
                                      <p class="parsley-required">{{ $errors ->first('jobCode') }} </p>
                                  </div>
                              </div>
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{ Form::label('depCode','الاقسام') }}
                                  {{ Form::select('depCode', array('' => '') + $co_info->Items->lists('item_name','id'),null,array('id'=>'depCode')) }}
                                      <p class="parsley-required">{{ $errors ->first('depCode') }} </p>
                                  </div>
                              </div>
                              <div class="col s8 l3">
                                  <div class="input-field">
                                  {{ Form::label('workNature',' نوع التعاقد ') }}
                                  {{ Form::select('workNature', array('' => '') + $co_info->Seasons->lists('name','id'),null,array('id'=>'workNature')) }}
                                      <p class="parsley-required">{{ $errors ->first('workNature') }} </p>
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
                              {{ Form::text('insSalary',null,array('required','id'=>'insSalary',)) }}
                              {{ Form::label('insSalary',  ' مرتب التامينات ' )     }}
                              <p class="parsley-required">{{ $errors ->first('insSalary') }} </p>
                          </div>
                      </div>
                      <div class="col s2 l4">
                          <div class="input-field">
                              <i class="fa fa-tag prefix"></i>
                              {{ Form::text('insVal',null,array('required','id'=>'insVal',)) }}
                              {{ Form::label('insVal',  ' خصم التامين' )     }}
                              <p class="parsley-required">{{ $errors ->first('insVal') }} </p>
                          </div>
                      </div>
                  </div>


                  <div class="row">
                      <div class="col s2 l2">
                          <div class="input-field">
                              {{--<i class="fa fa-tag prefix"></i>--}}
                              {{ Form::checkbox('cancelDate',1,null,array('id'=>'cancelDate')) }}
                              {{ Form::label('cancelDate','الغاء العمل فى تاريخ') }}

                              <p class="parsley-required">{{ $errors ->first('cancelDate') }} </p>
                          </div>
                      </div>
                      <div class="col s2 l4">
                      <div class="input-field">
                          {{--<i class="mdi mdi-action-language prefix"></i>--}}
                          {{ Form::text('cancelDate',null,array('required','id'=>'cancelDate','class'=>'pikaday')) }}

                      </div>
                      </div>
                 </div>
                      <div class="row">
                            <div class="col s2 l12">
                                <div class="input-field" >
                                    <i class="fa fa-tag prefix"></i>
                                    {{ Form::textarea('cancelCause',null,array('id'=>'cancelCause',)) }}
                                    {{ Form::label('cancelCause',  ' سبب الالغاء ' )     }}
                                    <p class="parsley-required">{{ $errors ->first('cancelCause') }} </p>
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
               {{--<div class="col s12 l5">--}}
                   {{--<i class="fa fa-tag prefix"></i>--}}
                   {{--<select name="marital" id="marital">--}}
                       {{--<option selected value="0" disabled> الحاله الاجتماعيه  </option>--}}
                       {{--<option value="big_size" >  اعزب </option>--}}
                       {{--<option value="mid_size" >متزوج </option>--}}
                   {{--</select>--}}

               {{--</div>--}}
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


                 {{--<div class="col s12 l5">--}}
                     {{--<i class="fa fa-tag prefix"></i>--}}
                     {{--<select name="militaryService" id="militaryService">--}}
                         {{--<option selected value="0" disabled>موقف التجنيد </option>--}}
                         {{--<option value="big_size" >  تم الخدمه </option>--}}
                         {{--<option value="mid_size" >معافى  </option>--}}
                         {{--<option value="mid_size" >تاجيل </option>--}}
                     {{--</select>--}}
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
                      {{ Form::checkbox('birthDate',1,null,array('id'=>'birthDate')) }}
                      {{ Form::label('birthDate','تاريخ الميلاد    ') }}

                      <p class="parsley-required">{{ $errors ->first('birthDate') }} </p>
                  </div>
              </div>
              <div class="col s2 l2">
                  <div class="input-field">
                      {{--<i class="mdi mdi-action-language prefix"></i>--}}
                      {{ Form::text('birthDate',null,array('required','id'=>'birthDate','class'=>'pikaday')) }}

                  </div>
              </div>
              <div class="col s12 l9">
                  <div class="input-field">
                      <i class="fa fa-tag prefix"></i>
                      {{ Form::text('certificate',null,array('required','id'=>'certificate',)) }}
                      {{ Form::label('certificate', 'الؤهل ')     }}
                      <p class="parsley-required">{{ $errors ->first('certificate') }} </p>
                  </div>
              </div>
          </div>
              <div class="row">
              <div class="col s2 l1">
                  <div class="input-field">
                      {{--<i class="fa fa-tag prefix"></i>--}}
                      {{ Form::checkbox('certDate',1,null,array('id'=>'certDate')) }}
                      {{ Form::label('certDate','تاريخ المؤهل    ') }}

                      <p class="parsley-required">{{ $errors ->first('certDate') }} </p>
                  </div>
              </div>
              <div class="col s2 l2">
                  <div class="input-field">
                      {{--<i class="mdi mdi-action-language prefix"></i>--}}
{{--                      {{ Form::text('certDate',null,array('required','id'=>'certificate',)) }}--}}
                      {{ Form::text('certDate',null,array('required','id'=>'certDate','class'=>'pikaday')) }}

                  </div>
              </div>
              <div class="col s12 l9">
                  <div class="input-field">
                      <i class="fa fa-tag prefix"></i>
                      {{ Form::text('certLocation',null,array('required','id'=>'certLocation',)) }}
                      {{ Form::label('certLocation', 'جهه المؤهل ')     }}
                      <p class="parsley-required">{{ $errors ->first('certLocation') }} </p>
                  </div>
              </div>
                  <div class="col s2 l12">
                      <div class="input-field" >
                          <i class="fa fa-tag prefix"></i>
                          {{ Form::textarea('remark',null,array('id'=>'remark',)) }}
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