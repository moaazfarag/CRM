<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/19/2015
 * Time: 12:35 PM
 */

?>

@if(Session::has('error'))
    <div id="hidden" class="alert" >

        {{ Session::get('error') }}
    </div>
@endif

@if(Session::has('success'))

    <div  id="hidden" class="alert green lighten-4 green-text text-darken-2">
        {{ Session::get('success') }}
    </div>
@endif
