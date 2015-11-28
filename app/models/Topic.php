<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Topic extends Eloquent {

    protected $table = 'topics';


    public static $topic_ruels = array(

        'title'     =>'required',
        'content'   =>'required',
        'type'      =>'required',


    );

}
