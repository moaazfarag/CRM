<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 11/21/2015
 * Time: 12:56 PM
 */
class Offer extends Eloquent
{
    protected $table = 'offer';
    public static $store_rules = [
        'name'=>'required|string',
        'offer'=>'required|integer|max:100|min:1',
        'from'=>'required|date',
        'to'=>'required|date',
    ];
    public static $update_rules = [
        'name'=>'required|string',
        'offer'=>'required|integer|max:100|min:1',
        'from'=>'required|date',
        'to'=>'required|date',
    ];

}