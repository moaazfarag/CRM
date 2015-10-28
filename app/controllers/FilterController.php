<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 10/25/2015
 * Time: 12:16 PM
 */
class FilterController extends BaseController
{
    public  function filter($route, $request, $value)
    {
        $bCtrl = new BaseController;
        $parameter = explode(':', $value);
        $uri = explode('/', Request::path());

        if (!PerC::isSession($parameter[0], $parameter[1], $parameter[2])) {
            return View::make('errors.missing');
        }
    }
    public  function canAddTrans()
    {
        $bCtrl = new BaseController;
        $uri = explode('/', Request::path());
        if (!PerC::isSession('invoices',$uri[count($uri)-2],'add')) {
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

}