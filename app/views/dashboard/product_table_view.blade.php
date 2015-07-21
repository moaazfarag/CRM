
          <thead>
            <tr>
              <th>الرقم</th>
              <th>الاسم </th>
              <th>سعر الشراء  </th>
              <th>وحدة القياس</th>
              <th> الفئة </th>
              <th>المورد </th>
              <th>الموسم </th>
              <th>الموديل </th>
              <th> حد البيع</th>
              <th>ملاحظات</th>
              <th>تعديل</th>
            </tr>
          </thead>
          <tbody>
        @foreach($items as $item)
            <tr>
              <th>{{$item->id}}</th>
              <td>{{$item->item_name}}</td>
              <td>{{$item->buy}}</td>
              <td>{{$item->unit}}</td>
              <th>{{$item->cat->name}}</th>
              <th>{{$item->accounts->acc_name}}</th>
              <th>{{$item->seasons->name}}</th>
              <th>{{$item->models->name}}</th>
              <th>{{$item->limit}}</th>
              <th>{{$item->notes}}</th>
              <td>
                <a href="{{ URL::route('editItem',array($item->id)) }}" class="btn btn-small z-depth-0">
                    <i class="mdi mdi-editor-mode-edit"></i>
                </a>
              </td>

            </tr>
            @endforeach

          </tbody>
        </table>

