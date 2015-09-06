<?php
/**
 * Created by PhpStorm.
 * User: Moaaz Farag
 * Date: 9/3/2015
 * Time: 1:00 PM
 */
class MsDetails extends Eloquent
{

    protected $table = 'hr_ms_details';


    /**
     *
     * @return mixed
     * return   got salary for
     * base on entered year and month
     */

    public static function desDud($id){
        return Deduction::company()->where('id',$id)->get();
    }

}