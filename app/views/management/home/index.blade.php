@extends('management.include.main')
@section('content')
    <div class="card">
        <div class="content">
            <div class="card-panel blue lighten-5">
                {{ @$title }}
            </div>
            @include('include.messages')
            <div class="table-responsive" >
                <table id="table_management" class="display table  table-striped table-hover">
                    <thead id="all-items">
                    <tr>
                        <th>@lang('main.number')</th>
                        <th>@lang('main.name') </th>
                        <th>@lang('main.phone_number_1') </th>
                        <th>@lang('main.phone_number_2') </th>
                        <th>@lang('main.email') </th>
                        <th>@lang('main.address') </th>
                        <th>@lang('main.start_date') </th>
                        <th>@lang('main.expiration_date') </th>
                        <th>@lang('main.count_users') </th>
                        <th>@lang('main.count_branches') </th>
                        <th>@lang('main.status') </th>
                        <th>@lang('main.edit') </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($all_company))
                        @foreach($all_company as $company)
                        <tr>
                                <td>{{ $company->id }}</td>
                                <td >{{ $company->co_name }}</td>
                                <td>{{ $company->co_mobile_1 }}</td>
                                <td>{{ $company->co_mobile_2 }}</td>
                                <td>{{ $company->ownerEmail() }}</td>
                                <td>{{ $company->co_address }}</td>
                                <td>{{ BaseController::ViewDate($company->created_at) }}</td>
                                <td>{{ BaseController::ViewDate($company->co_expiration_date) }}</td>
                                <td>{{ $company->countUsers() }}</td>
                                <td>{{ $company->countBranches() }}</td>
                                <td>
                                    <?php $statues = BaseController::statues($company->created_at,$company->co_expiration_date,$company->co_statues); ?>

                                        @if($statues == 'trial')
                                            <span style="color: blue"> @lang('main.trial')</span>
                                        @elseif($statues == 'member')
                                            <span style="color: green"> @lang('main.member')</span>
                                         @elseif($statues == 'stopped')
                                            <span style="color: red"> @lang('main.stopped')</span>
                                        @endif

                                </td>

                                <td>
                                    <a class="waves-effect waves-light btn modal-trigger" href="#modal{{ $company->id }}" data-dismissible="true">
                                        <i class="mdi mdi-editor-mode-edit"></i>
                                    </a>


                                </td>

                        </tr>


                        @endforeach
                    </tbody>
                </table>
                        @foreach($all_company as $company)
                                <!-- start model -->
                        <div id="modal{{ $company->id }}" class="modal bottom-sheet">
                            <div class="modal-content">

                                <div class="alert indigo darken-3 white-text text-darken-2 alert-border-bottom">
                                    <h4>{{ $company->co_name }}</h4>
                                </div>
                                <p>
                                <table class="display table  table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('main.extension_of_reservations')</th>
                                        @if($company->co_statues == 2)
                                            <th>@lang('main.activation') </th>
                                        @else
                                            <th>@lang('main.stop') </th>
                                        @endif
                                        <th>@lang('main.delete') </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="row" style="padding: 2%;">
                                                {{ Form::open(array('route'=>'updateCompanyReservations')) }}
                                                <style>
                                                    .input_number{
                                                        height: auto !important;
                                                    }
                                                </style>

                                                 <div class="col l1 s11">@lang('main.date')</div>
                                                 <div class="col l3 s11">
                                                     <div class="input-field">
                                                         <i class="fa fa-calendar prefix"></i>
                                {{ Form::text('date',null,array('required','id'=>'date','class'=>'pikaday')) }}
                                <p class="parsley-required">{{ $errors ->first('date') }} </p>


                            </div>
                                                 </div>
                                                 <div class="col l1 s11" style="margin-top: 2px">
                                                    <button class="waves-effect btn">@lang('main.edit') </button>
                                                </div>
                                                {{ Form::hidden('co_id',$company->id) }}
                                                {{ Form::close() }}

                                            </div>

                                        </td>
                                        <td >
                                            @if($company->co_statues == 2)
                                                {{ Form::open(array('route'=>'activationCompany')) }}
                                                <button   onclick="return confirm('هل تريد بالفعل تفعيل الشركة')" class="waves-effect btn "><i class="fa fa-check"></i> </button>
                                                {{ Form::hidden('co_id',$company->id) }}
                                                {{ Form::close() }}
                                            @else
                                                {{ Form::open(array('route'=>'stopCompany')) }}
                                                    <button   onclick="return confirm('هل تريد بالفعل إيقاف الشركة')" class="waves-effect btn "><i class="fa fa-stop"></i> </button>
                                                {{ Form::hidden('co_id',$company->id) }}
                                                {{ Form::close() }}
                                            @endif
                                        </td>

                                        <td>
                                                {{ Form::open(array('route'=>'deleteCompany')) }}
                                                  <button   onclick="return confirm('هل تريد بالفعل حذف الشركة')" class="waves-effect btn btn btn-danger red">[X] </button>
                                                {{ Form::hidden('co_id',$company->id) }}
                                                {{ Form::close() }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>


                                </p>
                            </div>
                        </div>
                        <!-- end model -->
                        @endforeach
                            @endif

            </div>
        </div>
    </div>
    </section>
@endsection
@stop