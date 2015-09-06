<table  class="display table table-bordered table-striped table-hover">
    <thead>
    <tr>

        <th> @lang('main.delete')</th>
        <th> @lang('main.num')</th>
        <th> @lang('main.item_name')</th>
        <th> @lang('main.quantity')</th>
        <th> @lang('main.item_prise') </th>
        <th> @lang('main.sum')</th>
        <th> @lang('main.serial_')</th>

    </tr>
    </thead>
    <tbody>
    <tr ng-repeat="invoiceItem in invoiceItems">
        @{{  item }}
        <td>
            <a href ng-click="removeItem(invoiceItem)" class="btn btn-danger">[X]</a>
        </td>{{--invoice Item DELETE BUTTON --}}
        <td>
            @{{ invoiceItems.indexOf(invoiceItem)+1 }}
        </td>{{--invoice Item COUNT --}}
        <td>
            <input hidden class="input-without-border" ng-pattern="/^[0-9]+$/" name="id_@{{ invoiceItems.indexOf(invoiceItem) }}"  ng-model="invoiceItem.id" type="number" value="@{{ invoiceItem.id }}"/>
            <input disabled class="input-without-border" name="name_@{{ invoiceItems.indexOf(invoiceItem) }}" ng-model="invoiceItem.name" type="text" />
            <input hidden class="input-without-border" name="name_@{{ invoiceItems.indexOf(invoiceItem) }}" ng-model="invoiceItem.name" type="text" />
        </td>{{--invoice Item NAME & ID--}}
        <td>
            <input  ng-pattern="/^[0-9]+$/" class="input-without-border" required name="quantity_@{{ invoiceItems.indexOf(invoiceItem) }}"  ng-model="invoiceItem.quantity" type="number" value="@{{ invoiceItem.quantity }}"/>
            <div class="error-div-for-table" ng-show="form.$submitted || form.quantity_@{{ invoiceItems.indexOf(invoiceItem) }}.$touched">
                <div ng-show="form.quantity_@{{ invoiceItems.indexOf(invoiceItem) }}.$error.pattern">
                    @lang('main.please_enter_valid_number')
                </div>
            </div>
        </td>{{--invoice Item quantity--}}
        <td>
            @{{ invoiceItem.cost   }}
        </td>{{--invoice Item cost --}}
        <td>
            @{{ invoiceItem.cost * invoiceItem.quantity  }}
        </td>{{--invoice Item TOTAL--}}
        <td>
            <input ng-required="isRequired(invoiceItem.has_serial)" ng-disabled="hasSerialInvoiceItem(invoiceItem.has_serial)" class="input-without-border"  name="serial_@{{ invoiceItems.indexOf(invoiceItem) }}"  ng-model="invoiceItem.serial" type="text" />
        </td>
    </tr>
    </tbody>
</table>
