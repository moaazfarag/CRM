<div class="title">


        <div class="col s12 m9 l10">
            <!--h1>@@title</h1-->
            <nav style="width: 350px">
                <ul class="left">


                    <li class="{{ @$activeSeasonNav }}" >
                        <a href="{{ URL::route('addSeason') }}"> المواسم</a>
                    </li>
                    <li class="{{ @$activeModelNav }}" >

                    <a href="{{ URL::route('addModel') }}"> الموديلات</a>
                    </li>

                    <li class="{{ @$activeCatNav }}" >

                    <a href="{{ URL::route('addCategory') }}"> الاصناف</a>
                    </li>
                    <li class="{{ @$activeItemNav }}" >
                    {{--@URL::route('addItem')--}}
                        <a href="#"> الوحدات</a>
                    </li>
                </ul>
            </nav>

        </div>

    </div>

<br>