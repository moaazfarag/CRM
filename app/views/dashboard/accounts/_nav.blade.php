<div class="title">


        <div class="col s12 m9 l10">
            <!--h1>@@title</h1-->
            <nav style="width: 750px">
                <ul class="left">

                    <li class="{{ ($accountType=="bank")?$navActive:null }}" >

                        <a href="{{ URL::route('addAccount','bank') }}">  @lang('main.banks')   </a>
                    </li>
                     <li class="{{ ($accountType=="multiple_revenue")?$navActive:null }}" >
                         <a href="{{ URL::route('addAccount','multiple_revenue') }}"> @lang('main.other_income')</a>
                     </li>

                    <li class="{{ ($accountType=="partners")?$navActive:null }}" >

                        <a href="{{ URL::route('addAccount','partners') }}">  @lang('main.count_partners') </a>
                    </li>

                    <li class="{{ ($accountType=="expenses")?$navActive:null }}" >

                        <a href="{{ URL::route('addAccount','expenses') }}"> @lang('main.expenses') </a>
                    </li>

                    <li class="{{ ($accountType=="suppliers")?$navActive:null }}" >

                        <a href="{{ URL::route('addAccount','suppliers') }}"> @lang('main.suppliers')</a>
                    </li>

                    <li class="{{ ($accountType=="customers")?$navActive:null }}" >
                        <a href="{{ URL::route('addAccount','customers') }}"> @lang('main.customers') </a>
                    </li>

                </ul>
            </nav>

        </div>

    </div>

<br>