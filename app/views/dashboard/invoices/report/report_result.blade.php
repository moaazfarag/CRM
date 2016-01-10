

    <div class="card" style="padding:1%;">
        <div class="right-align invoice-print">
            <span class="btn indigo" onclick="javascript:window.print();"><i class="ion-printer"></i></span>
        </div>

        <div  class="card-panel blue lighten-5 center_title">
            {{ $title }}
        </div>


        @unless($invoices->isEmpty())

         @if($sum != 'sum')

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
                <th>@lang('main.item_name_')</th>
                <th>@lang('main.category')</th>
                <th>@lang('main.qty_')</th>
                <th>@lang('main.sum_')</th>
                <th>@lang('main.result_sum')</th>
            </tr>
            </thead>
            <tbody>

            {{--end if sum --}}
            @endif

            <?php  $all_net = array(); $all_qty = array();  $i = 0; $all_invoice = array();  $all_items = array(); ?>

            @foreach($invoices as  $invoice)

                    @foreach($invoice->details as $details)

                      @if($cat_id != '' &&  $item_id != '')

                            @if($details->cat_id == $cat_id && $details->item_id == $item_id )

                                @if($sum != 'sum')
                                <tr>
                                    <td>{{ $invoice->invoice_no }}</td>
                                    <td>{{ $invoice->date }}</td>
                                    <td>{{ $invoice->branch->br_name }}</td>
                                    <td>{{ $details->item_name }}</td>
                                    <td>{{ Category::find($details->cat_id)->name }}</td>
                                    <td>{{ $details->qty }}</td>
                                    <td>{{ $details->unit_price }}</td>
                                    <td>{{  $details->qty * $details->unit_price}}</td>

                                </tr>

                                {{--end if sum --}}
                                @endif

                                <?php  $i++; $all_net[$i] =  $details->qty * $details->unit_price;  ?>
                             @endif

                        @elseif($cat_id == '' &&  $item_id != '')

                          @if($details->item_id == $item_id )

                              @if($sum != 'sum')
                              <tr>
                                <td>{{ $invoice->invoice_no }}</td>
                                <td>{{ $invoice->date }}</td>
                                <td>{{ $invoice->branch->br_name }}</td>
                                <td>{{ $details->item_name }}</td>
                                <td>{{ Category::find($details->cat_id)->name }}</td>
                                <td>{{ $details->qty }}</td>
                                <td>{{ $details->unit_price }}</td>
                                <td>{{  $details->qty * $details->unit_price}}</td>

                            </tr>
                              {{--end if sum --}}
                              @endif

                              <?php  $i++; $all_net[$i] =  $details->qty * $details->unit_price; $all_qty[$i] = $details->qty; $all_invoice[$invoice->invoice_no] = $invoice->invoice_no; $all_items[$details->id] = $details->item_name;  ?>
                          @endif

                        @elseif($cat_id != '' &&  $item_id == '')

                          @if($details->cat_id == $cat_id )

                              @if($sum != 'sum')

                              <tr>

                                <td>{{ $invoice->invoice_no }}</td>
                                <td>{{ $invoice->date }}</td>
                                <td>{{ $invoice->branch->br_name }}</td>
                                <td>{{ $details->item_name }}</td>
                                <td>{{ Category::find($details->cat_id)->name }}</td>
                                <td>{{ $details->qty }}</td>
                                <td>{{ $details->unit_price }}</td>
                                <td>{{  $details->qty * $details->unit_price}}</td>

                            </tr>
                              {{--end if sum --}}
                              @endif
                              <?php  $i++; $all_net[$i] =  $details->qty * $details->unit_price; $all_qty[$i] = $details->qty; $all_invoice[$invoice->invoice_no] = $invoice->invoice_no; $all_items[$details->id] = $details->item_name;  ?>
                          @endif



                         @else
                                @if($sum != 'sum')
                            <tr>
                                    <td>{{ $invoice->invoice_no }}</td>
                                    <td>{{ $invoice->date }}</td>
                                    <td>{{ $invoice->branch->br_name }}</td>
                                    <td>{{ $details->item_name }}</td>
                                    <td>{{ Category::find($details->cat_id)->name }}</td>
                                    <td>{{ $details->qty }}</td>
                                    <td>{{ $details->unit_price }}</td>
                                    <td>{{  $details->qty * $details->unit_price}}</td>

                            </tr>
                            {{--end if sum --}}
                             @endif

                            <?php  $i++; $all_net[$i] =  $details->qty * $details->unit_price; $all_qty[$i] = $details->qty; $all_invoice[$invoice->invoice_no] = $invoice->invoice_no; $all_items[$details->id] = $details->item_name;  ?>
                     @endif


                    @endforeach




            @endforeach
           <?php  $count_invoices  = $i; ?>

            @if($sum != 'sum')

            </tbody>
        </table>
     </div>
            @endif
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
                        <caption class="caption-style">
الإجمالى
                        </caption>

                    </tr>
                    <tr>
                        <th>عدد الفواتير </th>
                        <th> إجمالى الكميات </th>
                        <th> إجمالى الأصناف </th>
                        <th>الإجمالى </th>
                        <th>إجمالى الخصومات</th>
                        <th>إجمالى الضرائب</th>
                        <th>الصافى </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ count($all_invoice) }}</td>
                        <td>{{ array_sum($all_qty) }}</td>
                        <td>{{ count($all_items) }}</td>
                        <td>{{ array_sum($all_net)  }}</td>
                        <td>{{ array_sum($all_discount) }}</td>
                        <td>{{ array_sum($all_tax) }}</td>
                        <td>{{ array_sum($all_net) - array_sum($all_discount) + array_sum($all_tax) }}</td>
                    </tr>
                    </tbody>
                </table>
              </div>



            @else
            <div class="alert  orange lighten-4 orange-text text-darken-2">
                <strong>عفواً!</strong>
                لا يوجد نتائج
            </div>
            @endif

    </div>
