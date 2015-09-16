<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/16/2015
 * Time: 5:15 PM
 */
?>
@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section   class="content-wrap ecommerce-invoice">
    <div class="card">
        <table id="table_bank" class="display table table-bordered table-striped table-hover">
            <thead>
            <tr>

                <th>@lang('main.number') </th>
                <th> @lang('main.item_name')</th>
                <th>@lang('main.qty')</th>
                <th>@lang('main.cost')</th>
                <th>@lang('main.amount')</th>
                <th>@lang('main.bar_code')</th>
                <th>@lang('main.serial')</th>
                <th>@lang('main.edit')</th>
                <th>@lang('main.cancel')</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
            @foreach($balances as  $balance)
                <tr>
                    <?php  $i++; ?>
                    <th>{{ $i }}</th>
{{--                    <td>{{ $balance->items->name }}</td>--}}
                    <td>{{ $balance->qty }}</td>
                    <td>{{ $balance->cost }}</td>
                    <td>{{ ($balance->qty * $balance->cost) }}</td>
                    <td>{{ $balance->bar_code }}</td>
                    <td>{{ $balance->serial }}</td>

                        <td>
                        <a href="{{ URL::route('viewSettle',array($balance->id)) }}" class="btn btn-small z-depth-0">
                            <i class="mdi mdi-action-pageview"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ URL::route('viewSettle',array($balance->id)) }}" class="btn btn-danger red">

                           @lang('main.cancel')
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
<!-- /Main Content -->

@stop
