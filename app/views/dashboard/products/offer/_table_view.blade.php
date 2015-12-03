<div class="card">
    <div class="content">
        <div class="table-responsive">
            <table id="" class="display table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>@lang('main.number')</th>
                    <th>@lang('main.name') </th>
                    <th>@lang('main.offerValue') </th>
                    <th>@lang('main.from') </th>
                    <th>@lang('main.to') </th>
                    <th>@lang('main.edit')</th>
                    <th>@lang('main.delete')</th>
                    <th>
                        {{ Form::open(array('route'=>array('multiDelete',$table_name))) }}
                        <button  class="btn btn-small red" style="float: right;">حذف المحدد</button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($offers as $k=> $offer)
                    <tr>
                        <th>{{ $k+1 }}</th>
                        <td>{{ $offer->name }}</td>
                        <td>{{ $offer->offer }}%</td>
                        <td>{{ $offer->from }}</td>
                        <td>{{ $offer->to }}</td>
                        <td>
                            <a href="{{ URL::route('editOffer',array($offer->id)) }}" class="btn btn-small z-depth-0">
                                <i class="mdi mdi-editor-mode-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a onclick="return confirm('هل تريد بالفعل حذف  العرض')"
                               href="{{ URL::route('deleteOffer',array($offer->id)) }}"
                               class="btn btn-danger red">[X]</a>

                        </td>
                        <td>

                            <input type="checkbox" id="checkbox{{ $k }}" name="checkbox[]"  value="{{ $offer->id }}" />
                            <label for="checkbox{{ $k }}"></label>

                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>