<div class="row">
    <div class="col l10 s12">

        <table  class="display table table-bordered table-striped table-hover" style=" font-size: 1em; ">
                <thead>
                <tr>
                    <th>الاسم</th>
                    <th>حفظ</th>
                    <th> تعديل</th>
                    <th>حذف</th>
                    <th>عرض</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($groupPermissions))


                @foreach($groupPermissions as $main =>$permissions)
                    <tr style="background-color: #999999; color:#ffffff">
                        <th>@lang('main.'.$main)  </th>
                        @foreach($group as $v)
                            <td>
                                    {{ Form::hidden($v,'0') }}
                                    {{ Form::checkbox($v,'1',0,array('id'=>$v.$main)) }}
                                    <label ng-click="selectALl('{{ $main."_".$v }}')" for="{{ $v.$main }}" style="color: #ffffff">@lang('main.'.$v)</label>
                                    <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                        <li class="parsley-required">{{ $errors ->First($v) }} </li>
                                    </ul>
                            </td>
                        @endforeach
                    </tr>

                    @foreach($permissions as $name=>$permission)
                        <tr>
                            <th>@lang('main.'.$name)</th>
                            @foreach($permission as $k=>$v)
                                <td>
                                        {{ Form::hidden($k.'_'.$name,'0') }}
                                        {{ Form::checkbox($k.'_'.$name,'1',$v,array('id'=>$k.'_'.$name,'class'=>$main.'_'.$k.'_all')) }}
                                        <label for="{{ $k.'_'.$name }}"></label>
                                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                            <li class="parsley-required">{{ $errors ->First($k.'_'.$name) }} </li>
                                        </ul>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach
                    @endif
                </tbody>
            </table>

    </div>
</div>
