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
        'main_info'          =>['company','branch','cat','item','mark_model','season','add_account','users'],
        'balances'           =>['accountsBalances','itemBalance'],
        'settles'            =>['settleAdd','settleDown'],
        'hr'                 =>[ 'Employee','Departments','jobs','loans','Desdeds','Empdesded','MonthChange','salariesProcessing'],
        'invoices'           =>['buy','sales','salesReturn','buyReturn'],
        'p_general_accounts'   =>['p_directMovement','p_dailyTreasury','p_customers','p_suppliers','p_bank','p_partners','p_expenses','p_multiple_revenue'],
        'p_reports_hr'         =>['p_outgoingSalaries'],
        'p_reports_stores'     =>['p_settleAdd','p_settleDown','p_itemsCard','p_inventoryStore','p_balanceStores','p_evaluation_stores'],
        'p_reports_invoices'   =>['p_sales','p_sumSales','p_salesReturn','p_sumSalesReturn','p_buy','p_sumBuy','p_buyReturn','p_sumBuyReturn','p_salesEarnings'],
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
                        'add' =>    Input::get('add_'.$v),
                        'edit'=>   Input::get('edit_'.$v),
                        'delete'=> Input::get('delete_'.$v),
                        'show'=>   Input::get('show_'.$v)
                    ];
            }
        }
        return $permission;
    }

    public static function setSession()
    {
        if(Auth::check()){
           $user = User::find(Auth::id());
            if (Session::get('last_login') != $user->updated_at->format('d M Y - H:i:s')) {
                Session::put('permission',json_decode($user->permission,true));
                Session::put('last_login',$user->updated_at->format('d M Y - H:i:s'));
            }
        }
    }
    public static function isSession($group,$section,$type)
    {
        return isset(Session::get('permission')[$group][$section][$type])
                    ?Session::get('permission')[$group][$section][$type]
                    :null;
    }

}