<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/16/2015
 * Time: 4:36 PM
 */
class Empdesded extends Eloquent {

    protected $table = 'hr_empdesded';
    public static $store_rules = array(
        'val'                  => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
    );
    public static $update_rules = array(
        'val'                  => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
    );
    public function desded()
    {
        return $this->hasMany('Desded','des_ded');
    }
}