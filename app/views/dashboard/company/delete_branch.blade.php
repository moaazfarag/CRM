@extends('dashboard.main')
@section('content')


        <!-- Breadcrumb -->

<section class="content-wrap ecommerce-dashboard">

    <div class=" card" style="padding: 1%;">

        <div  class="card-panel red  lighten-4 center_title">
حذف فرع
            ({{ $branch_name }})
                    </div>
        @include('include.messages')
        <div class="row">
            <div class="col s12 m12">

            <div class="alert  orange lighten-4 orange-text text-darken-2 alert-border-right">
                @if(count($all_branches))

                <strong>تنبية </strong>
                لتقوم بعملية حذف فرع
                ({{ $branch_name }})
                لا بد من نقل أرصدة الأصناف من الفرع إلى فرع أخر
            @else
                    <strong>عفواً </strong>
لا يمكنكم حذف الفرع .. لإتمام عملية الحذف يرجى إنشاء فرع جديد والمحاولة مرة أخرى
                @endif

            </div>
        </div>
            @if(count($all_branches))
            <div class="col s12 m3">

                أختر الفرع المراد نقل أرصدة الأصناف إلية
            </div>
            <div class="col s12 m3">
                <div class="input-field">
                    {{ Form::open(array('route'=>'cutBalance')) }}

                    {{ Form::hidden('branch_from',$branch_delete_id) }}
                    {{ Form::select('branch_to',array(""=>'-- أختر الفرع  --')+$all_branches,null) }}
                    <ul class="parsley-errors-list filled" id="parsley-id-5202">
                        <li class="parsley-required">{{ $errors ->First('old_password') }} </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row" style="margin: 1%;">
            <div class="col m12 s12">
                <div class="input-field">
                    <button class="waves-effect btn "><a class="white-text" href="{{ URL::to('/admin/addBranch') }}">رجوع</a> </button>
                    <button type="submit" class="waves-effect btn">نقل </button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @endif

    </div>



</section>

@endsection