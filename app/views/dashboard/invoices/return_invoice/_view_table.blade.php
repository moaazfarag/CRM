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

    <tr  ng-repeat="(key,invoiceItem) in  backItem()" >
        <td>
            @{{ key+1 }}
        </td>{{--invoice Item COUNT --}}
        <td>
            <input hidden class="input-without-border" ng-pattern="/^[0-9]+$/" name="id_@{{key }}"  ng-model="invoiceItem.item_id" type="number" value="@{{ invoiceItem.id }}"/>
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
                   required name="quantity_@{{ key }}"
                   ng-model="invoiceItem.qty"
                   type="number"
                   value="@{{ invoiceItem.qty }}" readonly/>
            <div style="color: #ea1c18;background-color: #f0f4c3" id="@{{ invoiceItem.id}}div">
        </div>
            <div ng-show="form.quantity_@{{ key }}.$error.max" style="color: #ea1c18">
لايوجد رصيد كافي
        </div>

            <div class="error-div-for-table" ng-show="form.$submitted || form.quantity_@{{ key }}.$touched">
                <div ng-show="form.quantity_@{{ key }}.$error.pattern">
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
            <input ng-required="isRequired(invoiceItem.has_serial)" ng-disabled="hasSerialInvoiceItem(invoiceItem.has_serial)" class="input-without-border"  name="serial_@{{ key }}"  ng-model="invoiceItem.serial_no" type="text" readonly />
        </td>
        <td>
            <input ng-required="isRequired(invoiceItem.has_serial)" max="@{{ invoiceItem.qty }}" min="1" class="input-without-border"  name="return_@{{ key }}"  ng-model="invoiceItem.return" type="number"  />
        </td>
    </tr>
    </tbody>
</table>
