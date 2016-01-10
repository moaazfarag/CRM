<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/6/2015
 * Time: 12:30 PM
 */
class CompanyController extends BaseController
{

    public function addNewCompany()
    {

        if (Auth::check()) {

            return Redirect::route('home');

        } else {

            return View::make('dashboard.company.add_new_company');
        }
    }

    public function storeNewCompany()
    {
        $inputs = Input::all();
        $validation = Validator::make($inputs, CoData::$store_company, BaseController::$messages);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            // store company data
            $company = new CoData;
            $company->co_name = $inputs['co_name'];
            $company->co_address = $inputs['co_address'];
            $company->co_tel = $inputs['co_tel'];
            $confirmation_code = str_random(30);
            $date = new DateTime();
            $date->modify('+10 day');
            $company->co_expiration_date = $date->format('Y-m-d');
            $company->co_statues = 0;
            $company->confirmation_code = $confirmation_code;
            $company->save();

            if (!$company->save()){

                // if don't save company data
                $msg = "عفواً لم يتم التسجيل .. يرجى التسجيل فى وقت لاحق";
                Session::flash('error', $msg);
                return Redirect::back();
            }
                // store owner user data
                $user = new User;
                $user->co_id = $company->id;
                $user->username = $inputs['username'];
                $user->name = $inputs['username'];
                $user->all_br = 1;
                $user->password = Hash::make($inputs['password']);
                $user->email = $inputs['email'];
                $user->permission = json_encode(PermissionController::setPermission(1));
                $user->owner = 'acount_creator';
                $user->save();

                if (!$user->save()){
                    $delete_company = CoData::find($company->id);
                    $delete_company->delete();
                    // if don't save user data
                    $msg = "عفواً لم يتم التسجيل .. يرجى التسجيل فى وقت لاحق";
                    Session::flash('error', $msg);
                    return Redirect::back();
                }

            // store mine branch data
                    $branch = new Branches;
//                    $branch->true_id    = BaseController::maxId($branch);
                    $branch->br_name = 'الفرع الرئيسى';
                    $branch->br_address = $company->co_address;
                    $branch->user_id = $user->id;  // id of user  who add  this branch
                    $branch->co_id = $company->id;// id of company related this branch
                    $branch->save();

                    if (!$branch->save()) {

                        $delete_company = CoData::find($company->id);
                        $delete_company->delete();

                        $delete_user = User::find($user->id);
                        $delete_user->delete();

                        // if don't save branch data
                        $msg = "عفواً لم يتم التسجيل .. يرجى التسجيل فى وقت لاحق";
                        Session::flash('error', $msg);
                        return Redirect::back();
                    }

                        $home = new Home;
                        $home->co_id    = $company->id;
                        $home->title    = $company->co_name;
                        $home->details  ='وصف مختصر عن الشركة ';
                        $home->about    ='من نحن';
                        $home->about_content    ='من نحن';
                        $home->facebook ='#';
                        $home->twitter  ='#';
                        $home->google   ='#';
                        $home->youtube  ='#';
                        $home->linkedin ='#';
                        $home->instgram ='#';
                        $home->email    =$user->email;
                        $branch->save();

                        if (!$home->save()) {

                            $delete_company = CoData::find($company->id);
                            $delete_company->delete();

                            $delete_user = User::find($user->id);
                            $delete_user->delete();

                            $delete_branch = Branches::find($branch->id);
                            $delete_branch->delete();

                            // if don't save home page data
                            $msg = "عفواً لم يتم التسجيل .. يرجى التسجيل فى وقت لاحق";
                            Session::flash('error', $msg);
                            return Redirect::back();
                        }
                        // login

                        $data['company_name'] = $inputs['co_name'];
                        $data['username'] = $user->username;
                        $data['confirmation_code'] = $confirmation_code;
                        $data['co_id'] = $company->id;

                        Mail::send('emails.welcome', $data, function($message){
                            $message->to(Input::get('email'))->subject('message from elrased web ');
                        });

                        $data['address'] = $inputs['co_address'];
                        $data['company'] = $inputs['co_name'];
                        $data['name']    = $inputs['co_name'];
                        $data['co_id']   = $company->id;
                        Mail::send('emails.elrased_owner', $data, function($message){
                            $message->to('halem@clickfordata.net')->subject('message from elrased web ');
                        });

                     if(count(Mail::failures()) > 0){

                         $delete_company = CoData::find($company->id);
                         $delete_company->delete();

                         $delete_user = User::find($user->id);
                         $delete_user->delete();

                         $delete_branch = Branches::find($branch->id);
                         $delete_branch->delete();

                         $delete_home = Home::find($home->id);
                         $delete_home->delete();


                         Session::flash('error_save_company', 'عفواً حدث خطأ أثناء حفظ البيانات ... يرجى المحاولة مرة أخرى ');
                         return Redirect::route('login');
                     }else{

                         Session::flash('success_save_company', 'مرحباً بكم فى موقع الراصد يرجى الذهاب الى بريدك الألكترونى والضغط على رسالة التأكيد ');
                            return Redirect::route('login');
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
        $data['miniComInfo'] = ""; //maxmizie company data on view
        $data['print_size_types'] = array(

            "A3" => "A3",
            "A4" => "A4",
            "A5" => "A5",

        );
        $data['currency'] = BaseController::$currency;
        return View::make('dashboard.company.index', $data);
    }

    /**
     * update company data info
     * @param $id
     * @return string
     */
    public function updateCompanyInfo($id)
    {
        $company = CoData::findOrFail($id);
        if ($company && $id == Auth::user()->co_id)
            $inputs = Input::all();

        $validation = Validator::make($inputs, CoData::$edit_company, BaseController::$messages);

        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());

        } else {

            $company = CoData::findOrFail($id);
            if ($company && $id == Auth::user()->co_id) {
                $company                    = CoData::find($id); // new object from company will update
                $company->co_name           = Input::get('co_name'); // company name
                $company->co_address        = Input::get('co_address'); //company address
                $company->co_tel            = Input::get('co_tel'); // company mobile
                $company->co_invoice_notes  = Input::get('co_invoice_notes'); // company mobile
                $company->co_currency       = Input::get('co_currency');// currency will use in this company
                $company->co_print_size     = Input::get('co_print_size');// print size for invoice
                $company->co_use_serial     = intval(Input::get('co_use_serial'));// will use serial or not
                $company->co_supplier_must     = intval(Input::get('co_supplier_must'));// have to enter supplier when add new item
                $company->co_use_season        = intval(Input::get('co_use_season'));// will use season or not
                $company->co_use_markes_models = intval(Input::get('co_use_markes_models'));// will use models AND markes  or not

                if (Input::hasFile('co_logo') && $company->co_logo != '') {
                    File::delete('/dashboard/logo_images/', $company->co_logo);
                }

                $company->co_logo = ((Input::hasFile('co_logo')) ? $this->saveImage(Input::file('co_logo')) : "");
                $company->user_id = Auth::id(); //user who update company info

                $company->update();

                Session::flash('success', BaseController::editSuccess('بيانات الشركة '));
                return Redirect::route('editCompanyInfo');
            } else {
                return View::make('errors.missing');
            }
        }


        $validation = Validator::make($inputs, CoData::$edit_company, BaseController::$messages);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());


        } else {

            $company = CoData::findOrFail($id);
            if ($company && $id == Auth::user()->co_id) {
                $company = CoData::find($id); // new object from company will update
                $company->co_name = Input::get('co_name'); // company name
                $company->co_address = Input::get('co_address'); //company address
                $company->co_tel = Input::get('co_tel'); // company mobile
                $company->co_currency = Input::get('co_currency');// currency will use in this company
                $company->co_print_size = Input::get('co_print_size');// print size for invoice
                $company->co_use_serial = intval(Input::get('co_use_serial'));// will use serial or not
                $company->co_supplier_must = intval(Input::get('co_supplier_must'));// have to enter supplier when add new item
                $company->co_use_season = intval(Input::get('co_use_season'));// will use season or not
                $company->co_use_markes_models = intval(Input::get('co_use_markes_models'));// will use models AND markes  or not
                $company->co_logo = ((Input::hasFile('co_logo')) ? $this->saveImage(Input::file('co_logo')) : "");// will use models AND markes  or not
                $company->user_id = Auth::id(); //user who update company info

                $company->update();

                Session::flash('success', BaseController::editSuccess('بيانات الشركة '));
                return Redirect::route('editCompanyInfo');
            } else {
                return View::make('errors.missing');
            }
        }
    }

        public function trialEnd(){


            return View::make('dashboard.company.trial_end');

        }
    public function notConfirmed(){


        return View::make('dashboard.company.not_confirmed');

    }

    }

