@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section ng-app="itemApp" ng-controller="mainController" class="content-wrap ecommerce-dashboard">
    <!--  addUser addUser  اضف مستخدم للنظام      -->
        <div class=" card " style="padding: 1%;">
            <div class="card-panel blue lighten-5 center_title">
                <h5>
                    تم تسجيل المستخدم
                    {{ $name }}
                    بنجاح
                </h5>

            </div>
            <div class="content">
                <div class="table-responsive" >
                    <table id="" class="display table table-bordered  table-hover">
                        <thead>
                        <tr>
                            <th>أسم المستخدم </th>
                            <th>كلمة المرور </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $user_name }}</td>
                            <td>12345678</td>
                        </tr>
                        </tbody>
                </table>
                    </div>
                <div class="row" style="padding:5px 15px 5px 5px ">
                    <button class="waves-effect btn">
                        <a style="color: #FFFFFF" href="{{ URL::route('addUser') }}">
                            رجوع
                        </a>
                    </button>

                </div>
            </div>
        </div>

        <!--    /Store Settings -->

</section>
<!-- /Main Content -->


@stop