<div class="col s12 m9 l10">
    <div class="title">
        <!--h1>@@title</h1-->
        <div class="btn-group">

            <a class="btn btn-extra "
               href="{{ URL::route('addAccount','bank') }}">  @lang('main.banks')   </a>
            <a class="btn btn-extra"
               href="{{ URL::route('addAccount','multiple_revenue') }}"> @lang('main.other_income')</a>
            <a class="btn btn-extra"
               href="{{ URL::route('addAccount','partners') }}">  @lang('main.count_partners') </a>
            <a class="btn btn-extra" href="{{ URL::route('addAccount','expenses') }}"> @lang('main.expenses') </a>
            <a class="btn btn-extra" href="{{ URL::route('addAccount','suppliers') }}"> @lang('main.suppliers')</a>
            <a class="btn btn-extra"
               href="{{ URL::route('addAccount','customers') }}"> @lang('main.customers') </a>
        </div>
    </div>
</div>