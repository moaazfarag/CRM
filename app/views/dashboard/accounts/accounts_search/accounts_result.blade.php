<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/3/2015
 * Time: 3:08 PM
 */

?>
@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section  class="content-wrap ecommerce-dashboard" ng-app>



    <div class=" card">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i>  {{ $title }} </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">

        {{ Form::open(array('route'=>'resultAccounts','name'=>'form_search')) }}

            <div class="row">
                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_from',null,array('required','id'=>'date_from','ng-model'=>'date_from','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('date_from') }} </p>

                        <label for="date_from">
                            بداية من
                        </label>
                    </div>
                </div>


                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_to',null,array('required','id'=>'date_to','ng-model'=>'date_to','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('date_to') }} </p>

                        <label for="date_to">
                            حتى
                        </label>
                    </div>
                </div>


                @if($type != 'expenses')
                {{--account name--}}
                <div class="col s12 l2">

                    {{ Form::select('account_id', array('' => $select_account) + $accounts->lists('acc_name','id'),null,array('id'=>'cat_id','required','ng-model'=>'account_id')) }}

                    <p class="parsley-required">{{ $errors ->first('account_id') }} </p>
                </div>
                {{--account name--}}
                    @endif
            </div>

            <div class="row">
                <div class="col s10 l10" style="margin: 1%">
                    <button  class="waves-effect btn" ng-disabled="form_search.$invalid" > @lang('main.review') </button>
                </div>

                {{ Form::hidden('type',$type) }}
                {{ Form::close() }}
                 </div>

            <hr/>
            <a class="waves-effect waves-light btn modal-trigger" href="#modal1">@lang('main.add_direct_movement')</a>


        </div>
    </div>


    </div>

    @unless(empty($account_trans))
    {{--table start--}}
    <table   class="display table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <caption class="caption-style">
                {{ Lang::get('main.'.$type.'_title') }}
                @if(isset($name))
                    {{ ' ( '.$name .' )' }}
                @endif
                الفترة من
                {{ BaseController::ViewDate($date_from) }}
                حتى
                {{ BaseController::ViewDate($date_to) }}
            </caption>

        </tr>

        <tr>
            <th>@lang('main.date')</th>
            <th>@lang('main.trans_type')</th>
            <th>@lang('main.debit')</th>
            <th>@lang('main.credit_')</th>
            <th>@lang('main.account')</th>
            <th>@lang('main.notes')</th>

        </tr>
        </thead>
        <tbody>
            <?php $all_credit = array(); $all_debit= array(); $i = 0;?>
            @foreach($account_trans as $k => $trans)

               @if($trans->pay_type == "cash" && $trans->trans_type != 'direct_movement')
                   @if($trans->debit == 0)
                       <?php $prise = $trans->credit;  ?>
                   @else
                       <?php $prise = $trans->debit; ?>
                   @endif

                  <tr>
                <td>{{  $trans->date }}</td>
                <td>{{  Lang::get('main.'.$trans->trans_type.'_type') }}</td>
                <td>{{ $prise }}</td>
                <td>----</td>
                <td>{{  Lang::get('main.'.$trans->pay_type) }}</td>
                <td>{{  $trans->notes }}</td>

                  </tr>

               <tr>
                   <td>{{  $trans->date }}</td>
                   <td>{{  Lang::get('main.'.$trans->trans_type.'_type') }}</td>
                   <td> ---- </td>
                   <td>{{ $prise }}</td>
                   <td>{{  Lang::get('main.'.$trans->pay_type) }}</td>
                   <td>{{  $trans->notes }}</td>

               </tr>

               @else

                   <tr>
                       <td>{{  $trans->date }}</td>
                       <td>{{  Lang::get('main.'.$trans->trans_type.'_type') }}</td>
                       <td>@if($trans->debit == 0) ---- @else {{  $trans->debit }} @endif</td>
                       <td>@if($trans->credit == 0) ---- @else{{  $trans->credit }}  @endif</td>
                       <td>{{  Lang::get('main.'.$trans->pay_type) }}</td>
                       <td>@if($trans->trans_id != '')@lang('main.invoice_no') : {{  $trans->invoiceNo->invoice_no }} @endif  @if($trans->notes != '') |  {{$trans->notes }} @endif</td>
                   </tr>

               @endif

               @if($trans->pay_type == "cash" && $trans->trans_type != 'direct_movement')

                    <?php
                    if($trans->debit == 0){ $price = $trans->credit;} else { $price = $trans->debit;}

                    $all_credit[$k]= $price; $all_debit[$k]= $price;

                    ?>

                @else
                    <?php
                    {
                        $all_credit[$k]= $trans->credit; $all_debit[$k]= $trans->debit;
                    }

                    ?>
                @endif

        @endforeach
        </tbody>
    </table>
    {{--table end --}}


    <div class="row" style="width: 80%; margin: 1% auto;">
        <table  class="display table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <caption class="caption-style">
الإجمالى
            </caption>

                </tr>

                <tr>

                    <th>@lang('main.debit')</th>
                    <th>@lang('main.credit_')</th>
                    <th>@lang('main.stock')</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ array_sum($all_debit) }}</td>
                    <td>{{ array_sum($all_credit) }}</td>
                    <td><?php echo BaseController::negativeValue(array_sum($all_debit) - array_sum($all_credit)); ?></td>

                </tr>
                </tbody>
            </table>

    </div>


    @else
        <div class="alert  orange lighten-4 orange-text text-darken-2">
            <strong>عفواً!</strong>
            لا يوجد نتائج
        </div>
    @endif
            <!--/////////// model start }}}}}}}}}}}}}}-->
                    <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <div class="card-panel indigo lighten-5">
                        <div style="text-align: center; font-size: 1.3em;">
                            {{ Lang::get('main.'.$type.'_title') }}
                            @if(isset($name))
                                {{ ' ( '.$name .' )' }}
                            @endif

                        </div>
                    </div>
                    <p>
                        {{ Form::open(array('route'=>'addNewDirectMovement','data-parsley-validate','name'=>'form')) }}
                        {{--date--}}

                    <div class="row" style="margin-top: 25px;">
                    <div class="col m4 s12">
                        <div class="input-field">
                            <i class="fa fa-user prefix"></i>
                            {{ Form::text('date',null,array('required','id'=>'date','ng-model'=>'date','class'=>'pikaday')) }}
                            <label for="date">@lang('main.date')</label>
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

                    </div>


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

                            <input name="price_type"  {{ isset($credit) ?'checked':'' }} value="credit" type="radio" required="required" ng-model="price_type" id="radios1-1"  />
                            <label for="radios1-1">قبض</label>
                            <input name="price_type" value="debit" {{ isset($debit) ?'checked':'' }} type="radio" id="radios1-2" />
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
                    {{ Form::hidden('account',$account) }}
                    {{ Form::hidden('account_id',$account_id) }}
                    <button class="modal-action modal-close waves-effect waves-red btn"
                            ng-disabled="form.$invalid">
                        @lang('main.save')</button>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">تراجع</a>


                    {{ Form::close() }}
                </div>
            </div>
            </div>


                    <!--/////////// model end }}}}}}}}}}}}}}-->

</section>
<!-- /Main Content -->


@stop