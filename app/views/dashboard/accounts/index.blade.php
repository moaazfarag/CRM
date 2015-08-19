@extends('dashboard.main')
@section('content')
    @include('dashboard.accounts._nav')
      <div id="account_bank" class="col s12">
            @if(Route::currentRouteName() == 'addAccount')
        {{ Form::open(array('route'=>array('storeAccount',$accountType))) }}
            @elseif(Route::currentRouteName() == 'editAccount')
              {{ Form::model($account,array('route'=>array('updateAccount',$accountType,$account->id))) }}
              @endif
        <div class="card">
          <div class="title">
            <h5><i class="mdi mdi-notification-event-available"></i>  @lang('main.addAccount') {{$arabicName}} @lang('main.new')</h5>
            <a class="minimize" href="#">
              <i class="mdi-navigation-expand-less"></i>
            </a>
          </div>
          <div class="content">
                  <div class="row no-margin-top">
                    <div class="col s12 l2">
                      <label for="account-name">
                          @lang('main.name')
                      </label>
                    </div>
                    <div class="col s12 l3">
                      <div class="input-field">
                        <i class="mdi mdi-social-person prefix"></i>
                          <?php $name=Lang::get('main.name') ?>
                          {{ Form::text('acc_name',null,array('required','id'=>'account-name','placeholder'=>$name)) }}
                        {{--<input name="account_name" id="branch-name" type="text" placeholder="  الاسم   ">--}}
                      </div>
                    </div>
@if($accountType == 'customers'||$accountType == 'suppliers')
                     <div class="row no-margin-top">
                            <div class="col s12 l2">
                              <label for="credit-limit">
                                  @lang('main.credit')
                              </label>
                            </div>
                            <div class="col s12 l3">
                              <div class="input-field">
                                  <?php $credit=Lang::get('main.credit') ?>
                                <i class="mdi mdi-social-person prefix"></i>
                                  {{ Form::text('acc_limit',null,array('required','id'=>'credit-limit','placeholder'=>$credit)) }}
                                  {{--<input name="credit_limit" id="credit-limit" type="text" placeholder="   حد الائتمان  ">--}}
                              </div>
                        </div>
                    </div>
@endif
                      @if($accountType == 'bank'||$accountType == 'expenses'||$accountType == 'partners'||$accountType == 'multiple_revenue' )

                      @else
                  </div>
                  <div class="row no-margin-top">
                    <div class="col s12 l2">
                      <label for="account-email">
                          @lang('main.mail')
                      </label>
                    </div>
                    <div class="col s12 m6 l6">
                      <div class="input-field">
                        <i class="mdi mdi-social-person prefix"></i>
                          <?php $mail=Lang::get('main.mail') ?>
                          {{ Form::text('acc_email',null,array('id'=>'account-email','placeholder'=>$mail)) }}

                          {{--<input  name="account_email" id="account-email" type="text" placeholder="  الاميل   ">--}}
                      </div>
                    </div>

                  </div>
                  <div class="row no-margin-top">
                            <div class="col s12 l2">
                              <label for="account-address">
                                  @lang('main.address')
                              </label>
                            </div>
                            <div class="col s12 m6 l8">
                              <div class="input-field">
                                <i class="mdi mdi-social-person prefix"></i>
                                  <?php $address=Lang::get('main.address') ?>
                                  {{ Form::text('acc_address',null,array('id'=>'account-address','placeholder'=>$address)) }}
                                  {{--<input name="account_address" id="account-address" type="text" placeholder="العنوان  ">--}}
                              </div>
                            </div>

                          </div>
                  <div class="row no-margin-top">
                            <div class="col s12 l2">
                              <label for="account-numbers">
                                  @lang('main.phoneNum')
                              </label>
                            </div>
                            <div class="col s12 m6 l8">
                              <div class="input-field">
                                <i class="mdi mdi-social-person prefix"></i>
                                  <?php $phoneNum=Lang::get('main.phoneNum') ?>
                                  {{ Form::text('acc_tel',null,array('id'=>'account-numbers','placeholder'=>$phoneNum)) }}
                                  {{--<input id="account-numbers" type="text" placeholder="ارقام الهاتف ">--}}
                              </div>
                            </div>

                          </div>
              @endif
              @if($accountType == 'expenses'||$accountType == 'partners'||$accountType == 'multiple_revenue' )

                  @else
                  <div class="row no-margin-top">
                    <div class="col s12 l2">
                      <label for="account-commercial-registration">
                          @lang('main.regComm')
                      </label>
                    </div>
                    <div class="col s12  l4">
                      <div class="input-field">
                        <i class="mdi mdi-social-person prefix"></i>
                          <?php $regComm=Lang::get('main.regComm') ?>
                          {{ Form::text('acc_commercial_registration',null,array('id'=>'account-commercial-registration','placeholder'=>$regComm)) }}
                          {{--<input name="account_commercial_registration" id="account-commercial-registration" type="text" placeholder="    سجل تجاري  ">--}}
                      </div>
                    </div>
                     <div class="row no-margin-top">
                    <div class="col s12 l2">
                      <label for="tax-card">
                          @lang('main.taxCard')
                      </label>
                    </div>
                    <div class="col s12 l3">
                      <div class="input-field">
                        <i class="mdi mdi-social-person prefix"></i>
                          <?php $taxCard=Lang::get('main.taxCard') ?>

                          {{ Form::text('acc_tax_card',null,array('id'=>'tax-card','placeholder'=>$taxCard )) }}
                          {{--<input name="tax_card" id="tax-card" type="text" placeholder=" البطاقة الضريبية ">--}}
                      </div>
                    </div>
</div>
                      @endif
                  </div>
                  <div class="row no-margin-top">
                                      <div class="col s12 l2">
                                        <label for="account-notes">
                                            @lang('main.notes')
                                        </label>
                                      </div>
                                      <div class="col s12 m6 l6">
                                        <div class="input-field">
                                          <i class="mdi mdi-social-person prefix"></i>
                                            <?php $notes=Lang::get('main.notes') ?>

                                            {{ Form::text('acc_notes',null,array('id'=>'branch-notes','placeholder'=>$notes)) }}
                                            {{--<input  name="account_notes" id="account-notes" type="text" placeholder=" ملاحظات">--}}
                                        </div>
                                      </div>

                                    </div>
                  <div class="row">
                      <div class="col s12 l12">
                          <button class="waves-effect btn">@lang('main.add')</button>
                      </div>
                      {{ Form::close() }}
                  </div>
                </div>
                  <table id="table_bank" class="display table table-bordered table-striped table-hover">

                  @include('dashboard.accounts._table_view')
</div>
</div>


</section>
@stop