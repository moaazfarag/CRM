<div class="row">
                              <div class="col  l12">
       <div class="card-panel">


                   <table id="table_customers" class="display table table-bordered table-striped table-hover">

          <thead>
            <tr>
              <th>المسلسل</th>
              <th>الاسم</th>
              <th>الوظيفه</th>
              <th>القسم</th>
              <th>الراتب</th>
              <th>الديانه</th>
              <th>العنوان</th>
              <th>المؤهل</th>
              <th>تعديل</th>
            </tr>
          </thead>
          <tbody>
          @foreach($tablesData as $tableData)
              <tr>
                  <td>{{ $tableData->id }}</td>
                  <td>{{ $tableData->name }}</td>
                  <td>{{ $tableData->jobs->name }}</td>
                  <td>{{ $tableData->departments->name }}</td>
                  <td>{{ $tableData->salary }}</td>
                  <td>{{ $tableData->religion }}</td>
                  <td>{{ $tableData->address }}</td>
                  <td>{{ $tableData->certificate }}</td>

                  <td>
                      <a href="{{ URL::route('editEmp',array($tableData->id)) }}" class="btn btn-small z-depth-0">
                          <i class="mdi mdi-editor-mode-edit"></i>
                      </a>
                  </td>
              </tr>

          @endforeach


          </tbody>
        </table>
        </div>
        </div>
        </div>