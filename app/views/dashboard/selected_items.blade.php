<table  class="display table table-bordered table-striped table-hover">
          <thead>
            <tr>

              <th>حذف</th>
              <th>الرقم</th>
              <th>اسم الصنف </th>
              <th> الكمية</th>
              <th> التكلفة </th>
              <th> االكلى  </th>

            </tr>
          </thead>
          <tbody>
<style>
    .inputwithoutborder {
        border: 1px solid #F5F5F5!important;
        margin: 0!important;

    }

</style>
<form name="test">

            <tr ng-repeat="invoiceItem in invoiceItems">
                <td>
                    <a href ng-click="removeItem(invoiceItem)" class="btn btn-danger">[X]</a>
                </td>
                <td>@{{ invoiceItems.indexOf(invoiceItem)+1 }}</td>
                <td><input disabled class="inputwithoutborder" ng-model="invoiceItem.name" type="text" /></td>
                <td>
                    <input   hidden class="inputwithoutborder" name="id_@{{ invoiceItems.indexOf(invoiceItem) }}"  ng-model="invoiceItem.id" type="number" value="@{{ invoiceItem.id }}"/>
                    <input class="inputwithoutborder" required name="quantity_@{{ invoiceItems.indexOf(invoiceItem) }}"  ng-model="invoiceItem.quantity" type="number" value="@{{ invoiceItem.quantity }}"/>
                    <div ng-show="form.$submitted || form.quantity_@{{ invoiceItems.indexOf(invoiceItem) }}.$touched">
                        <div ng-show="form.quantity_@{{ invoiceItems.indexOf(invoiceItem) }}.$error.integer">Tell us your name.</div>
                    </div>
                </td>

                <td>
                    <input class="inputwithoutborder" name="cost_@{{ invoiceItems.indexOf(invoiceItem) }}" ng-model="invoiceItem.cost" type="text" value="@{{ invoiceItem.cost }}"  />
                </td>
              <th>@{{ invoiceItem.cost * invoiceItem.quantity  }}</th>
              </td>

            </tr>
</form>
          </tbody>
        </table>
@{{ form.quantity[0] }}
@{{ invoiceItem }}