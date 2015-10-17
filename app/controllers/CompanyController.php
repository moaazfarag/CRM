<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/6/2015
 * Time: 12:30 PM
 */
    class CompanyController extends BaseController
            {

    public function addNewCompany(){

        if(Auth::check()){

            return Redirect::route('index');

        }else{

            return View::make('dashboard.company.add_new_company');
        }
    }

    public function storeNewCompany (){


        $inputs = Input::all();
//       return  var_dump($inputs);
        $validation = Validator::make($inputs, CoData::$store_company,BaseController::$messages);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());

        }else {
            // store company data
            $company               = new CoData;
            $company->co_name      = $inputs['co_name'];
            $company->co_address   = $inputs['co_address'];
            $company->co_tel       = $inputs['co_tel'];
            $company->save();

            if($company->save()) {
                // store owner user data
                $user            = new User;
                $user->co_id     = $company->id;
                $user->username  = $inputs['username'];
                $user->all_br    = 1;
                $user->password  = Hash::make($inputs['password']);
                $user->email     = $inputs['email'];
                $user->owner     = 'acount_creator';
                $user->save();
               
                if($user->save()) {
                    // store mine branch data
                    $branch             = new Branches;
                    $branch->true_id    = BaseController::maxId($branch);
                    $branch->br_name    = 'الفرع الرئيسى';
                    $branch->br_address = $company->co_address;
                    $branch->user_id    = $user->id;  // id of user  who add  this branch
                    $branch->co_id      = $company->id;// id of company related this branch 
                    $branch->save();

                    if($branch->save()){
                    
                     // login 
                    $user_login = new UserController;
                    Session::flash('success', 'مرحباً بكم فى موقع الراصد لإدارة الشركات ');
                    return $user_login->checkLogin();

                    }else{

                    // if don't save branch data        
                    $msg =  "عفواً لم يتم التسجيل .. يرجى التسجيل فى وقت لاحق";
                    Session::flash('error',$msg);
                    return Redirect::back();
                }
       
                  
                }else{

                    // if don't save user data 
                    $msg =  "عفواً لم يتم التسجيل .. يرجى التسجيل فى وقت لاحق";
                    Session::flash('error',$msg);
                    return Redirect::back();
                }

            }else{

               // if don't save company data 
                $msg = "عفواً لم يتم التسجيل .. يرجى التسجيل فى وقت لاحق";
                Session::flash('error',$msg);
                return Redirect::back();
            }

        }
    }


        /**
         * ـعديل ملومات الشركة
         * @return mixed
         * edit company data
         */


        public function editCompanyInfo()
        {
            $data = $this->settingData();//company info data
            $data['miniComInfo']  = "" ; //maxmizie company data on view
            $data['print_size_types'] = array(

                "A3"=>"A3",
                "A4"=>"A4",
                "A5"=>"A5",

            );
            return View::make('dashboard.company.index',$data);
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