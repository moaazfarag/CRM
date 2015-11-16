@extends('dashboard.main')
@section('content')
  <!-- Main Content -->
  <section id="print-content"  ng-app="itemApp"  ng-controller="mainController" class="content-wrap ecommerce-invoice">

    <div class="card-panel">
{{--{{ dd($invoice); }}--}}
      <!-- Logo -->

        <div class="row invoice-top">
            <div class="col s3 m3">
                @if($co_info->co_logo)
                <img width="150px" height="39px" src="{{ URL::asset($co_info->co_logo) }}" alt="Logo">
                @endif
                <br>
                @lang('main.the_company') :
                {{ $co_info->co_name }}
                <br>
                @lang('main.the_branch') &nbsp;&nbsp;&nbsp; :
                    <strong>{{ $invoice->branch->br_name }}</strong>

            </div>
            <div class="col s6 m6" >
                <div style=" font-size: 1.5em; font-weight: 500; text-decoration: underline;  text-align: center;" >
                    @lang('main.invoice') @lang('main.'.$type)
                </div>
                <div style=" font-size: 1.3em; font-weight: 500; text-align: center;" >

                {{@ $invoice->accountInfo->acc_name }}
               </div>
                <div style="font-size: 1.3em; font-weight: 500; text-align: center;" >
                        @if($invoice->pay_type)
                            {{@ Lang::get("main.$invoice->pay_type"._); }}
                        @endif
                </div>

                <br/>


            </div>

            <div class="col s3 m3">
                <div class="invoice-num">
                    <div class="num">
                        @lang('main.invoiceNum'):
              <span class="right">
                <strong>{{ $invoice->invoice_no }}</strong>
              </span>
                    </div>
                    </h4>
                    <div class="date">@lang('main.date'):
              <span class="right">
                {{ $invoice->date }}
              </span>
                    </div>
                    </h4>
                </div>

            </div>

            <hr/>
        </div>
        <!-- /Logo -->
        <br>
        <hr/>
        <br>

      <!-- Table with products -->
      <div class="row">
        <div class="col s12">

          <div class="table-responsive">
            <table id="table1" class="display table table-bordered table-hover" >
              <thead>
                <tr>
                  <th>الرقم</th>
                  <th class="center-align">الاسم</th>
                  <th class="center-align">العدد</th>
                @if(!TransController::isSettle($type))
                    <th class="center-align">سعر الوحدة</th>
                    <th class="center-align">الاجمالي</th>
                @endif
                    <th class="right-align">السيريال</th>
                </tr>
              </thead>
              <tbody>
               @foreach($invoice->details as $k =>$detail)
                <tr>
                  <td>
                    {{ $k+1 }}
                  </td>
                  <td>
                    <strong> {{ $detail->item_name }}</strong>
                  </td>
                  <td class="center-align">{{ $detail->qty }}</td>
                @if(!TransController::isSettle($type))
                        <td class="center-align">{{ $detail->unit_price }}</td>
                        <td class="center-align">{{ $detail->item_total }}</td>
                @endif
                    <td class="center-align">{{ $detail->serial_no }}</td>
                </tr>
                @endforeach
               @if(!TransController::isSettle($type))

                    <tr>
                  <td><strong>الاجمالي</strong></td>
                  <td style="border-right:none;border-left:none;"></td>
                  <td style="border-right:none;border-left:none;"></td>
                  <td style="border-right:none;border-left:none;"></td>
                  <td style="border-right:none;border-left:none;"></td>
                  <td class="center-align">{{ $invoice->in_total }}</td>
                   </tr>
                <tr>

                @endif

              </tbody>
            </table>
          </div>

        </div>
          <div class="col s12">
              {{--{{  dd("dsfd");}}--}}
              @if(!TransController::isSettle($type))
              <div class="table-responsive">
                  <table id="table1" class="display table table-bordered table-hover" >
                      <thead>
                      <tr>
                          <td><strong>الاجمالي</strong></td>
                          <td class="right-align no-border"><strong>تخفيض</strong></td>
                          <td class="right-align no-border"><strong>الضرائب</strong></td>
                          <td class="right-align no-border"><strong>الصافى </strong></td>
                      </tr>
                      </thead>
                      <tbody>

                          <tr>
                              <td> {{ $invoice->net }}</td>
                              <td>{{ $invoice->discount }}%</td>
                              <td>{{ $invoice->tax }}</td>
                              <td>{{ $invoice->net }}</td>


                          </tr>

                      </tbody>
                  </table>
                  @endif
              </div>
              <address>
              عنوان الشركة الرئيسى
                  /
                  {{ $co_info->co_address }}
تيلفون /
                   {{ $co_info->co_mobile_1 }} <i class="mdi-communication-phone"></i>
              @if($co_info->co_mobile_2 !='')
                  &nbsp;&nbsp;&nbsp;&nbsp;
                      تيلفون2 <i class="mdi-communication-phone"></i>
                     {{ $co_info->co_mobile_2 }}  <i class="mdi-communication-phone"></i>
                  @endif
              </address>
          </div>

      </div>
      <!-- /Table with products -->

    </div>

    <br>
    <div class="right-align invoice-print">
      <span class="btn" onclick="javascript:window.print();">اطبع</span>
@if($type =='buy' || $type=='settleAdd'|| $type=='itemBalance' )
        <a class="no-print waves-effect btn" href="{{ URL::route('viewLabel',$invoice->id) }}" >طباعة الباركود</a>    </div>
@endif
      {{--{{ dd(DB::getQueryLog()) }}--}}
  </section>
  <!-- /Main Content -->
@stop
