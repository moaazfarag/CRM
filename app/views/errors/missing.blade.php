@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section id="print-content"  ng-app="itemApp"  ng-controller="mainController" class="content-wrap ecommerce-invoice">

<div class="container">
    <div class="row">
        <div class="col l12 s12">
            <img src="{{URL::asset('dashboard/img/404_3.jpg')}}" width="auto" style="width: 600px; min-height: 400px; margin: 1% "/>
        </div>
        <h1>
            @if(isset($error))
                {{ $error }}
            @else
                الصفحة المطلوبة غير موجودة
            @endif
        </h1>
    </div>

</div>

</section>
<!-- /Main Content -->
@stop