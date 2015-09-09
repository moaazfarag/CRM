
          <thead>
            <tr>
              <th>@lang('main.number')</th>
              <th>@lang('main.name') </th>
              <th>@lang('main.mail')  </th>
              <th>@lang('main.address')</th>
              <th>@lang('main.phone_number_1')</th>
              <th>@lang('main.phone_number_2')</th>
              <th>@lang('main.regComm') </th>
                <th>@lang('main.pricing')</th>
                <th>@lang('main.taxCard')</th>
              <th>@lang('main.notes')</th>
              <th>@lang('main.edit')</th>
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
              <th>{{$rowData->acc_tel2}}</th>
              <th>{{$rowData->acc_commercial_registration}}</th>
              <th>{{  AccountController::pricing_name($rowData->pricing) }}</th>
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

