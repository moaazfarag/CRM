@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard" ng-app="itemApp" ng-controller="mainController">
    {{ Form::open(array('route'=>array('printBarcode'))) }}
    <div class=" card ">
        <div class="content">
            <div class="table-responsive">
                <table id="table_bank" class="display table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>@lang('main.number')</th>
                        <th>@lang('main.name')</th>
                        <th>@lang('main.category')</th>
                        @if($co_info->co_use_season)
                            <th>@lang('main.season')</th>
                        @endif
                        <th>العدد المراد طباعته</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $k => $item)
                        <tr>
                            <td>{{$k +1}}</td>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->cat->name }}</td>
                            @if($co_info->co_use_season)
                                <th>{{ @$item->seasons->name }}</th>
                            @endif
                            <td style="max-width: 150px">
                                    {{ Form::number('qty_'.$item->id) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="submit" class="waves-effect btn">
طباعة
                </button>
                {{ Form::close() }}
            </div>{{--submit  row end--}}
        </div>

</section>
@stop