@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">

    <div id="product_cat" class="col s12">
        <div class="card {{ @$modelMini }}">
            <div class="title">
                <h5>
                    <i class="mdi mdi-notification-event-available"></i> مرتجع من فاتورة محددة    </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content">

                    {{ Form::open(array('route'=>'storeDep')) }}
                <div class="row no-margin-top">

                    {{--branch start --}}
                    @if($branch == 1)
                    <div class="col s12 l1">
                            <i class="mdi mdi-notification-event-available"></i>
                            {{ Form::label('branch_id',Lang::get('main.branch')) }}
                    </div>
                    <div class="col s2 l3">
                            <?php $select_branch = Lang::get('main.select_branch'); ?>
                            {{ Form::select('branch_id',array(null=>$select_branch)+ $co_info->branches->lists('br_name','id'),null,array('id'=>'branch_id')) }}
                            <p class="parsley-required">{{ $errors ->first('branch_id') }} </p>
                    </div>
                    @endif
                    {{--branch end--}}
                    {{--invoice number start--}}
                    <div class="col s12 m6 l3">
                        <div class="input-field">
                            <a class="waves-effect waves-light btn modal-trigger" href="#returnsInvoice">
                                المرتجعات
                            </a>
                        </div>
                        @include('dashboard.invoices._pop_up')
                    </div>
                    {{--invoice number start--}}
                    <div class="col s12 l2">
                        {{--<button class="waves-effect btn">@lang('main.search') </button>--}}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        {{--@include('dashboard.invoices.all_invoices_table_view')--}}
    </div>
    <!-- /??? ?????? -->




</section>
@stop