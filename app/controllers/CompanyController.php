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
            $data = $this->settingData();//company info data
            $data['miniComInfo']  = "" ; //maxmizie company data on view
            return View::make('dashboard.setting',$data);
        }

        /**
         * update company data info
         * @param $id
         * @return string
         */
        public function updateCompanyInfo($id)
        {
            $company = CoData::findOrFail($id);
            if($company &&  $id == Auth::user()->co_id )
            {
                $company                       = CoData::find($id); // new object from company will update
                $company->co_name              = Input::get('co_name'); // company name
                $company->co_address           = Input::get('co_address'); //company address
                $company->co_tel               = Input::get('co_tel'); // company mobile
                $company->co_currency          = Input::get('co_currency');// currency will use in this company
                $company->co_print_size        = Input::get('co_print_size');// print size for invoice 
                $company->co_use_serial        = intval(Input::get('co_use_serial'));// will use serial or not
                $company->co_supplier_must     = intval(Input::get('co_supplier_must'));// have to enter supplier when add new item
                $company->co_use_season        = intval(Input::get('co_use_season'));// will use season or not
                $company->co_use_markes_models = intval(Input::get('co_use_markes_models'));// will use models AND markes  or not
                $company->user_id              = Auth::id(); //user who update company info
                $company->update();
                return Redirect::route('editCompanyInfo');
            }else{
                return "error";
            }


        }

            }