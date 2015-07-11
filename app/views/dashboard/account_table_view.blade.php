
          <thead>
            <tr>
              <th>الرقم</th>
              <th>الاسم </th>
              <th>البريد الاكتروني </th>
              <th>العنوان</th>
              <th>ارقام الهاتف </th>
              <th>السجل التجاري</th>
              <th>البطاقة الضربية</th>
              <th>ملاحظات</th>
              <th>تعديل</th>
            </tr>
          </thead>
          <tbody>
        @foreach($rowsData as $rowData)
            <tr>
              <th>{{$rowData->id}}</th>
              <td>{{$rowData->acc_name}}</td>
              <td>{{$rowData->acc_email}}</td>
              <td>{{$rowData->acc_address}}</td>
              <th>{{$rowData->acc_tel}}</th>
              <th>{{$rowData->acc_commercial_registration}}</th>
              <th>{{$rowData->acc_tax_card}}</th>
              <th>{{$rowData->acc_notes}}</th>
              <td>
                <a href="{{ URL::route('editAccount',array($accountType,$rowData->id)) }}" class="btn btn-small z-depth-0">
                    <i class="mdi mdi-editor-mode-edit"></i>
                </a>
              </td>

            </tr>
            @endforeach

          </tbody>
        </table>

