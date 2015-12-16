<?php $title = 404 ?>
@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section id="print-content" ng-app="itemApp" ng-controller="mainController" class="content-wrap ecommerce-invoice">
    <div class="container">
        <div class="row">
            <div class="col l12 s12">
                <img src="{{URL::asset('dashboard/img/2.png')}}" width="auto"
                     style="max-width: 700px; min-height: 200px; margin: 1% "/>
                <h2>
                    {{ isset($error)?$error:'الصفحة المطلوبة غير موجودة'}}
                </h2>
            </div>

        </div>
    </div>
</section>
<!-- /Main Content -->
@stop