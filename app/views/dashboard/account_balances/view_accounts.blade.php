<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/20/2015
 * Time: 4:03 PM
 */

?>

@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-invoice">
    <div class="card">
        <table id="table_bank" class="display table table-bordered table-striped table-hover">
            <thead>
            <tr>

                <th>@lang('main.number') </th>
                <th>@lang('main.account')</th>
                <th>@lang('main.name')</th>
                <th>@lang('main.debit_')</th>
                <th>@lang('main.credit_')</th>
                <th>@lang('main.date')</th>
                @if(PerC::isShow('balances','accountsBalances','delete'))
                    <th>@lang('main.cancel')</th>
                @endif
                <th>@lang('main.note')</th>
                <th> بواسطة</th>

            </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
            @foreach($balances as  $balance)
                <tr>

                    <?php
                    $i++;
                    $account_name = $balance->ofAccount->acc_name;
                    $account_type = $balance->ofAccount->acc_type;

                    ?>
                    <th>{{ $i }}</th>
                    <td>@lang('main.'.$account_type.'_')</td>
                    <td>{{ $account_name }}</td>
                    <td>{{ $balance->debit }}</td>
                    <td>{{ $balance->credit }}</td>
                    <td>{{ BaseController::ViewDate($balance->created_at) }}</td>
                    @if(PerC::isShow('balances','accountsBalances','delete'))
                        <td>
                            <a onclick='return confirm("هل تريد بالفعل حذف  الرصيد الإفتتاحى لحساب ( {{ $account_name }} )")'
                               href="{{ URL::route('deleteAccountsBalances',array($balance->id)) }}"
                               class="btn btn-danger red">[X]</a>
                        </td>
                    @endif
                    <td>{{ $balance->notes }}</td>
                    <td>{{ $balance->user->name }}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
<!-- /Main Content -->

@stop
