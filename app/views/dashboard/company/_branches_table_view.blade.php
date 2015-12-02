<div class="table-responsive" >

<table class="table table-hover">
          <thead>
            <tr>

              <th>@lang('main.branchNum') </th>
              <th>@lang('main.branchName') </th>
              <th>@lang('main.branchAddress')</th>
@if(PerC::isShow('main_info','branch','edit'))
              <th>@lang('main.edit')</th>
    @endif
            </tr>
          </thead>
          <tbody>
          @foreach($branches as $k => $branch)
            <tr>

              <th>{{$k+1 }}</th>
              <td>{{ $branch->br_name }}</td>
              <td>
                <a href="ecommerce-product-single.html">
                  <span class="grey-text">{{ $branch->br_address }}</span>
                </a>
              </td>
@if(PerC::isShow('main_info','branch','edit'))
              <td>
                  <a href="{{ URL::route('editBranch',array("br_id"=>$branch->id)) }}" class="btn btn-small z-depth-0"><i class="mdi mdi-editor-mode-edit"></i></a>
              </td>
            @endif

            </tr>
@endforeach

          </tbody>
        </table>
    </div>