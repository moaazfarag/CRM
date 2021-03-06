
    <div class="card" style="padding:1%;">
        <div class="right-align invoice-print">
            <span class="btn indigo" onclick="javascript:window.print();"><i class="ion-printer"></i></span>
        </div>

        <div  class="card-panel blue lighten-5 center_title">
            {{ $title }}
        </div>

        <div class="table-responsive" >
            <table   class="display table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <caption class="caption-style">
                    الفترة من
                    {{ BaseController::ViewDate($date_from) }}
                    حتى
                    {{ BaseController::ViewDate($date_to) }}
                </caption>

            </tr>

            <tr>

                <th>@lang('main.invoiceNum')</th>
                <th>@lang('main.date')</th>
                <th>@lang('main.branchName')</th>
                <th>@lang('main.trans_type')</th>
                <th>@lang('main.item_name_')</th>
                <th>@lang('main.category')</th>
                <th>@lang('main.qty_')</th>
                <th>@lang('main.buy_prise_avg')</th>
                <th>@lang('main.sales_prise')</th>
                <th>@lang('main.debit_')</th>
                <th>@lang('main.credit_')</th>
            </tr>
            </thead>
            <tbody>
            <?php  $credit = array(); $debit = array(); $i = 0;  ?>

            @unless($invoices->isEmpty())


                    @foreach($invoices as  $invoice)

                        @foreach($invoice->details as $details)
                                <tr>
                                    <?php
                                    $earnings =  ($details->unit_price - $details->avg_cost) * $details->qty ;
                                    ?>
                                    <td>{{ $invoice->invoice_no }}</td>
                                    <td>{{ $invoice->date }}</td>
                                    <td>{{ $invoice->branch->br_name }}</td>
                                    <td>{{ lang::get('main.'.$invoice->invoice_type) }}</td>
                                    <td>{{ $details->item_name }}</td>
                                    <td>{{ Category::find($details->cat_id)->name }}</td>
                                    <td>{{ $details->qty }}</td>
                                    <td>{{ $details->avg_cost }}</td>
                                    <td>{{ $details->unit_price }}</td>
                                        @if($invoice->invoice_type == 'sales')
                                        <td> 0.00</td>
                                            <td>{{  $earnings  }}
                                            <?php $credit[$i]= $earnings ?>
                                            </td>

                                        @elseif($invoice->invoice_type =='salesReturn')
                                            <td>{{  $earnings  }}</td>
                                            <td> 0.00</td>
                                            <?php $debit[$i] = $earnings ?>

                                        @endif
                                </tr>
                                <?php  $i++;  ?>
                             @endforeach
                        @endforeach
                    @endunless
                    @unless($expenses_and_revenue->isEmpty())
                       @foreach($expenses_and_revenue as  $expensesAndRevenu)
                           <?php  $i++;  ?>
                           <tr>
                            <td>{{ $expensesAndRevenu->account_trans_no }}</td>
                            <td>{{ BaseController::ViewDate($expensesAndRevenu->date) }}</td>
                            <td>{{ $expensesAndRevenu->branch->br_name }}</td>
                            <td>{{ lang::get('main.'.$expensesAndRevenu->account) }}</td>
                            <td>{{ Accounts::company()->find($expensesAndRevenu->account_id)->acc_name }}</td>
                            <td> -- </td>
                            <td> -- </td>
                            <td> -- </td>
                            <td> -- </td>
                            <td>{{ $expensesAndRevenu->debit }} </td>
                            <td>{{ $expensesAndRevenu->credit }}</td>
                            <?php $debit[$i]= $expensesAndRevenu->debit; $credit[$i]=  $expensesAndRevenu->credit ?>
                        </tr>
                        @endforeach
                    @endunless
                    </tbody>
                </table>
                </div>
        {{--##### discount  #####--}}

        <?php $all_discount = [];  $all_tax = [];?>
        @foreach($invoices as  $i=>$invoice)

            @if($invoice->discount != 0)
                <?php
                $discount = ($invoice->in_total) * ($invoice->discount)/100;
                $tax      = ($invoice->in_total - $discount) * ($invoice->tax)/100;

                $all_discount[$i] = $discount;
                $all_tax[$i]      = $tax;
                ?>
            @endif
        @endforeach

        @if(array_sum($all_discount) != 0)
            <div class="table-responsive" >
                <table   class="display table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <caption class="caption-style">
                            الخصومات
                        </caption>

                    </tr>

                    <tr>

                        <th>@lang('main.invoiceNum')</th>
                        <th>@lang('main.date')</th>
                        <th>@lang('main.branchName')</th>
                        <th>نسبة الخصم</th>
                        <th>قيمة الخصم</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $all_discount = array(); ?>
                    @foreach($invoices as  $i=>$invoice)

                        @if($invoice->discount != 0)
                            <tr>
                                <td>{{ $invoice->invoice_no }}</td>
                                <td>{{ $invoice->date }}</td>
                                <td>{{ $invoice->branch->br_name }}</td>
                                <td>{{ $invoice->discount}}%</td>
                                <td>{{ ($invoice->in_total) * ($invoice->discount)/100 }}</td>
                            </tr>
                            <?php $all_discount[$i] =($invoice->in_total) * ($invoice->discount)/100; ?>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {{--end discount --}}

        {{--##### tax #####--}}
        @if(array_sum($all_tax) != 0)
            <div class="table-responsive" >
                <table   class="display table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <caption class="caption-style">
                            الضرائب
                        </caption>

                    </tr>

                    <tr>

                        <th>@lang('main.invoiceNum')</th>
                        <th>@lang('main.date')</th>
                        <th>@lang('main.branchName')</th>
                        <th>نسبة الضريبة </th>
                        <th> قيمة الضريبة</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $all_tax = array(); ?>
                    @foreach($invoices as  $i=>$invoice)

                        @if($invoice->discount != 0)
                            <?php
                            $discount = ($invoice->in_total) * ($invoice->discount)/100;
                            $tax      = ($invoice->in_total - $discount) * ($invoice->tax)/100;

                            $all_tax[$i]      = $tax;
                            ?>
                            <tr>
                                <td>{{ $invoice->invoice_no }}</td>
                                <td>{{ $invoice->date }}</td>
                                <td>{{ $invoice->branch->br_name }}</td>
                                <td>{{ $invoice->tax  }}%</td>
                                <td>{{ $tax  }}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {{--end tax --}}
        <div class="table-responsive" >
            <table  style="width:80%; margin:1% auto;" class="display table table-bordered table-striped table-hover">
                    <thead>

                    <tr>
                        <th>مدين</th>
                        <th>  دائن </th>
                        <th>  رصيد </th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                            $_debit  = array_sum($debit);
                            $_credit = array_sum($credit)- array_sum($all_discount) + array_sum($all_tax) ;
                        ?>
                        <td>{{ $_debit }}</td>
                        <td>{{ $_credit }} </td>
                        <td>{{ BaseController::negativeValue($_credit - $_debit) }}</td>
                    </tr>
                    </tbody>
                </table>
                </div>





                {{--<div class="alert  orange lighten-4 orange-text text-darken-2">--}}
                    {{--<strong>عفواً!</strong>--}}
                    {{--لا يوجد نتائج--}}
                {{--</div>--}}

    </div>
