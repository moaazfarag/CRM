
@extends('dashboard.main')

@section('content')
    <section class="content-wrap">
        <div class="card-panel">
            {{--name --}}
            <div class="card-panel blue lighten-5 center_title">
                البيانات الخاصة بالصنف /
                {{ @$item->item_name }}
            </div>


            <div class="divider"></div>
        <div class="section">
            <h4>البيانات الأساسية</h4>
            <p>
           <div class="row">
                <div class="col l12 s12">
            <style>
                .ul-style-in-line li{
                    display: inline;
                    margin-left: 4%;
                    font-size: 1.1em;
                }
            </style>

                    <table class="display table  table-striped table-hover">
                      <thead id="all-items">
                        <tr>
                            <th>
                               الفئة
                            </th>

@if($co_info->co_use_markes_models)
                            <th>
                                الماركة
                            </th>
                            <th>
                                الموديل
                            </th>
@endif
@if($co_info->co_use_season)
                            <th>
                                الموسم
                            </th>
@endif
                            <th>
الوحدة
                            </th>
                            <th>
حد الطلب
                            </th>
                        </tr>

                      </thead>
                        <tbody>
                        <tr>
                            <td>{{ @$item->cat->name }}</td>
                            @if($co_info->co_use_markes_models)
                            <td>{{ @$item->marks->name }}</td>
                            <td>{{ @$item->models->name }}</td>
                            @endif
                            @if($co_info->co_use_season)
                            <td>{{ @$item->seasons->name }}</td>
                            @endif
                            <td>{{ @$item->unit }}</td>
                            <td>{{ @$item->limit }}</td>
                        </tr>
                        </tbody>
                        </table>
                </div>

                 </div>
            </p>
        </div>
        <div class="divider"></div>
        <div class="section">
            <h4>الأسعار</h4>
            <p>
            <div class="row">
            <div class="col l12 s12">
                <table class="display table  table-striped table-hover">
                    <thead id="all-items">
                    <tr>
                        <th>
                                                 سعر الشراء

                        </th>
                        <th>
                                                  سعر البيع

                        </th>
                        <th>
                                                  سعر  نصف الجملة

                        </th>
                        <th>
                                                  سعر   الجملة

                        </th>
                        <th>
                                                  سعر  جملة الجملة

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td> {{ @$item->buy }}</td>
                        <td>{{ @$item->sell_users }}</td>
                        <td>{{ @$item->sell_nos_gomla }}</td>
                        <td>{{ @$item->sell_gomla }}</td>
                        <td>{{ @$item->sell_gomla_gomla }}</td>

                    </tr>
                    </tbody>
                    </table>



            </div>
                </div>
            </p>
        </div>
        <div class="divider"></div>
        <div class="section">
            <h4>ملاحظات</h4>
            <p>Stuff</p>
        </div>

            </div>
    </section>
@stop