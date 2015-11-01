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
    public  function filter($route, $request, $value)
    {
        $parameter = explode(':', $value);
        if (!PerC::isSession($parameter[0], $parameter[1], $parameter[2])) {
            return View::make('errors.missing');
        }
    }

    /**
     * deal with transaction routes add and edit and delete
     * @param $route
     * @param $request
     * @param $value
     * @return mixed
     */
    public  function canTrans($route, $request, $value)
    {
        $parameter = explode(':', $value);
        $bCtrl = new BaseController;
        $uri = explode('/', Request::path());
        $type = $uri[count($uri)-2];
        $balances = ['itemBalance'];
        $settles  = ['settleAdd','settleDown'];
        if(in_array($type,$balances)){
            $group = "balances";
        }elseif(in_array($type,$settles)){
            $group = "settles";
        }else{
            $group = "invoices";
        }
        if (!PerC::isSession($group,$type,$parameter[0])) {
            return View::make('errors.missing');
        } else {
            if (Route::currentRouteName() == 'addTrans') {
                if (!$bCtrl->isHaveBranch()) {
                    if (end($uri) != Auth::user()->br_id) {
                        return View::make('errors.missing');
                    }
                }
            }
        }
    }
    public  function canViewTrans()
    {
        $bCtrl = new BaseController;
        $uri = explode('/', Request::path());
        $type = $uri[count($uri)-2];
        $balances = ['ItemBalance'];
        $settles  = ['settleAdd','settleDown'];
        if(in_array($type,$balances)){
            $group = "balances";
        }elseif(in_array($type,$settles)){
            $group = "settles";
        }else{
            $group = "invoices";
        }
        if (!PerC::isSession($group,$type,'show')) {
            return View::make('errors.missing');
        } else {
            if (Route::currentRouteName() == 'addTrans') {
                if (!$bCtrl->isHaveBranch()) {
                    if (end($uri) != Auth::user()->br_id) {
                        return View::make('errors.missing');
                    }
                }
            }
        }
    }
    public  function canViewOneTrans()
    {
        $bCtrl = new BaseController;
        $uri = explode('/', Request::path());
        $link = explode('-',end($uri));
        $type = $link[count($link)-3];
        $balances = ['itemBalance'];
        $settles  = ['settleAdd','settleDown'];
        if(in_array($type,$balances)){
            $group = "balances";
        }elseif(in_array($type,$settles)){
            $group = "settles";
        }else{
            $group = "invoices";
        }
        if (!PerC::isSession($group,$type,'show')) {
            return View::make('errors.missing');
        } else {
            if (Route::currentRouteName() == 'addTrans') {
                if (!$bCtrl->isHaveBranch()) {
                    if ($link[count($link)-2] != Auth::user()->br_id) {
                        dd($link[count($link)-2]);
                        return View::make('errors.missing');
                    }
                }
            }
        }
    }

}