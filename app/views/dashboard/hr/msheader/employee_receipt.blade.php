@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
<div class="card    ">
    @foreach($headers as $header)
            <!-- Invoice Number and Date -->
    <div class="col s12 l4">
            <div class="num">
ايصال رقم :

                <strong>{{ $header->ms_trans_id }}</strong>
تاريخ الصرف :
                {{ $header->created_at }}
                              </div>
عن شهر :
        {{ Input::get('for_month') }}
        لسنة :
        {{ Input::get('for_year') }}

        </div>

    <!-- /Invoice Number and Date -->

    <br>


    @lang('main.name'):{{ $header->employee->name }}
الاساسي :
        {{ $header->fixed_salary }}
الاجمالي :
    {{ $header->net }}
القروض:
    {{ $header->loan }}

            <!-- Table with products -->
    <div class="row">
        <div class="col s12">
@if(!$header->details->isEmpty())
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>الاستحقاق / الاستقطاع</th>
                        <th >القيمة</th>
                        <th >النوع</th>
                        <th >الفئة</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($header->details as $k => $detail)
                        <tr>
                        <td>
                            {{ Deduction::find($detail->des_ded_id)->name }}
                        </td>
                        <td>
                            {{ $detail->des_ded_val}}
                        </td>
                        <td>
                        {{ Deduction::find($detail->des_ded_id)->ds_type }}
                        </td>
                        <td>
                        {{ Deduction::find($detail->des_ded_id)->ds_cat }}
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                @endif

<br>

    <!-- /Table with products -->
    @endforeach
            </div>
        </div>
    </div>
</div>
        <div class="right-align invoice-print">
            <span class="btn" onclick="javascript:window.print();">اطبع</span>
        </div>



</section>
@stop

