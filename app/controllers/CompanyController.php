<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/6/2015
 * Time: 12:30 PM
 */
    class CompanyController extends BaseController
            {
        /**
         * ـعديل ملومات الشركة
         * @return mixed
         * edit company data
         */
        public function editCompanyInfo()
        {
            $data = $this->settingData();
            $data['miniComInfo']  = "" ;
            return View::make('dashboard.setting',$data);
        }
        public function updateCompanyInfo($id)
        {
            $company = CoData::find($id);
            if($company &&  $id == Auth::user()->co_id )
            {
                $company = CoData::find($id);
                $company->co_name = Input::get('co_name');
                $company->co_address = Input::get('co_address');
                $company->co_tel     = Input::get('co_tel');
                $company->co_currency = Input::get('co_currency');
                $company->co_print_size = Input::get('co_print_size');
                $company->co_use_serial = Input::get('co_use_serial');
                $company->co_supplier_must = Input::get('co_supplier_must');
                $company->co_use_season = Input::get('co_use_season');
                $company->co_use_markes_models = Input::get('co_use_markes_models');
                $company->user_id = 1;
                $company->update();
                return Redirect::route('editCompanyInfo');
            }else{

                return "error";
            }


        }

            }