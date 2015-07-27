<div class="title">


        <div class="col s12 m9 l10">
            <!--h1>@@title</h1-->
            <nav style="width: 750px">
                <ul class="left">

                    <li class="{{ ($accountType=="bank")?$navActive:null }}" >

                        <a href="{{ URL::route('addAccount','bank') }}">  البنوك   </a>
                    </li>
                     <li class="{{ ($accountType=="multiple_revenue")?$navActive:null }}" >
                         <a href="{{ URL::route('addAccount','multiple_revenue') }}">  ايرادات اخرى  </a>
                     </li>

                    <li class="{{ ($accountType=="expenses")?$navActive:null }}" >

                        <a href="{{ URL::route('addAccount','expenses') }}"> جارى الشركاء </a>
                    </li>

                    <li class="{{ ($accountType=="bank")?$navActive:null }}" >

                        <a href="{{ URL::route('addAccount','bank') }}"> االمصروفات </a>
                    </li>

                    <li class="{{ ($accountType=="suppliers")?$navActive:null }}" >

                        <a href="{{ URL::route('addAccount','suppliers') }}"> الموردين</a>
                    </li>

                    <li class="{{ ($accountType=="customers")?$navActive:null }}" >
                        <a href="{{ URL::route('addAccount','customers') }}"> العملاء </a>
                    </li>

                </ul>
            </nav>

        </div>

    </div>

<br>