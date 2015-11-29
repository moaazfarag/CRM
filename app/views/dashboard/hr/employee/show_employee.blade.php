@extends('dashboard.main')

@section('content')
    <section class="content-wrap">
        <div class="card-panel">
        {{--name --}}
            <div class="card-panel blue lighten-5 center_title">
البيانات الخاصة بالموظف /
                {{ $employee->name }}
            </div>


                @if($employee->photo != '')
                <div class="row">
                    <div class="col l4 " >
                        <br/>
                    </div>


                    <div class="col l3 " >
                        <div class="card image-card">
                            <div class="image">
                                <img src="{{ $employee->photo }}"  style="max-width:350px; height:200px;" alt="">
                                <a href="page-profile.html" class="link"></a>
                            </div>

                        </div>
                    </div>
                    <div class="col l5 " >
                        <br/>
                    </div>
                </div>
                @endif

            <div class="row">
                <div class="col l12 s12" >
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header"><i class="mdi-image-filter-drama"></i>بيانات الوظيفة</div>
                            <div class="collapsible-body">

                                <table class="display table  table-striped table-hover">
                                    <tr>
                                        <td><h5>
                                                تاريخ التعيين
                                            </h5></td>
                                        <td><h5>
                                                {{ BaseController::ViewDate($employee->employee_date) }}
                                            </h5></td>
                                    </tr>

                                    <tr>
                                        <td><h5>
                                                الفرع
                                            </h5></td>
                                        <td><h5>
                                                {{ Branches::company()->where('id',$employee->br_id)->first()->br_name }}
                                            </h5>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><h5>
                                                الوظيفة
                                            </h5></td>
                                        <td><h5>
                                                {{ $employee->jobs->name}}
                                            </h5></td>
                                    </tr>
                                    <tr>
                                        <td><h5>
القسم
                                            </h5></td>
                                        <td><h5>
                                                {{ $employee->departments->name }}
                                            </h5></td>
                                    </tr>
                                    <tr>
                                        <td><h5>
                                                نوع التعاقد
                                            </h5></td>
                                        <td>
                                            <h5>
                                                {{ $employee->work_nature }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>
                                                المرتب
                                            </h5></td>

                                        <td><h5>
                                                {{ $employee->salary }}
                                            </h5> </td>
                                    </tr>






                                </table>
                                </div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="mdi-maps-place"></i>التأمين</div>
                            <div class="collapsible-body">
                                <table class="display table  table-striped table-hover">
                                    <tr>
                                        <td><h5>
                                                مرتب التأمينات
                                            </h5></td>
                                        <td><h5>
                                                {{ $employee->ins_salary }}
                                            </h5></td>
                                    </tr>
                                    <tr>
                                        <td><h5>
                                                خصم التأمين
                                            </h5></td>
                                        <td><h5>
                                                {{ $employee->ins_val }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>
                                                رقم التأمين
                                            </h5></td>
                                        <td><h5>
                                                {{ $employee->ins_no }}
                                            </h5></td>
                                    </tr>

                                </table>
                            </div>
                        </li>

                        <li>
                            <div class="collapsible-header"><i class="mdi-social-whatshot"></i>البيانات الشخصية</div>
                            <div class="collapsible-body">
                                <table class="display table  table-striped table-hover">

                                <tr>
                                    <td><h5>
                                            الجنس
                                        </h5></td>
                                    <td><h5>
                                            {{ $employee->sex }}
                                        </h5>
                                    </td>
                                </tr>

                                <tr>
                                    <td><h5>
                                            الحالة الإجتماعية
                                        </h5></td>
                                    <td><h5>
                                            {{ $employee->marital}}
                                        </h5></td>
                                </tr>
                                <tr>
                                    <td><h5>
                                            الديانة
                                        </h5></td>
                                    <td><h5>
                                            {{ $employee->religion }}
                                        </h5></td>
                                </tr>
                                <tr>
                                    <td><h5>
                                            الرقم القومى
                                        </h5></td>
                                    <td>
                                        <h5>
                                            {{ $employee->card_no }}
                                        </h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h5>
                                            تاريخ الميلاد
                                        </h5></td>

                                    <td><h5>
                                            {{ BaseController::ViewDate($employee->birth_date) }}
                                        </h5> </td>
                                </tr>

                                <tr>
                                    <td><h5>
                                            موقف التجنيد
                                        </h5></td>
                                    <td><h5>
                                            {{ $employee->military_service }}
                                        </h5></td>
                                </tr>




                                </table>

                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="mdi-social-whatshot"></i>جهات الإتصال</div>
                            <div class="collapsible-body">
                                <table class="display table  table-striped table-hover">
                                    <tr>
                                        <td><h5>
                                                رقم الهاتف 1
                                            </h5></td>
                                        <td><h5>
                                                {{ $employee->tel1}}
                                            </h5></td>
                                    </tr>
                                    <tr>
                                        <td><h5>
                                                رقم الهاتف 2
                                            </h5></td>
                                        <td><h5>
                                                {{ $employee->tel2 }}
                                            </h5></td>
                                    </tr>
                                    <tr>
                                        <td><h5>
                                                العنوان
                                            </h5></td>
                                        <td>
                                            <h5>
                                                {{ $employee->address	 }}
                                            </h5>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="mdi-social-whatshot"></i>المؤهل</div>
                            <div class="collapsible-body">
                                <table class="display table  table-striped table-hover">
                                    <tr>
                                        <td><h5>
                                                المؤهل
                                            </h5></td>
                                        <td><h5>
                                                {{ $employee->certificate }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>
                                                جهة المؤهل
                                            </h5></td>
                                        <td><h5>
                                                {{ $employee->cert_location }}
                                            </h5></td>
                                    </tr>

                                    <tr>
                                        <td><h5>
                                                تاريخ المؤهل
                                            </h5></td>
                                        <td><h5>
                                                {{ $employee->cert_date }}
                                            </h5>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
                {{--photo--}}

            </div>
          </div>

      </div>
        
    </section>
@stop
