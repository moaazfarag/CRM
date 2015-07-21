             <div class="row">
                              <div class="col  l12">
       <div class="card-panel">


                   <table id="table_customers" class="display table table-bordered table-striped table-hover">

          <thead>
            <tr>
              <th>رقم  المسلسل</th>
              <th>الاسم</th>
              <th>اسم المستخدم</th>
               <th>   ت  الاضافة </th>
              <th>الحالة </th>
              <th>تعديل</th>
            </tr>
          </thead>
          <tbody>
          @foreach($company->users as $user)
            <tr>
              <th> {{ $user->id }}</th>
              <td> {{ $user->name }} </td>
              <td> {{ $user->username }} </td>
              <td> {{ $user->formattedCreatedDate() }}</td>
              <td class="green-text">Active</td>
              <td><a href="{{URL::route('editUser',$user->id)}}" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
              </td>
            </tr>
@endforeach
          </tbody>
        </table>
        </div>
        </div>
        </div>