@extends('dashboard.main')
@section('content')
    @include('dashboard.account_nav')
      <div id="account_bank" class="col s12">
            @if(Route::currentRouteName() == 'addAccount')
        {{ Form::open(array('route'=>array('storeAccount',$accountType))) }}
            @elseif(Route::currentRouteName() == 'editAccount')
              {{ Form::model($account,array('route'=>array('updateAccount',$accountType,$account->id))) }}
              @endif
        <div class="card">
          <div class="title">
            <h5><i class="mdi mdi-notification-event-available"></i> اضف حساب بنك جديد</h5>
            <a class="minimize" href="#">
              <i class="mdi-navigation-expand-less"></i>
            </a>
          </div>
          <div class="content">
                  <div class="row no-margin-top">
                    <div class="col s12 l2">
                      <label for="account-name">
                      الاسم
                      </label>
                    </div>
                    <div class="col s12 l4">
                      <div class="input-field">
                        <i class="mdi mdi-social-person prefix"></i>
                          {{ Form::text('acc_name',null,array('required','id'=>'account-name','placeholder'=>'الاسم')) }}
                        {{--<input name="account_name" id="branch-name" type="text" placeholder="  الاسم   ">--}}
                      </div>
                    </div>
                     <div class="row no-margin-top">
                    <div class="col s12 l2">
                      <label for="credit-limit">
حد الائتمان
                      </label>
                    </div>
                    <div class="col s12 l3">
                      <div class="input-field">
                        <i class="mdi mdi-social-person prefix"></i>
                          {{ Form::text('acc_limit',null,array('required','id'=>'credit-limit','placeholder'=>' حد الائتما')) }}
                          {{--<input name="credit_limit" id="credit-limit" type="text" placeholder="   حد الائتمان  ">--}}
                      </div>
                    </div>
</div>
                  </div>
                  <div class="row no-margin-top">
                    <div class="col s12 l2">
                      <label for="account-email">
الاميل
                      </label>
                    </div>
                    <div class="col s12 m6 l6">
                      <div class="input-field">
                        <i class="mdi mdi-social-person prefix"></i>
                          {{ Form::text('acc_email',null,array('id'=>'account-email','placeholder'=>'الاميل')) }}

                          {{--<input  name="account_email" id="account-email" type="text" placeholder="  الاميل   ">--}}
                      </div>
                    </div>

                  </div>
                  <div class="row no-margin-top">
                            <div class="col s12 l2">
                              <label for="account-address">
العنوان
                              </label>
                            </div>
                            <div class="col s12 m6 l8">
                              <div class="input-field">
                                <i class="mdi mdi-social-person prefix"></i>
                                  {{ Form::text('acc_address',null,array('id'=>'account-address','placeholder'=>'العنوان')) }}
                                  {{--<input name="account_address" id="account-address" type="text" placeholder="العنوان  ">--}}
                              </div>
                            </div>

                          </div>
                  <div class="row no-margin-top">
                            <div class="col s12 l2">
                              <label for="account-numbers">
ارقام الهاتف
                              </label>
                            </div>
                            <div class="col s12 m6 l8">
                              <div class="input-field">
                                <i class="mdi mdi-social-person prefix"></i>
                                  {{ Form::text('acc_tel',null,array('id'=>'account-numbers','placeholder'=>'ارقام الهاتف ')) }}
                                  {{--<input id="account-numbers" type="text" placeholder="ارقام الهاتف ">--}}
                              </div>
                            </div>

                          </div>
                  <div class="row no-margin-top">
                    <div class="col s12 l2">
                      <label for="account-commercial-registration">
سجل تجاري
                      </label>
                    </div>
                    <div class="col s12  l4">
                      <div class="input-field">
                        <i class="mdi mdi-social-person prefix"></i>
                          {{ Form::text('acc_commercial_registration',null,array('id'=>'account-commercial-registration','placeholder'=>'  سجل تجاري')) }}
                          {{--<input name="account_commercial_registration" id="account-commercial-registration" type="text" placeholder="    سجل تجاري  ">--}}
                      </div>
                    </div>
                     <div class="row no-margin-top">
                    <div class="col s12 l2">
                      <label for="tax-card">
                      البطاقة الضريبية
                      </label>
                    </div>
                    <div class="col s12 l3">
                      <div class="input-field">
                        <i class="mdi mdi-social-person prefix"></i>
                          {{ Form::text('acc_tax_card',null,array('id'=>'tax-card','placeholder'=>' البطاقة الضريبية')) }}
                          {{--<input name="tax_card" id="tax-card" type="text" placeholder=" البطاقة الضريبية ">--}}
                      </div>
                    </div>
</div>
                  </div>
                  <div class="row no-margin-top">
                                      <div class="col s12 l2">
                                        <label for="account-notes">
ملاحظات
                                        </label>
                                      </div>
                                      <div class="col s12 m6 l6">
                                        <div class="input-field">
                                          <i class="mdi mdi-social-person prefix"></i>
                                            {{ Form::text('acc_notes',null,array('id'=>'branch-notes','placeholder'=>'ملاحظات')) }}
                                            {{--<input  name="account_notes" id="account-notes" type="text" placeholder=" ملاحظات">--}}
                                        </div>
                                      </div>

                                    </div>
                  <div class="row">
                      <div class="col s12 l12">
                          <button class="waves-effect btn">اضف </button>
                      </div>
                      {{ Form::close() }}
                  </div>
                </div>
                  <table id="table_bank" class="display table table-bordered table-striped table-hover">

                  @include('dashboard.account_table_view')
</div>
</div>
      @include('include.search')

</section>
@stop