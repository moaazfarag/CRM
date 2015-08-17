<table  class="display table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th>حذف</th>
      <th>الرقم</th>
      <th>اسم الصنف </th>
      <th> الكمية</th>

    </tr>
  </thead>
  <tbody>
    <tr ng-repeat="invoiceItem in invoiceItems">
        <td>
            <a href ng-click="removeItem(invoiceItem)" class="btn btn-danger">[X]</a>
        </td>{{--invoice Item DELETE BUTTON --}}
        <td>
            @{{ invoiceItems.indexOf(invoiceItem)+1 }}
        </td>{{--invoice Item COUNT --}}
        <td>
            <input hidden class="input-without-border" ng-pattern="/^[0-9]+$/" name="id_@{{ invoiceItems.indexOf(invoiceItem) }}"  ng-model="invoiceItem.id" type="number" value="@{{ invoiceItem.id }}"/>
            <input disabled class="input-without-border" ng-model="invoiceItem.name" type="text" />
        </td>{{--invoice Item NAME & ID--}}
        <td>
            <input  ng-pattern="/^[0-9]+$/" class="input-without-border" required name="quantity_@{{ invoiceItems.indexOf(invoiceItem) }}"  ng-model="invoiceItem.quantity" type="number" value="@{{ invoiceItem.quantity }}"/>
            <div class="error-div-for-table" ng-show="form.$submitted || form.quantity_@{{ invoiceItems.indexOf(invoiceItem) }}.$touched">
                <div ng-show="form.quantity_@{{ invoiceItems.indexOf(invoiceItem) }}.$error.pattern">
                    برجاء ادخال رقم صحيح
                </div>
            </div>
        </td>{{--invoice Item quantity--}}
    </tr>
  </tbody>
</table>