
          <thead id="all-items">
          @if(Session::has('error'))
              <div id="hidden" class="alert" >

                  {{ Session::get('error') }}
              </div>
          @endif

          @if(Session::has('success'))

              <div  id="hidden" class="alert green lighten-4 green-text text-darken-2">
                  {{ Session::get('success') }}
              </div>
          @endif

            <tr>
              <th>@lang('main.number')</th>
              <th>@lang('main.name') </th>
              <th>@lang('main.purchPrice')</th>
              <th>@lang('main.measUnit')</th>
              <th> @lang('main.category') </th>
              <th>@lang('main.supplier') </th>
              <th>@lang('main.season') </th>
              <th>@lang('main.model') </th>
              <th> @lang('main.sellLimit') </th>
              <th>@lang('main.notes')</th>
              <th>@lang('main.edit')</th>
              <th>@lang('main.cancel')</th>

            </tr>
          </thead>
          <tbody>
        @foreach($co_info->items as $item)
            <tr>
              <th>{{$item->id}}</th>
              <td>{{$item->item_name}}</td>
              <td>{{$item->buy}}</td>
              <td>{{$item->unit}}</td>
              <th>{{@$item->cat->name}}</th>
              <th>{{@$item->accounts->acc_name}}</th>
              <th>{{@$item->seasons->name}}</th>
              <th>{{@$item->models->name}}</th>
              <th>{{$item->limit}}</th>
              <th>{{$item->notes}}</th>
              <td>
                <a href="{{ URL::route('editItem',array($item->id)) }}" class="btn btn-small z-depth-0">
                    <i class="mdi mdi-editor-mode-edit"></i>
                </a>
              </td>
                <td>
                    <a  onclick="return confirm('هل تريد بالفعل إلغاء هذا الصنف')" href="{{ URL::route('deleteItems',array($item->id)) }}" class="btn btn-danger red">[X]</a>
                </td>
            </tr>
            @endforeach

          </tbody>
        </table>

