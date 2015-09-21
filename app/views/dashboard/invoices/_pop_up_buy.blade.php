
<div ng-app="itemApp" ng-controller="mainController"  id="returnsInvoice" class="modal">
    <div class="modal-content">

        {{ Form::open(array('route'=>array('storeEmpdesdedPop'))) }}
        <div class="row">
            <label>ادخل رقم الفاتوره</label>
        </div>
        <div class="row">

            <div class="col s12 l3">
                {{--<i class="fa fa-tag prefix"></i>--}}
                <div class="input-field">
                    {{ Form::label('invoice_type',' ') }}
                    <input ng-model='invoice.id' autofocus="autofocus" ng-focus="getAllDedDis()" class='browser-default'  name="ds_id" id="returnsInvoice">
                        <option ng-repeat="dudDis in dudDiss" value="@{{ dudDis.id }}">@{{ dudDis.name }}</option>
                    </input>
                    <p class="parsley-required">{{ $errors ->first('ds_id') }} </p>
                </div>
                {{--@{{  item }}--}}
            </div>
        </div>
       @{{
        dudDis.ds_id
         }}
            <div class="row">
            <div class="col s12 l3">
                <div class="input-field">
                    <button type="button" ng-click="returnInvoiceData(invoice)" class="waves-effect btn">بحث</button>
                </div>
            </div>
            </div>
        {{ Form::close() }}
        <table class="table table-hover">
            <thead>
            <tr>
                <th>الصنف </th>
                <th> العدد</th>
                <th> السعر</th>
                <th>السيريال </th>
                <th> مرتجع</th>

            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="returnsInvoice in invoiceData">
                <td>@{{ returnsInvoice.item_name }}</td>
                <td>@{{ returnsInvoice.qty }}</td>
                <td>@{{ returnsInvoice.unit_price }}</td>
                {{--<td>--}}
                    {{--<button type="button"  ng-click="deleteEmpDudDes(embDudDis.id)"--}}
                            {{--class="btn btn-danger red">[X]</button>--}}
                {{--</td>--}}
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col s12 l12">
                <button type="button" ng-click="getInvoiceById(id)" class="waves-effect btn">@lang('main.add')</button>
                <button type="button" href="#!" class="modal-action modal-close waves-effect waves-red btn-flat "> انهاء</button>
            </div>

        </div>{{--submit  row end--}}
    </div>
    <div class="modal-footer">

    </div>
</div>