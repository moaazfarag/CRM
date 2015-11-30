<div class="card">
    <div class="content">

        <div class="table-responsive" >
            <table id="table_bank" class="display table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>@lang('main.num') </th>
                    <th>عنوان الموضوع </th>
                    <th>نوع الموضوع</th>
                    <th>@lang('main.edit') </th>
                    <th>@lang('main.delete') </th>
                </tr>
                </thead>
                <tbody>
                @foreach($tablesData as $k=> $tableData)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $tableData->title }}</td>
                        <td>{{ lang::get('main.'.$tableData->type.'_message') }}</td>
                            <td>
                                <a href="{{ URL::route('editTopic',array($tableData->id)) }}"
                                   class="btn btn-small z-depth-0">
                                    <i class="mdi mdi-editor-mode-edit"></i>
                                </a>
                            </td>

                            <td>
                                <a onclick="return confirm('هل تريد بالفعل حذف هذا الموضوع ')"
                                   href="{{ URL::route('deleteTopic',array($tableData->id)) }}"
                                   class="btn btn-danger red">[X]</a>
                            </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>