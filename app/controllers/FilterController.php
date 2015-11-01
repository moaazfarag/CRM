<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 10/25/2015
 * Time: 12:16 PM
 */
class FilterController extends BaseController
{
    /**
     * SET ALL ROUTE FILTER USEING 3 parameter
     * ex: 'before'=>'filter:param1:param2:param3',
     * ex: 'before'=>'filter:main_info:company:add',
     * @param $route
     * @param $request
     * @param $value
     * @return mixed
     */
    public function filter($route, $request, $value)
    {
        $parameter = explode(':', $value);
        $types =  explode('_', $parameter[2]);
        if(count($types)>1){
            if(!PermissionController::isShow($parameter[0], $parameter[1], $parameter[2])){
            return $this->makeError();
            };
        }elseif (!PermissionController::isSession($parameter[0], $parameter[1], $parameter[2])) {
            return $this->makeError();
        }
    }

    /**
     * deal with transaction routes add and edit and delete
     * @param $route
     * @param $request
     * @param $value
     * @return mixed
     */
    public function canTrans($route, $request, $value)
    {
        $parameter = explode(':', $value);
        $bCtrl = new BaseController;
        $uri = explode('/', Request::path());
        $type = $uri[count($uri) - 2];
        $balances = ['itemBalance'];
        $settles = ['settleAdd', 'settleDown'];
        if (in_array($type, $balances)) {
            $group = "balances";
        } elseif (in_array($type, $settles)) {
            $group = "settles";
        } else {
            $group = "invoices";
        }
        if (!PermissionController::isSession($group, $type, $parameter[0])) {
            return $this->makeError();
        } else {
            if (Route::currentRouteName() == 'addTrans') {
                if (!$bCtrl->isHaveBranch()) {
                    $branches = Branches::company()->get()->lists('id');
                    if (end($uri) != Auth::user()->br_id && in_array(end($uri), $branches)) {
            return $this->makeError();
                    }
                }
            }
        }
    }

    public function canViewTrans()
    {
        $bCtrl = new BaseController;
        $uri = explode('/', Request::path());
        $type = $uri[count($uri) - 2];
        $balances = ['ItemBalance'];
        $settles = ['settleAdd', 'settleDown'];
        if (in_array($type, $balances)) {
            $group = "balances";
        } elseif (in_array($type, $settles)) {
            $group = "settles";
        } else {
            $group = "invoices";
        }
        if (!PermissionController::isSession($group, $type, 'show')) {
            return $this->makeError();
        }
    }

    public function canViewOneTrans()
    {
        $uri = explode('/', Request::path());

        $link = explode('-',end($uri));
        $type = $link[count($link)-3];
        $balances = ['itemBalance'];
        $settles  = ['settleAdd','settleDown'];
        if(in_array($type,$balances)){
            $group = "balances";
        } elseif (in_array($type, $settles)) {
            $group = "settles";
        } else {
            $group = "invoices";
        }

        if (!PermissionController::isSession($group, $type, 'show')) {
            return $this->makeError();
        }
    }

    public function canShowSettle()
    {
        $uri = explode('/', Request::path());
        $type = $uri[count($uri) - 1];
        if ($type == "result-the-balance-of-the-stores") {
        }
        $settles = ['settleAdd', 'settleDown'];
        $stores = ['balance_stores', 'evaluation_stores', 'inventory_store'];
        $general_accounts = ['customers', 'suppliers', 'bank', 'partners', 'expenses', 'multiple_revenue'];
        $reports_invoices = ['sales', 'sumSales', 'salesReturn', 'sumSalesReturn', 'buy', 'sumBuy', 'buyReturn', 'sumBuyReturn', 'sales-earnings'];
        if (in_array($type, $stores)) {
            $type = camel_case($type);
            $group = "p_reports_stores";
        } elseif (in_array($type, $settles)) {
            $type = 'p_' . $type;
            $group = "p_reports_stores";
        } elseif (in_array($type, $general_accounts)) {
            $type = 'p_' . $type;
            $group = "p_general_accounts";
        } elseif (in_array($type, $reports_invoices)) {
            if ($type == 'sales-earnings') {
                $type = 'salesEarnings';
            }
            $type = 'p_' . $type;
            $group = "p_reports_invoices";
        } elseif ($type == 'sum') {
            $type = 'sum_' . $uri[count($uri) - 2];
            $type = 'p_' . camel_case($type);
            $group = "p_reports_invoices";
        }
        if (!PermissionController::isSession($group, $type, 'show')) {
            return $this->makeError();
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    private function makeError()
    {
        $data['error'] = "ليس لديك صلاحية لدخول هذا القسم";
        return View::make('errors.missing', $data);
    }

}