<div class="card">
    <div class="content">
        <div class="table-responsive" >
        <table id="table_bank" class="display table table-bordered table-striped table-hover">
            <thead id="all-items">
            <tr>
                <th>@lang('main.number')</th>
                <th>@lang('main.name') </th>
                <th>@lang('main.purchPrice')</th>
                <th>@lang('main.measUnit')</th>
                <th> @lang('main.category') </th>
                {{--<th>@lang('main.supplier') </th>--}}
                {{--<th>@lang('main.season') </th>--}}
                {{--<th>@lang('main.mark') </th>--}}
                {{--<th>@lang('main.model') </th>--}}
                <th> @lang('main.sellLimit') </th>
                <th>@lang('main.notes')</th>
                @if(PerC::isShow('main_info','item','edit'))
                    <th>@lang('main.edit')</th>
                @endif
                @if(PerC::isShow('main_info','item','delete'))
                    <th>@lang('main.cancel')</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($co_info->items as $item)
                <tr>
                    <th>{{$item->true_id}}</th>
                    <td><a href="{{ URL::route('showItem',$item->id)  }}">{{$item->item_name}}</a></td>
                    <td>{{$item->buy}}</td>
                    <td>{{$item->unit}}</td>
                    <th>{{@$item->cat->name}}</th>
                    {{--<th>{{@$item->accounts->acc_name}}</th>--}}
                    {{--<th>{{@$item->seasons->name}}</th>--}}
                    {{--<th>{{@$item->marks->name}}</th>--}}
                    {{--<th>{{@$item->models->name}}</th>--}}
                    <th>{{$item->limit}}</th>
                    <th>{{$item->notes}}</th>
                    @if(PerC::isShow('main_info','item','edit'))
                        <td>
                            <a href="{{ URL::route('editItem',array($item->id)) }}" class="btn btn-small z-depth-0">
                                <i class="mdi mdi-editor-mode-edit"></i>
                            </a>
                        </td>
                    @endif
                    @if(PerC::isShow('main_info','item','delete'))
                        <td>
                            <a onclick="return confirm('هل تريد بالفعل إلغاء هذا الصنف')"
                               href="{{ URL::route('deleteItems',array($item->id)) }}"
                               class="btn btn-danger red">[X]</a>
                        </td>
                    @endif
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
</div>