@extends('dashboard.main')
@section('content')

    <section class="content-wrap ecommerce-dashboard">
        <div style="margin: auto;page-break-after: always;">
            @foreach($items as $item)
                <?php $i = 0 ?>
            @if($idAndQty)
                <?php
                        foreach($idAndQty as $enterItem){
                            if ($enterItem['id'] == $item->id) {
                                $item->qty = $enterItem['qty'];
                                $item->unit_price = $item->sell_users;
                            }
                        } ?>
                @endif
                @for($i;$i<$item->qty;$i++)

                    <div style="page-break-after: always; margin: 1.5cm auto">
                        <div>
                            <div style="margin-left:10px;text-align: center; zoom:90%"
                                 class="BarcodeText">{{   '*'.$item->bar_code."*" }} </div>
                        </div>
                        <br>
                        <div style="margin: 15px">
                            <span style="text-align: center;margin-left: 10px;margin-right: 1.5cm;float:right;font-size: 8pt">{{$item->item_name }}</span>
                            <span style="text-align: center;margin-left: 1.5cm;float:left;font-size:8pt">{{ $item->unit_price }}</span>
                        </div>
                    </div>
                @endfor
            @endforeach
        </div>
    </section>
    <script>
        javascript:window.print();
    </script>

    <!-- Main Content -->

@stop