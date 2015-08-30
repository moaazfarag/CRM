
<div ng-app="employeeApp" ng-controller="employeeController" ng-init="dudDis.empId = {{ $employee->id }} "  id="addDud" class="modal">
    <div class="modal-content">
        <h4>
{{$employee->name}}            استحاقات ثابته للموظف
        </h4>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>البند </th>
                    <th>القيمه </th>
                    <th>ملغى  </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="embDudDis in embDudDiss">
                    <td>
                        @{{ embDudDis.name }}
                    </td>
                    <td>
                        @{{ embDudDis.val }}
                    </td>
                    <td>
                        <input name="deleted" type="checkbox"selected="select" id="deletedd" value="deleted" >
                        <label for="deleted"></label>
                    </td>
                </tr>
            </tbody>
        </table>
                {{ Form::open(array('route'=>array('storeEmpdesdedPop'))) }}
                <div class="row">

                    <div class="col s2 l4">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        <div class="input-field">
                            {{ Form::label('ds_id',' ') }}
                            <select ng-model='dudDis.ds_id' autofocus="autofocus" ng-focus="getAllDedDis({{ $employee->id }})" class='browser-default'  name="ds_id" id="ds_id">
                                <option ng-repeat="dudDis in dudDiss" value="@{{ dudDis.id }}">@{{ dudDis.name }}</option>
                            </select>
                            <p class="parsley-required">{{ $errors ->first('ds_id') }} </p>
                        </div>
                        {{--@{{  item }}--}}
                    </div>
                    <div class="col s12 l3">
                        <div class="input-field">
                            <i class="mdi mdi-action-language prefix"></i>
                            {{ Form::number('val',null,array('required','ng-model'=>'dudDis.val','id'=>'val')) }}
                            {{ Form::label('val',  'القيمه' )     }}
                            <p class="parsley-required">{{ $errors ->first('val') }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l12">
                            <button type="button" ng-click="storeEmpDud(dudDis)" class="waves-effect btn">اضف </button>
                        <button type="button" href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">انهاء </button>
                    </div>
                    {{ Form::close() }}
                </div>{{--submit  row end--}}





    </div>
    <div class="modal-footer">

    </div>
</div>