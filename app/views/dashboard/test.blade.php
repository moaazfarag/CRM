
@extends('dashboard.main')
@section('content')
    <!-- JS -->
{{ HTML::script('dashboard/assets/angular.min.js') }}
{{ HTML::script('dashboard/assets/jquery/jquery.min.js') }}
    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>--}}
    {{--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->--}}

    <!-- ANGULAR -->
    <!-- all angular resources will be loaded from the /public folder -->
    {{--<script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->--}}
    {{--<script src="js/services/commentService.js"></script> <!-- load our service -->--}}
    {{--<script src="js/app.js"></script> <!-- load our application -->--}}
    {{ HTML::script('dashboard/scripts/app.js') }}
    {{ HTML::script('dashboard/scripts/itemService.js') }}
    {{ HTML::script('dashboard/scripts/mainCtrl.js') }}

</head>
<!-- declare our angular app and controller -->
<body class="container" ng-app="itemApp" ng-controller="mainController">
<div class="col-md-8 col-md-offset-2">

    <!-- PAGE TITLE -->
    <div class="page-header">
        <h2>Laravel and Angular Single Page Application</h2>
        <h4>Commenting System</h4>
    </div>

    <!-- NEW COMMENT FORM -->
    {{--<form ng-submit="pushItem()"> <!-- ng-submit will disable the default form action and use our function -->--}}

        <!-- AUTHOR -->
        <div class="form-group">
            <input type="text" class="form-control input-sm" name="item_name" ng-model="itemss.itemAmount" placeholder="Name">
        </div>

        <!-- COMMENT TEXT -->
        <div class="form-group">
            <input type="text" class="form-control input-lg" name="comment" ng-model="itemss.itemName" placeholder="Say what you have to say">
        </div>
        <div class="form-group">
            <input type="text" class="form-control input-lg" name="comment" ng-model="itemName" placeholder="Say what you have to say">
        </div>

        <!-- SUBMIT BUTTON -->
        <div class="form-group text-right">
            <button ng-click="addItem()"  class="btn btn-primary btn-lg">Submit</button>
        </div>
    {{--</form>--}}

	<pre>
	{{--@{{ itemData }}--}}

	@{{ itemss }}@{{ items2 }}
	</pre>

    <!-- LOADING ICON -->
    <!-- show loading icon if the loading variable is set to true -->
    <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>
<style>


</style>
    <!-- THE COMMENTS -->
    <!-- hide these comments if the loading variable is true -->
    <div class="comment" ng-hide="loading" ng-repeat="item2 in items2">
        <h3>Comment #@{{ item2.amount }} <small>by @{{ item2.name }}</small></h3>
        <input style="border: 1px solid #FFF;" type="text" value="@{{ item2.amount }}" name="@{{ item2.amount }}" id="">
        <p>@{{ item2.amount }}</p>
        <p><a href="#" ng-click="deleteItem(item.id)" class="text-muted">Delete</a></p>
    </div>
    <div class="comment" ng-hide="loading" ng-repeat="item in items">
        <h3>Comment #@{{ item.id }} <small>by @{{ item.item_name }}</small></h3>
        <p>@{{ item.notes }}</p>
        <p><a href="#" ng-click="deleteItem(item.id)" class="text-muted">Delete</a></p>
    </div>

</div>
</body>
@stop
