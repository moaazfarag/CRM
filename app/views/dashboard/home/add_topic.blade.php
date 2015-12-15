@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    <div class="card-panel">

        <div class="content">

            <div class="card-panel blue lighten-5 center_title">
                @if(Route::currentRouteName() == 'addTopic')
إضافة موضوع جديد
                @elseif(Route::currentRouteName() == 'editTopic')
                تعديل موضوع
                @endif
            </div>
            <p></p>
            @include('include.messages')

            @if(Route::currentRouteName() == 'addTopic')
            {{ Form::open(array('route'=>'storeTopic','files'=>'true')) }}
            @elseif(Route::currentRouteName() == 'editTopic')
                {{ Form::model($topic,array('route'=>array('updateTopic',$topic->id),'files'=>'true')) }}
            @endif
            <div class="row no-margin-top">
                <div class="col s12 l1">
                    <label for="title">
                       عنوان الموضوع
                    </label>

                </div>
                <div class="col s12 m5 l5">
                    <div class="input-field">

                        {{Form::text('title',null,array('required','placeholder'=>" ".  @$holder,'id'=>'title','data-parsley-id'=>'4370','class'=>($errors->first('title'))?'parsley-error':null)) }}
                        {{--<input value="{{ null }}" name="cat_name" id="cat-name" type="text" placeholder="???  {{@$arabicName}}">--}}
                        <p class="parsley-required error-validation">{{ $errors ->first('title') }} </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l1">

                    {{ Form::label('type','أختر نوع الموضوع ') }}
                </div>
                <div class="col s12 l4">
                    <div class="input-field">

                        {{ Form::select('type', $types,null,array('id'=>'type','data-parsley-id'=>'4370','class'=>($errors->first('type'))?'parsley-error':null)) }}

                        <p class="parsley-required error-validation">{{ $errors->first('type') }} </p>

                    </div>
                </div>
            </div>
            <div class="row no-margin-top">
                <div class="col s12 l1">
                    <label for="ckeditor2">
الموضوع
                    </label>

                </div>
                <div class="col s12 l9">

                    <div class="input-field" >
                        {{ Form::textarea('content',null,array('id'=>'ckeditor1','dir'=>'rtl','data-parsley-id'=>'4370','class'=>($errors->first('content'))?'parsley-error materialize-textarea':'materialize-textarea')) }}
                        <div id="ckeditora"></div>
                        <p class="parsley-required">{{ $errors ->first('details') }} </p>
                    </div>
                </div>
            </div>


            <div class="row">

                    <div style="margin:1% 8% 2% 0;" class="col s10 l10">
                   @if(Route::currentRouteName() == 'addTopic')
                    <button class="waves-effect btn">@lang('main.save') </button>
                   @elseif(Route::currentRouteName() == 'editTopic')
                    <button class="waves-effect btn">@lang('main.edit') </button>
                   @endif
                    {{ Form::close() }}
                </div>

            </div>
            @include('dashboard.home._table_view')
        </div>
     </div>
</section>
@stop