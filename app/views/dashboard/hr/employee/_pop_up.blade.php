
<div ng-app="employeeApp" ng-controller="employeeController" ng-init="dudDis.empId = {{ $employee->id }} "  id="addDud" class="modal">
    <div class="modal-content">
        <h4>
        @lang('main.fixed_debt_for_employee')
          <strong>{{ $employee->name }}</strong>
        </h4>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>@lang('main.clause') </th>
                    <th>@lang('main.value') </th>
                    <th>@lang('main.canceld')</th>
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
                        <button type="button"  ng-click="deleteEmpDudDes(embDudDis.id)"
                            class="btn btn-danger red">[X]</button>
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
                            {{ Form::number('val',null,array('data-parsley-id'=>'4370','class'=>($errors->first('val'))?'parsley-error':null,'ng-required'=>"displayCondition",'ng-model'=>'dudDis.val','id'=>'val')) }}
                            {{ Form::label('val',  lang::get('main.value') )     }}
                            <p class="parsley-required">{{ $errors ->first('val') }} </p>
                           <span style="font-size: large"> @{{  message }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l12">
                            <button type="button" ng-click="storeEmpDud(dudDis)" class="waves-effect btn">@lang('main.add')</button>
                        <button type="button" href="#!" class="modal-action modal-close waves-effect waves-red btn-flat "> @lang('main.cancel')</button>
                    </div>
                    {{ Form::close() }}
                </div>{{--submit  row end--}}





    </div>
    <div class="modal-footer">

    </div>
</div>