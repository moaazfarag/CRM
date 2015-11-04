<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/5/2015
 * Time: 6:06 PM
 */

?>


@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard" ng-app="itemApp"  ng-controller="mainController">
    <div class="row" style="margin: 1% 0;">
        <div class="col l12 s12" >



        </div>
    </div>
    {{ Form::open(array('route'=>array('dailyTreasuryResult'))) }}

    <div class=" card ">
        <div class="no-print">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i>
                {{ $title }}
            </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">
            <div class="row">
                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_from',null,array('required','id'=>'employee_date','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('employee_date') }} </p>

                        <label for="employee_date">
                            بداية من
                        </label>
                    </div>
                </div>


                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_to',null,array('required','id'=>'employee_date','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('employee_date') }} </p>

                        <label for="employee_date">
                            حتى
                        </label>
                    </div>
                </div>
                {{--branch --}}
                @if($branch == 1)

                    <div class="col s12 l3">
                        <?php
                        $choseBranch =Lang::get('main.choseBranch') ?>
                        {{--{{ Form::label('br_id',$branch) }}--}}

                        {{--{{ Form::label('br_code',$branch) }}--}}

                        {{ Form::select('br_id', array('' => $choseBranch )+$company->branches->lists('br_name','id'),null,array('id'=>'br_id','ng-model'=>'br_id')) }}
                        <p class="parsley-required">
                            {{ $errors ->first('br_id') }}
                        </p>
                    </div>
                @endif

            </div>

            <div class="row">
                <div class="col s12 l12" style="padding: 2%;">

                    <button type="submit" class="waves-effect btn">
                        عرض
                    </button>
                </div>



                {{ Form::close() }}


            </div>{{--submit  row end--}}
                                        @if(PerC::isShow('p_general_accounts','p_directMovement','add'))
            <div>
                <a class="waves-effect waves-light btn modal-trigger" href="#modal1">@lang('main.add_direct_movement')</a>
            </div>
                                        @endif
            <hr/>
        </div>

        </div>
            <div class="right-align invoice-print" style="margin-left: 15px;">
                <span class="btn indigo" onclick="javascript:window.print();"><i class="ion-printer"></i></span>
            </div>


        <div id="print-content">
            <div class="content">
            @if($view_branch == 'one')
            <!-- table start  -->

            <div class="row">


                <table id="table_bank" class="display table table-bordered table-striped table-hover" style="margin-right: 7px;">
                    <thead>
                    <tr>
                        <caption class="caption-style">
                            الفترة من
                            {{ BaseController::ViewDate($date_from) }}
                            حتى
                            {{ BaseController::ViewDate($date_to) }}

لفرع
                            {{ $branch_name }}
                        </caption>

                    </tr>
                    <tr>
                        <th>@lang('main.date')</th>
                        <th>@lang('main.trans_type')</th>
                        <th>@lang('main.debit')</th>
                        <th>@lang('main.credit_')</th>
                    </tr>

                    </thead>

                    <tbody>
                    <tr>
                    <td>  {{ BaseController::LastOneDay($date_from) }} </td>
                        <td>رصيد ما قبل</td>
                        <td>{{ $last_debit }}</td>
                        <td>{{ $last_credit }}</td>
                    </tr>
                    <?php

                    $debit = array();
                    $credit= array();

                    $debit['last_debit']   = $last_debit;
                    $credit['last_credit'] = $last_credit;
                    ?>
                    @foreach($treasury_between_date as $k => $treasury)

                            <tr>

                                <td>{{ $treasury->date }}</td>
                                <td> @lang('main.'.$treasury->type)</td>

                            <?php



                                if (in_array($treasury->type, $movements)) {


                                echo ' <td>'. $treasury->credit .'</td>';
                                echo ' <td>'. $treasury->debit .'</td>';

                                    $debit[$k]  = $treasury->credit;
                                    $credit[$k] = $treasury->debit;
                                } else {

                                if (in_array($treasury->type, $credit_types)) {

                                    echo ' <td>'. $treasury->credit .'</td>';
                                    echo ' <td> 0 </td>';

                                    $debit[$k] = $treasury->credit;
                                    $credit[$k] = 0;

                                } elseif (in_array($treasury->type, $debit_types)) {

                                    echo ' <td> 0 </td>';
                                    echo ' <td>'. $treasury->debit .'</td>';

                                    $debit[$k]  = 0;
                                    $credit[$k] = $treasury->debit;
                                }

                                }// end else

                                ?>




                            </tr>

                    @endforeach
                    </tbody>


                </table>

                <table  style="width:80%; margin:1% auto;" class="display table table-bordered table-striped table-hover">
                    <thead>

                    <tr>

                        <th>الفترة</th>
                        <th>@lang('main.debit')</th>
                        <th>@lang('main.credit_')</th>
                        <th>@lang('main.stock')</th>
                    </tr>
                    </thead>
                    <tbody>


                    <tr>

                        <td>
                        الفترة من
                        {{ BaseController::ViewDate($date_from) }} <br/>
                        حتى
                        {{ BaseController::ViewDate($date_to) }}

                        </td>

                        <td>{{ array_sum($debit) }}</td>
                        <td>{{ array_sum($credit) }}</td>
                        <td><?php echo BaseController::negativeValue(array_sum($debit) - array_sum($credit)); ?></td>
                    </tr>


                    </tbody>
                </table>


            </div>
            {{--start all branches--}}

            @elseif($view_branch == 'many')

            <div class="row">
                <div  class="card-panel blue lighten-5 center_title">
                    الفترة من
                    {{ BaseController::ViewDate($date_from) }}
                    حتى
                    {{ BaseController::ViewDate($date_to) }}

                </div>
                </div>
               @foreach($all_branches_id as $branch_id)
                    <!-- table start  -->

            <div class="row">


                <table id="table_bank" class="display table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <caption class="caption-style" style="">
                            فرع
                            {{ Branches::find($branch_id)->br_name }}
                        </caption>

                    </tr>
                    <tr>
                        <th>@lang('main.date')</th>
                        <th>@lang('main.trans_type')</th>
                        <th>@lang('main.debit')</th>
                        <th>@lang('main.credit_')</th>
                    </tr>

                    </thead>

                    <tbody>
                    <tr>
                        <td>
                            ما قبل
                            {{ BaseController::LastOneDay($date_from) }}  </td>
                        <td>رصيد ما قبل</td>
                        <td>{{ $last_debit[$branch_id] }}</td>
                        <td>{{ $last_credit[$branch_id]; }}</td>
                    </tr>
                    <?php

                    $debit = array();
                    $credit= array();

                    $debit['last_debit']   = $last_debit[$branch_id];
                    $credit['last_credit'] = $last_credit[$branch_id];
                    ?>
                    @foreach($treasury_between_date[$branch_id] as $k => $treasury)

                        <tr>

                            <td>{{ $treasury->date }}</td>
                            <td> @lang('main.'.$treasury->type)</td>

                            <?php



                            if (in_array($treasury->type, $movements)) {


                                echo ' <td>'. $treasury->credit .'</td>';
                                echo ' <td>'. $treasury->debit .'</td>';

                                $debit[$k]  = $treasury->credit;
                                $credit[$k] = $treasury->debit;
                            } else {

                                if (in_array($treasury->type, $credit_types)) {

                                    echo ' <td>'. $treasury->credit .'</td>';
                                    echo ' <td> 0 </td>';

                                    $debit[$k] = $treasury->credit;
                                    $credit[$k] = 0;

                                } elseif (in_array($treasury->type, $debit_types)) {

                                    echo ' <td> 0 </td>';
                                    echo ' <td>'. $treasury->debit .'</td>';

                                    $debit[$k]  = 0;
                                    $credit[$k] = $treasury->debit;
                                }

                            }// end else

                            ?>




                        </tr>

                    @endforeach
                    </tbody>


                </table>

                <table  style="width:80%; margin:1% auto;" class="display table table-bordered table-striped table-hover">
                    <thead>

                    <tr>

                        <th>الفترة</th>
                        <th>@lang('main.debit')</th>
                        <th>@lang('main.credit_')</th>
                        <th>@lang('main.stock')</th>
                    </tr>
                    </thead>
                    <tbody>


                    <tr>

                        <td>
                            الفترة من
                            {{ BaseController::ViewDate($date_from) }} <br/>
                            حتى
                            {{ BaseController::ViewDate($date_to) }}

                        </td>

                        <td>{{ array_sum($debit) }}</td>
                        <td>{{ array_sum($credit) }}</td>
                        <td><?php echo BaseController::negativeValue(array_sum($debit) - array_sum($credit)); ?></td>
                    </tr>


                    </tbody>
                </table>

            <hr/>
            </div>
            {{--end all branches --}}
                @endforeach

            @endif
            <!-- table end  -->
                </div>
            </div>

                                        @if(PerC::isShow('p_general_accounts','p_directMovement','add'))
            <!--/////////// model start }}}}}}}}}}}}}}-->
            <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <div class="card-panel indigo lighten-5">
                        <div style="text-align: center; font-size: 1.3em;">
                            @lang('main.add_direct_movement')
                        </div>
                    </div>
                    <p>
                    {{ Form::open(array('route'=>'dailyTreasuryAddDirectMovement','data-parsley-validate','name'=>'form')) }}
                    {{--date--}}

                    <div class="row" style="margin-top: 25px;">
                        <div class="col m4 s12">
                            <div class="input-field">
                                <label for="date">@lang('main.date')</label>
                                {{ Form::text('date',null,array('required','id'=>'date','ng-model'=>'date','class'=>'pikaday')) }}
                                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                    <li class="parsley-required">{{ $errors ->First('date') }} </li>
                                </ul>
                            </div>
                        </div>
                        {{--end date--}}



                        {{--branch --}}

                        @if($branch == 1)

                            <div class="col s12 l3">
                                <?php $branch =Lang::get('main.branch');
                                $choseBranch =Lang::get('main.choseBranch') ?>
                                {{--{{ Form::label('br_id',$branch) }}--}}

                                {{--{{ Form::label('br_code',$branch) }}--}}

                                {{ Form::select('br_id', array('' => $choseBranch )+$company->branches->lists('br_name','id'),null,array('id'=>'br_id','ng-model'=>'br_id','required')) }}
                                <p class="parsley-required">
                                    {{ $errors ->first('br_id') }}
                                </p>
                            </div>
                        @endif

                        {{--account  name--}}
                        <div class="col s12 l3">

                            {{ Form::select('account',array(null=>lang::get('main.select_account'))+ $account_type,null,array('id'=>'account','ng-required'=>'pay_type == "on_account"','ng-model'=>'account.type','ng-change'=>'getAccountsByType()')) }}
                            <p class="parsley-required">{{ $errors ->first('account') }} </p>
                        </div>{{--account--}}
                        <div ng_show="account.type" class="col s12 l2">

                            <select  name="account_id"  ng-change='getAccountInfo()' ng-model="account.id"  class='browser-default'>
                                <option value="@{{ account.id }}" ng-repeat="account in accounts">@{{ account.acc_name }}</option>
                            </select>
              <span style="color: red">
                  @{{ isLimit() }}
              </span>
                            @{{  seletedAccount.pricing }}
                            {{--{{ Form::select('account',array(null=>"اختر   نوع الحساب ")+ $account_type,null,array('id'=>'account','ng-model'=>'account.type','ng-change'=>'getAccountsByType()','class'=>'browser-default')) }}--}}
                            <p class="parsley-required">{{ $errors ->first('account') }} </p>
                        </div>{{--account--}}

                        {{--end account name --}}
                    </div>
                                        @endif

                    <div class="row">
                        {{--price--}}
                        <div class="col l3 s12">
                            <div class="input-field">
                                <i class="mdi mdi-editor-attach-money prefix active"></i>
                                {{ Form::number('price',null,array('id'=>'price','required','ng-model'=>'price','step'=>'0.01')) }}

                                <label for="price"> @lang('main.price')</label>
                                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                    <li class="parsley-required">{{ $errors ->First('price') }} </li>
                                </ul>
                            </div>
                        </div>
                        {{--end price --}}

                        {{--credit & debit--}}
                        <div class="col s12 l1">

                            <input name="price_type"   value="credit" type="radio" required="required" ng-model="price_type" id="radios1-1"  />
                            <label for="radios1-1">قبض</label>
                            <input name="price_type" value="debit"  type="radio" id="radios1-2" />
                            <label for="radios1-2">صرف</label>


                        </div>
                        {{-- end credit & debit--}}
                    </div>
                    <div class="row">

                        {{--notes--}}
                        <div class="col s12 l9">
                            <div class="input-field" >
                                <i class="fa fa-tag prefix"></i>
                                {{ Form::text('notes',null,array('id'=>'note','class'=>"materialize-textarea" ,'required','ng-model'=>'notes','length'=>"200")) }}
                                {{ Form::label('notes',lang::get('main.note'))     }}
                                <p class="parsley-required">{{ $errors ->first('note') }} </p>
                            </div>
                        </div>

                    </div>

                    </p>
                </div>
                <div class="modal-footer">
                    {{ Form::hidden('date_from',$date_from) }}
                    {{ Form::hidden('date_to',$date_to) }}

                    <button class="modal-action modal-close waves-effect waves-red btn"
                            ng-disabled="form.$invalid">
                        @lang('main.save')</button>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">تراجع</a>

                    {{ Form::hidden('branch_id',$br_id) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!--/////////// model end }}}}}}}}}}}}}}-->

</section>
@stop


