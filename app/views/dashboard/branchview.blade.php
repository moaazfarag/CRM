        <table class="table table-hover">
          <thead>
            <tr>

              <th>رقم الفرع</th>
              <th>اسم الفرع</th>
              <th>عنوان الفرع </th>
              <th>الحالة </th>
              <th>تعديل</th>
            </tr>
          </thead>
          <tbody>
          @foreach($branches as $branch)
            <tr>

              <th>{{ $branch->id }}</th>
              <td>{{ $branch->br_name }}</td>
              <td>
                <a href="ecommerce-product-single.html">
                  <span class="grey-text">{{ $branch->br_address }}</span>
                </a>
              </td>
              <td class="green-text">Active</td>
              <td>
                  <a href="{{ URL::route('editBranch',array("branch_id"=>$branch->id)) }}" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
              </td>
            </tr>
@endforeach

          </tbody>
        </table>