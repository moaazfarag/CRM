
          <thead>
            <tr>
              <th>الرقم</th>
              <th>اسم الصنف </th>
              <th>الباركود</th>
              <th> الكمية</th>
              <th> التكلفة </th>
              <th>السيريال </th>
              <th>التاريخ </th>
              <th>تعديل </th>
            </tr>
          </thead>
          <tbody>
        @foreach($items as $item)
            <tr>
              <th>{{$item->id}}</th>
              <td>{{$item->item_id}}</td>
              <td>{{$item->bar_code}}</td>
              <td>{{$item->qty}}</td>
              <th>{{$item->cost}}</th>
              <th>{{$item->serial_no}}</th>
              <th>{{$item->updated_at}}</th>
              <td>
                <a href="{{ URL::route('editItemsBalances',array($item->id)) }}" class="btn btn-small z-depth-0">
                    <i class="mdi mdi-editor-mode-edit"></i>
                </a>
              </td>

            </tr>
            @endforeach

          </tbody>
        </table>

