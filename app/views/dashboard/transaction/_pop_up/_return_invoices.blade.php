                     <!-- pop up  Structure -->
<div  id="addFromInvoices"  class="modal">
    <a class="modal-action modal-close btn-floating red " style="float: left;text-align: center">X</a>
    <div class="modal-content">
        رقم الفاتورة : @{{ header.invoice_no }}
        تاريخ الفاتورة : @{{ header.date }}
        طريقة الدفع  : @{{ header.pay_type }}
        <div class="col s12 l4">
            <div class="input-field">
                <i class="fa fa-database prefix"></i>
                {{ Form::label('invoice_no_by_account',"رقم الفاتورة") }}
                {{ Form::number('invoice_no_by_account',null,array('ng-model'=>"invoice.invoiceNoAcc",'ng-minlength'=>"1",'ng-pattern'=>"/^[0-9]+$/",'id'=>'invoice_no')) }}

                <button href="#addItem" ng-disabled="!invoice.invoiceNoAcc" type="button" ng-click="invoiceData('{{$type }}','{{ $branch->id}}',account.id)"   class="waves-effect btn">
استعراض
                </button >
            </div>


        </div>
        <div class="table-responsive" >
          <table  class="display table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> @lang('main.num')</th>
                <th> @lang('main.item_name')</th>
                <th> @lang('main.quantity')</th>
                <th> @lang('main.item_price') </th>
                <th> @lang('main.sum')</th>
                <th> @lang('main.serial_')</th>
                <th> المرتجع</th>

            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="invoiceItem in invoiceItems">
                <td>
                    @{{ invoiceItems.indexOf(invoiceItem)+1 }}
                </td>{{--invoice Item COUNT --}}
                <td>
                    <input hidden class="input-without-border" ng-pattern="/^[0-9]+$/"  ng-model="invoiceItem.item_id" type="number" value="@{{ invoiceItem.id }}"/>
                    @{{ invoiceItem.item_name }}

                </td>{{--invoice Item NAME & ID--}}
                <td>
                @{{ invoiceItem.qty }}
                </td>{{--invoice Item quantity--}}
                <td>

                    @{{ invoiceItem.unit_price  }}
                </td>{{--invoice Item cost --}}
                <td>
                    @{{ invoiceItem.item_total  }}
                </td>{{--invoice Item TOTAL--}}
                <td>
                    <input ng-required="isRequired(invoiceItem.serial_no)" ng-disabled="hasSerialInvoiceItem(invoiceItem.has_serial)" class="input-without-border"  ng-model="invoiceItem.serial_no" type="text" readonly />
                </td>
                <td>
                    <input  max="@{{ invoiceItem.qty }}" min="1" class="input-without-border"  ng-model="invoiceItem.return" type="number"  />
                </td>
            </tr>
            </tbody>
        </table>
        </div>
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
                    <td>@{{ header.in_total }}</td>
                    <td>@{{ header.discount }}%</td>
                    <td>@{{ header.tax }}</td>
                    <td>@{{ header.net }}</td>


                </tr>

                </tbody>
            </table>
        </div>

     </div>

     <div class="modal-footer">


<div></div>
         <div ng-click="multiBackItem(header.discount)">
             <button ng-click="multiBackItem(header.discount)" type="button"  class="btn">اضف</button>
         </div>
         <div ng-click="finishReturnInvoice()" >
             <button ng-click="finishReturnInvoice()" type="button"  class="modal-action modal-close btn">انهاء</button>
         </div>

     </div>
 </div>