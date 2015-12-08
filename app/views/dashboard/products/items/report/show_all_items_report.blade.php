<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/28/2015
 * Time: 2:08 PM
 */
?>
@extends('dashboard.main')
@section('content')
        <!-- Main Content -->

<section id="print-content"  class="content-wrap ecommerce-invoice " ng-app>
    <div class="right-align invoice-print">
        <span class="btn indigo" onclick="javascript:window.print();"><i class="ion-printer"></i></span>
    </div>
    <div class="card" style="padding:1%;">


        <div  class="card-panel blue lighten-5 center_title">
{{ $title }}
        </div>

    @if(count($categories))
        @foreach($categories as $category)
            <div class="table-responsive" >
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <caption class="caption-style">{{ $category->name }} </caption>
                    </tr>
                    <tr>
                        <th> الرقم </th>
                        <th> اسم الصنف</th>
                        <th> الباركود</th>
                        <th> سعر البيع</th>
                        <th>سعر الجملة </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category->items as $item)
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->bar_code }}</td>
                        <td>{{ $item->sell_users }}</td>
                        <td>{{ $item->sell_gomla }}</td>
                     @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
    </div>
</section>
<!-- /Main Content -->

@stop
