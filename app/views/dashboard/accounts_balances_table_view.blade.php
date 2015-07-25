
          <thead>
            <tr>
              <th>الرقم</th>
              <th> مدين </th>
              <th>دائن</th>
              <th>التاريخ </th>
              <th>تعديل </th>
            </tr>
          </thead>
          <tbody>
        @foreach($items as $item)
            <tr>
              <th>{{$item->id}}</th>
              <td>{{$item->debit}}</td>
              <td>{{$item->credit}}</td>
              <th>{{$item->updated_at}}</th>
              <td>
                <a href="{{ URL::route('editAccountsBalances',array($item->id)) }}" class="btn btn-small z-depth-0">
                    <i class="mdi mdi-editor-mode-edit"></i>
                </a>
              </td>

            </tr>
            @endforeach

          </tbody>
        </table>

