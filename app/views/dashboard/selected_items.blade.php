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
            <tr ng-repeat="invoiceItem in invoiceItems">
                <td><a href ng-click="removeItem(item)" class="btn btn-danger">[X]</a></td>
                <td>@{{ invoiceItems.indexOf(invoiceItem)+1 }}</td>
                <td><input class="inputwithoutborder" name="id[@{{ invoiceItems.indexOf(invoiceItem) }}]" ng-model="invoiceItem.name" type="text"  value="@{{ invoiceItem.name }}" name="cost" /></td>
                <td><input class="inputwithoutborder" name="quantity[@{{ invoiceItems.indexOf(invoiceItem) }}]"  ng-model="invoiceItem.quantity" type="text" value="@{{ invoiceItem.quantity }}" name="quantity" /></td>
                <td><input class="inputwithoutborder" name="cost[@{{ invoiceItems.indexOf(invoiceItem) }}]" ng-model="invoiceItem.cost" type="text" value="@{{ invoiceItem.cost }}" name="cost" /></td>
              <th>@{{ invoiceItem.cost * invoiceItem.quantity  }}</th>
              </td>

            </tr>

          </tbody>
        </table>

