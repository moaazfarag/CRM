                     <!-- pop up  Structure -->
<div  id="addItem"  class="modal">
    <a class="modal-action modal-close btn-floating red " style="float: left;text-align: center">X</a>
    <div class="modal-content">
        رقم الفاتورة : @{{ header.invoice_no }}
        تاريخ الفاتورة : @{{ header.date }}
        طريقة الدفع  : @{{ header.pay_type }}
        <table  class="display table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> @lang('main.num')</th>
                <th> @lang('main.item_name')</th>
                <th> @lang('main.quantity')</th>
                <th> @lang('main.item_prise') </th>
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
                    <input id="@{{ invoiceItem.id }}"
                           @if($type == "buy")
                           max="@{{ returnBalance(invoiceItem) }}"
                           @else
                           max="@{{ invoiceItem.balance }}"
                           @endif
                           ng-pattern="/^[0-9]+$/"
                           class="input-without-border"
                           required
                           ng-model="invoiceItem.qty"
                           type="number"
                           value="@{{ invoiceItem.qty }}" readonly/>
                    <div style="color: #ea1c18;background-color: #f0f4c3" id="@{{ invoiceItem.id}}div">
                    </div>
                    <div ng-show="form.quantity_@{{ invoiceItems.indexOf(invoiceItem) }}.$error.max" style="color: #ea1c18">
                        لايوجد رصيد كافي
                    </div>

                    <div class="error-div-for-table" ng-show="form.$submitted || form.quantity_@{{ invoiceItems.indexOf(invoiceItem) }}.$touched">
                        <div ng-show="form.quantity_@{{ invoiceItems.indexOf(invoiceItem) }}.$error.pattern">
                            @lang('main.please_enter_valid_number')
                        </div>
                    </div>
                </td>{{--invoice Item quantity--}}
                <td>

                    @{{ invoiceItem.unit_price  }}
                </td>{{--invoice Item cost --}}
                <td>
                    @{{ invoiceItem.item_total  }}
                </td>{{--invoice Item TOTAL--}}
                <td>
                    <input ng-required="isRequired(invoiceItem.has_serial)" ng-disabled="hasSerialInvoiceItem(invoiceItem.has_serial)" class="input-without-border" = ng-model="invoiceItem.serial_no" type="text" readonly />
                </td>
                <td>
                    <input ng-required="isRequired(invoiceItem.has_serial)" max="@{{ invoiceItem.qty }}" min="1" class="input-without-border"  ng-model="invoiceItem.return" type="number"  />
                </td>
            </tr>
            </tbody>
        </table>

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
                    <td>@{{ header.net }}</td>
                    <td>@{{ header.discount }}%</td>
                    <td>@{{ header.tax }}</td>
                    <td>@{{ header.net }}</td>


                </tr>

                </tbody>
            </table>
        </div>

     </div>

     <div class="modal-footer">
         <button ng-show="range == 'oneByone'" ng-disabled="hasSerial(new.serial)"
                 type="button"
                 ng-click="discountItemHasSerial($scope.item.quantity)"
                 class="waves-effect btn">
             اضف
         </button >
         <button ng-show="range == 'range'"
                 ng-disabled="new.to<new.form || (new.to - new.form) >100 || (!new.prefix || !new.form || !new.to)"
                 href="#addItem"
                 type="button"
                 ng-click="discountItemHasSerial($scope.item.quantity) "
                 class="waves-effect btn ">
             اضف
         </button >

<div></div>
         <div ng-click="clearItemForm()" >

             <button type="button"  class="modal-action modal-close btn">انهاء</button>
         </div>
     </div>
 </div>