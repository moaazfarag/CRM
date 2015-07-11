<div class="card-panel">
<table class="table table-hover">
          <thead>
            <tr>
              <th>الرقم</th>
              <th>الاسم </th>
              <th>الحالة </th>
              <th>تعديل</th>

            </tr>
          </thead>
          <tbody>
          @foreach($tablesData as $tableData)
            <tr>
              <th>{{ $tableData->id }}</th>
              <td>{{ $tableData->name }}</td>
              <td class="green-text">Active</td>
              <td>
                  <a href="{{ URL::route($catFunName,array($tableData->id)) }}" class="btn btn-small z-depth-0">
                      <i class="mdi mdi-editor-mode-edit"></i>
                  </a>
              </td>
            </tr>

        @endforeach

          </tbody>
        </table>
</div>