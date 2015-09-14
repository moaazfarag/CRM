@extends('dashboard.main')
@section('content')
  <!-- Main Content -->
  <section id="print-content"  ng-app="itemApp"  ng-controller="mainController" class="content-wrap ecommerce-invoice">

    <div class="card-panel">
{{--{{ dd($invoice); }}--}}
      <!-- Logo -->
      <div class="row invoice-top">
        <div class="col s12 m6">
          <img src="{{ URL::asset('dashboard/assets/_con/images/logo.png') }}" alt="Logo">
          <br>{{ $co_info->co_name }}
        </div>
        <div class="col s12 m6">
          <h3>فاتورة</h3>
        </div>
      </div>
      <!-- /Logo -->
      <br>

      <div class="row">
        <!-- Invoice From -->
        <div class="col s12 l4">
          فاتورة من :
            @if($type == 'buy')
                @if($invoice->accountInfo)
                    {{$invoice->accountInfo->acc_name }}
                @endif
            @endif
          <h4>{{ $co_info->co_name }}
            <br>
          فرع :
            <strong>{{ $invoice->branch->br_name }}</strong>
          </h4>
          <address>
            {{ $invoice->branch->br_address }}
          <br> {{ $co_info->co_tel }}<i class="mdi-communication-phone"></i>
        </address>
        </div>
        <!-- /Invoice From -->

        <!-- Invoice To -->
        <div class="col s12 l4">
          الى
            @if($type == 'buy')
                {{ $invoice->branch->br_name }}
            @else
            @if($invoice->accountInfo)
                    {{ $invoice->accountInfo->acc_name }}
                @endif
            @endif
            <h4>@lang('main.'.$type)</h4>
        </div>
        <!-- /Invoice To -->

        <!-- Invoice Number and Date -->
        <div class="col s12 l4">
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
        <!-- /Invoice Number and Date -->
      </div>
      <br>

      <!-- Table with products -->
      <div class="row">
        <div class="col s12">

          <div class="table-responsive">
            <table class="table table-responsive invoice-table">
              <thead>
                <tr>
                  <th>الرقم</th>
                  <th class="center-align">الاسم</th>
                  <th class="center-align">العدد</th>
                  <th class="center-align">سعر الوحدة</th>
                  <th class="center-align">الاجمالي</th>
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
                  <td class="center-align">{{ $detail->unit_price }}</td>
                  <td class="center-align">{{ $detail->item_total }}</td>
                  <td class="center-align">{{ $detail->serial_no }}</td>
                </tr>
                @endforeach
                    <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="center-align"><strong>الاجمالي</strong>
                  </td>
                  <td class="center-align">{{ $invoice->in_total }}</td>
                  <td ></td>
                   </tr>
                <tr>

                  <td class="right-align no-border"><strong>الضرائب</strong>
                  </td>
                  <td class="right-align no-border" colspan="2">{{ $invoice->tax }}</td>
                </tr>
                <tr>
                  <td class="right-align no-border"><strong>تخفيض</strong>
                  </td>
                  <td class="right-align no-border" colspan="2">{{ $invoice->discount }}%</td>
                </tr>
                <tr>
                  <td class="right-align"><strong>الاجمالي</strong>
                  </td>
                  <td class="right-align" colspan="2">
                    <strong class="h2">{{ $invoice->net }}</strong>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
      <!-- /Table with products -->

    </div>

    <br>
    <div class="right-align invoice-print">
      <span class="btn" onclick="javascript:window.print();">اطبع</span>
    </div>
    {{--{{ dd(DB::getQueryLog()) }}--}}
  </section>
  <!-- /Main Content -->
@stop
