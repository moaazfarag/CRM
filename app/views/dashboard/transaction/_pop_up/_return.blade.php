                     <!-- pop up  Structure -->
<div  id="addItem"  class="modal">
    {{--<a class="modal-action modal-close btn-floating red " style="float: left;text-align: center">X</a>--}}
    <div class="modal-content">
        <div  class="card-panel blue lighten-5" style="font-size: 1.2em; color: #333;  text-align: center; margin-bottom: 2%; ">

        رقم الفاتورة : @{{ header.invoice_no }}
        تاريخ الفاتورة : @{{ header.date }}
        طريقة الدفع  : @{{ header.pay_type }}
            </div>
        <div class="table-responsive" >
            <table ng-show="invoiceItems"  class="display table table-bordered table-striped table-hover">
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
                    <input ng-required="isRequired(invoiceItem.serial_no)" ng-disabled="hasSerialInvoiceItem(invoiceItem.serial_no)" class="input-without-border"  ng-model="invoiceItem.serial_no" type="text" readonly />
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
        <div class="modal-footer">

            <div ng-click="backItem(header.discount)" style="margin-right: 1%;" >

                <button ng-click="backItem(header.discount)" type="button" style="margin-left: 10px" class="modal-action modal-close waves-effect blue  white-text waves-red btn-flat">اضف</button>
            </div>
            <div ng-click="finishReturnInvoice()" >
                <button ng-click="finishReturnInvoice()" type="button"  class="modal-action modal-close waves-effect red white-text waves-red btn-flat">انهاء</button>
            </div>
        </div>
     </div>

</div>