<table  class="display table table-bordered table-striped table-hover">
    {{--id="table_bank"--}}
<thead>
            <tr>
                <th> @lang('main.delete') </th>
                <th> @lang('main.number') </th>
                <th> @lang('main.name')   </th>
                <th> @lang('main.debit')  </th>
                <th> @lang('main.Credit') </th>

            </tr>
</thead>
    <tbody>
          <tr ng-repeat="addedAccount in addedAccounts">

              <td>
                  <a href ng-click="removeAccount(addedAccount)" class="btn btn-danger">[X]</a>
              </td>{{--account Item DELETE BUTTON --}}
              <td>
                  @{{ addedAccounts.indexOf(addedAccount)+1 }}
              </td>{{--invoice Item COUNT --}}
              <td>
                  <input hidden class="input-without-border" ng-pattern="/^[0-9]+$/" name="id_@{{ addedAccounts.indexOf(addedAccount) }}"  ng-model="addedAccount.id" type="number" value="@{{ addedAccount.id }}"/>
                  <input disabled class="input-without-border" ng-model="addedAccount.acc_name" type="text" />
              </td>{{--account Item NAME & ID--}}
              <td>
                  <input  ng-pattern="/^[0-9]+$/" class="input-without-border"  name="debit_@{{ addedAccounts.indexOf(addedAccount) }}"  ng-model="addedAccount.debit" type="number" value="@{{ addedAccount.debit }}"/>
                  <div class="error-div-for-table" ng-show="form.$submitted || form.debit_@{{ addedAccounts.indexOf(addedAccount) }}.$touched">
                      <div ng-show="form.debit_@{{ addedAccounts.indexOf(addedAccount) }}.$error.pattern">
                        @lang('main.please_enter_valid_number')
                      </div>
                  </div>
              </td>{{--account Item quantity--}}
              <td>
                  <input  ng-pattern="/^[0-9]+$/" class="input-without-border" name="credit_@{{ addedAccounts.indexOf(addedAccount) }}" ng-model="addedAccount.credit" type="number" value="@{{ addedAccount.credit }}"  />
                  <div class="error-div-for-table" ng-show="form.$submitted || form.credit_@{{ addedAccounts.indexOf(addedAccount) }}.$touched">
                      <div ng-show="form.credit_@{{ addedAccounts.indexOf(addedAccount) }}.$error.pattern">
                          @lang('main.please_enter_valid_number')
                      </div>
                  </div>
                  <input hidden  class="input-without-border" name="notes_@{{ addedAccounts.indexOf(addedAccount) }}" ng-model="addedAccount.note" type="text" value="@{{ addedAccount.note }}"  />
              </td>{{--account Item COST--}}



          </tr>

          </tbody>
        </table>

@{{ addedAccounts }}