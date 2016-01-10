<br/>
<div class="card-panel">
    <div class="right-align invoice-print">
        <span class="btn indigo" onclick="javascript:window.print();"><i class="ion-printer"></i></span>
    </div>
    <div class="table-responsive" >

    <table  class="display table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>@lang('main.number')</th>
            <th>@lang('main.employee_name') </th>
            <th>@lang('main.out_going_salaries_date') </th>
            <th>@lang('main.for_year') </th>
            <th>@lang('main.for_month') </th>
            <th>@lang('main.net')</th>
            <th>@lang('main.show_salary_detalis')</th>

        </tr>
        </thead>
        <tbody>
    @if(!empty($tablesData))
    
     <?php 
     $i       = 0;
     $all_net = array();  ?>

        @foreach($tablesData as $k => $tableData)
        
        <?php 
       
        $all_net[$i] =  $tableData->net;
        $i++ 

        ?>
            <tr>
                <td>{{ $k+1 }}</td>
                <td>{{ $tableData->employeeName->name }}</td>
                <td>{{ BaseController::ViewDateAndTime($tableData->created_at)}}
                <td>{{ $tableData->for_year }}</td>
                <td>{{ $tableData->for_month }}</td>
                <td>{{ $tableData->net }}</td>

                <td>
                    <a href="{{ URL::route('ViewOutGoingSalariesDetails',array($tableData->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-image-dehaze"></i>
                    </a>
                </td>
             

            </tr>

        @endforeach
        </tbody>
    </table>


     
</div>
    <div class="sub_title"> إجمالى صافى المرتبات خلال الفترة من
        <span class="date_style"> {{ BaseController::ViewDate($date_from) }} </span>
        حتى
        <span class="date_style"> {{ BaseController::ViewDate($date_to) }} </span>
        تساوى <?php echo array_sum($all_net) ?> </div>
    @endif
</div>


