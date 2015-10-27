<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 10/25/2015
 * Time: 12:12 PM
 */
class PermissionController extends BaseController
{
    public static $basePermission = [
        'main_info'=>['company','branches','cats','seasons','marks_model','items','add_account','users'],
        'invoices'=>['buy','sales','salesReturn','buyReturn','settleAdd','settleDown','itemBalance'],
        'ahmed'=>['budsady','dsa','as','dsa'],
        'sda'=>['dsa','dsddasddaa','dsad'],
        'zXzxz'=>['sdadsa','dsadsad','sadsadsa'],
    ];
    /*
     * set  permission array
     */
    public static function setPermission()
    {
        $emptyPerm = self::$basePermission;
        foreach($emptyPerm   as $group => $pre){
            foreach($pre as  $v){
                $permission[$group][$v]=
                    [
                        'add'=>    Input::get('add_'.$v),
                        'edit'=>   Input::get('edit_'.$v),
                        'delete'=> Input::get('delete_'.$v),
                        'show'=>   Input::get('show_'.$v)
                    ];
            }
        }
        return $permission;
    }

}