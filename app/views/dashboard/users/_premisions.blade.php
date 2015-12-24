<div class="row">
    <div class="col l12 s12">
        <hr/>
        <h5 style=" color:#000000; font-weight: 500; width: 100%; padding: 1%; border-radius: 2%;" >  صلاحيات المستخدم</h5>
        <hr/>
        <div class="table-responsive" >
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
                    <tr class="z-depth-4" style="background-color: rgba(204, 204, 204, 0.65); color: rgba(0, 0, 0, 0.87)">
                        <th>@lang('main.'.$main)  </th>
                        @foreach($group as $v)
                            <td>
                                    {{ Form::hidden($v,'0') }}
                                    {{ Form::checkbox($v,'1',0,array('id'=>$v.$main)) }}
                                    <label ng-click="selectALl('{{ $main."_".$v }}')" for="{{ $v.$main }}" style="color: rgba(0, 0, 0, 0.87)">@lang('main.'.$v)</label>
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
                                            <li class="parsley-required">{{ $errors->First($k.'_'.$name) }} </li>
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
</div>
