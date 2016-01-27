@extends('dashboard.main')
@section('content')
<section id="print-content" class="content-wrap ecommerce-invoice " ng-app>
    <div class="right-align invoice-print">
        <span class="btn indigo" onclick="javascript:window.print();"><i class="ion-printer"></i></span>
    </div>
    <div class="card" style="padding:1%;">

        <div class="card-panel blue lighten-5 center_title">
            {{ $title }}
        </div>


                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>

                            <tr>
                                <th> الرقم</th>
                                <th> اسم الصنف</th>
                                <th> التكلفة </th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(count($items)>0)
                                @foreach($items as $item)
                               @if($item->cost() !=0)
                                <tr>
                                    <td>{{ $item->true_id }}</td>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->cost() }}</td>
                                </tr>
                                @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

    </div>
</section>
<!-- /Main Content -->

@stop
