<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/12/2015
 * Time: 1:43 PM
 */
?>


@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section   class="content-wrap ecommerce-invoice" ng-app>
    <div class="card" style="padding:1%;">
        <div class="right-align invoice-print">
            <span class="btn indigo" onclick="javascript:window.print();"><i class="ion-printer"></i></span>
        </div>

        {{--<div  class="card-panel blue lighten-5 center_title">--}}
            {{--{{ $title }}--}}
        {{--</div>--}}


    @if(!empty($balances))

                <table   class="display table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <caption class="caption-style">
                            {{ $title }}
                        </caption>

                    </tr>

                    <tr>
                        <th>@lang('main.branchName')</th>
                        <th>@lang('main.category')</th>
                        <th>@lang('main.item_name_')</th>



                        {{--@if(!in_array($type,['inventory_result','inventory_store']))--}}
                        <th>@lang('main.qty_')</th>
                        {{--@endif--}}

                        @if($type == 'evaluation_stores')


                            <th>@lang('main.buy_prise_avg')</th>
                            <th>@lang('main.sum_')</th>

                        @endif
                        @if($type == 'inventory_store')
                            <th>@lang('main.inventory') </th>
                        @endif
                        @if($type == 'inventory_result')
                            <th>@lang('main.inventory_result')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>

                    @if($type == 'inventory_store')
                      {{ Form::open(array('route'=>'inventoryResult')) }}
                        <?php
                        $all_item = '';
                        $i = 0 ;
                        $balances_count = count($balances);

                        ?>

                    @endif

                    @foreach($balances as $k=>$balance)

                        <?php
                            if($type == 'inventory_result'){

                                $branch_name = $balance['branch_name'];
                                $cat_name    = $balance['cat_name'];
                                $item_name   = $balance['item_name'];
                                $item_id     = $balance['item_id'];
                                $balance_num = $balance['balance_num'];
                                $inventory_num = $balance['inventory_num'];

                            }else{

                                $branch_name =  Branches::find($balance->br_id)->br_name;
                                $cat_name    =  Category::find($balance->cat_id)->name;
                                $item_name   = $balance->item_name;
                                $item_id     = $balance->item_id;
                                $balance_num = $balance->balance;
                            }

                        ?>

                        <tr>
                            <td>{{ $branch_name }}</td>
                            <td>{{ $cat_name }}</td>
                            <td>{{ $item_name }}</td>
                            {{--@if(!in_array($type,['inventory_result','inventory_store']))--}}
                            <td>{{ $balance_num }}</td>
                            {{--@endif--}}

                            @if($type == 'inventory_store')

                               <?php  $all_item.= $item_id;  $i++;  if($balances_count > $i){  $all_item.= '|'; }?>

                                    {{ Form::hidden('branchName_'.$item_id,$branch_name) }}
                                    {{ Form::hidden('catName_'.$item_id,$cat_name) }}
                                    {{ Form::hidden('itemName_'.$item_id,$item_name) }}
                                    {{ Form::hidden('balance_'.$item_id,$balance->balance) }}
                                    {{ Form::hidden('itemId_'.$item_id,$item_id) }}

                            <td style="max-width:20px;"> {{ Form::number('inventory_'.$item_id,null) }}  </td>

                            @endif



                            @if($type == 'inventory_result')
                                <td>{{  $balance_num - $inventory_num }}</td>
                            @endif
                            @if($type == 'evaluation_stores')

                                <td>{{ $balance->avg_cost }}</td>
                                <td>{{ $balance->avg_cost *  $balance->balance }}</td>

                            @endif
                        </tr>
                    @endforeach


                    </tbody>
                </table>

            @if($type == 'inventory_store')
                <div class="row">
                    <div dir="ltr" class="col s12 l12" style="float: left; padding: 2%;">
                        <button type="submit" class="waves-effect btn">
                            عرض
                        </button>
                    </div>
                </div>

                {{ Form::hidden('all_item',$all_item) }}
                {{ Form::close() }}
            @endif
            @else
                <div class="alert  orange lighten-4 orange-text text-darken-2">
                    <strong>عفواً!</strong>
                    لا يوجد نتائج
                </div>
            @endif


        @if(!empty($zero_results))

            <table   class="display table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <caption class="caption-style">
                        {{ $zero_result_title }}
                    </caption>

                </tr>

                <tr>
                    <th>@lang('main.category')</th>
                    <th>@lang('main.item_name_')</th>
                    <th>@lang('main.qty_')</th>
                </tr>
                </thead>
                <tbody>


                @foreach($zero_results as $items_balance_zero)
                    <tr>
                        <td>{{  Category::find($items_balance_zero->cat_id)->name }}</td>
                        <td>{{ $items_balance_zero->item_name }}</td>
                        <td>0</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>
</section>
<!-- /Main Content -->

@stop



