<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Home extends Eloquent {

    protected $table = 'home_page';

    public static $header_ruels = array(

        'title'=>'required',
        'details'=>'required',
    );

    public static $about_us_ruels = array(

        'about'=>'required',
        'about_content'=>'required',
    );

    public static $sochial_ruels = array(

        'facebook'=>'required',
        'twitter'=>'required',
        'google'=>'required',
        'youtube'=>'required',
        'linkedin'=>'required',
        'instgram'=>'required',

    );

    public static $email_ruels = array(
        'email'=>'required|email',


    );

}
