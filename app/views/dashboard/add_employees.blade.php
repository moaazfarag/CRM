@extends('dashboard.main')
@section('content')
<div class="card" >
    <div class="title">
        <h5><i class="mdi mdi-notification-event-available"></i>   اضف موظف </h5>
        <a class="minimize" href="#">
            <i class="mdi-navigation-expand-less"></i>
        </a>
    </div>
    <div class="content">
        <div class="row no-margin-top">
            <div class="col s12 l4">
                <div class="input-field">
                    <i class="fa fa-tag prefix"></i>
                    {{ Form::text('emp_name',null,array('required','id'=>'emp_name',)) }}
                    {{ Form::label('emp_name',  'اسم الموظف'   )     }}
                    <p class="parsley-required">{{ $errors ->first('emp_name') }} </p>
                </div>

        <div class="row no-margin-top">
            <div class="col s13 l3">
                <div class="input-field">
                    <i class="fa fa-tag prefix"></i>
                    <input CLASS="datepiker" name="credit_limit" id="credit-limit" >
                    <label for="credit-limit">
                        تاريخ التعيين
                    </label>
                </div>
            </div>
        </div>
         <div class="row no-margin-top">
                    <div class="col s12 l2">
                        <label for="account-email">
                            نوع التعاقد
                        </label>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="input-field">
                            <i class="mdi mdi-social-person prefix"></i>
                            <select name="account-email">
                                <option>        دائم</option>
                                <option>       مؤقت  </option>
                            </select>

                            {{--<input  name="account_email" id="account-email" type="" placeholder="  الاميل   ">--}}
                        </div>
                    </div>

                </div>

                </div>
    </div>

</div>

    </div>
        @include('include.search')
    </section>
@stop