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
        'main_info'            =>['company','branch','cat','item','mark_model','season','add_account','users','barcode'],
        'balances'             =>['accountsBalances','itemBalance'],
        'settles'              =>['settleAdd','settleDown'],
        'hr'                   =>[ 'Employee','Departments','jobs','loans','Desdeds','Empdesded','MonthChange','salariesProcessing'],
        'invoices'             =>['buy','sales','salesReturn','buyReturn'],
        'p_general_accounts'   =>['p_directMovement','p_dailyTreasury','p_customers','p_suppliers','p_bank','p_partners','p_expenses','p_multiple_revenue'],
        'p_reports_hr'         =>['p_outgoingSalaries'],
        'p_reports_stores'     =>['p_settleAdd','p_settleDown','p_itemsCard','p_inventoryStore','p_balanceStores','p_evaluationStores'],
        'p_reports_invoices'   =>['p_sales','p_sumSales','p_salesReturn','p_sumSalesReturn','p_buy','p_sumBuy','p_buyReturn','p_sumBuyReturn','p_salesEarnings','p_company_earnings'],
    ];
    /*
     * set  permission array
     */
    public static function setPermission($all = null)
    {
        $emptyPerm = self::$basePermission;
        foreach($emptyPerm   as $group => $pre){
            foreach($pre as  $v){
                $permission[$group][$v]=
                    [
                        'add' =>   ($all)?1:Input::get('add_'.$v),
                        'edit'=>   ($all)?1:Input::get('edit_'.$v),
                        'delete'=> ($all)?1:Input::get('delete_'.$v),
                        'show'=>   ($all)?1:Input::get('show_'.$v)
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
    public static function isMainPerm($group,$types)
    {
        $perm_types =  explode('_', $types);
        foreach($perm_types as $type){
            $result = self::array_column(Session::get('permission')[$group],$type);
            if (array_sum($result)) {
                return true;
            }
        }

    }
    public static function isSession($group,$section,$type)
    {
        return isset(Session::get('permission')[$group][$section][$type])
                    ?Session::get('permission')[$group][$section][$type]
                    :null;
    }
    public static function isShow($group,$section,$types,$routeName = null)
    {

        if($routeName){
            if($routeName !=  Route::currentRouteName()){
                return false;
            }
        }
        $types_ = explode('_', $types);
        foreach($types_ as $type){
            if(self::isSession($group,$section,$type)){
                return true;
            }
        }
    }

    public static function isTrans($value,$type)
    {
        $perm_types =  explode('_', $value);
        $bCtrl = new BaseController;
        $balances = ['itemBalance'];
        $settles = ['settleAdd', 'settleDown'];
        if (in_array($type, $balances)) {
            $group = "balances";
        } elseif (in_array($type, $settles)) {
            $group = "settles";
        } else {
            $group = "invoices";
        }
        if($perm_types>1) {
            if (PermissionController::isShow($group, $type, $value)) {
                return true;
            }
        }elseif(PermissionController::isSession($group, $type, $value)) {
            return true;
        } else {
            if (Route::currentRouteName() == 'addTrans') {
                if (!$bCtrl->isHaveBranch()) {
                    $branches = Branches::company()->get()->lists('id');
                    if (end($uri) != Auth::user()->br_id && in_array(end($uri), $branches)) {
                        return false;
                    }
                }
            }
        }
    }
    public static function  array_column(array $input,$columnKey, $indexKey = null){
        if (! function_exists('array_column')) {


                $result = array();
                foreach ($input as $k => $v)
                    $result[$indexKey ? $v[$index_key] : $k] = $v[$columnKey];

                return $result;

        }else{
            return array_column($input,$columnKey);
        }
    }

    public static function isLoginAble()
    {
        if (Auth::check()) {
            if (Auth::user()->co_id != 0) {
                $co_id = Auth::user()->co_id;
                $company = CoData::find($co_id);
                $status = BaseController::statues($company->created_at, $company->co_expiration_date, $company->co_statues);
                if ($status == 'stopped') {
                    $userC = new  UserController;
                    $userC->logout();
                }
            }

        }
    }

}