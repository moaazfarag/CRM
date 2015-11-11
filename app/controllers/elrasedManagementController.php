<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 11/9/2015
 * Time: 1:41 PM
 */
class elrasedManagementController extends  BaseController
{

    public function home($statues = NULL){

        $data['type'] = $statues;

        if($statues != NULL){

            $data['title']  = Lang::get("main.".$statues);
        }else{
            $data['title']  = Lang::get("main.all_companies");
        }

        if($statues == 'all_companies' || $statues == NULL) {
            $data['all_company'] = CoData::all();
        }elseif($statues == 'paid_companies'){
            $data['all_company'] = CoData::where('co_statues',1)->get();

        } elseif($statues == 'trial_companies'){
            $data['all_company'] =  CoData::where('co_statues',0)->get();
        }elseif($statues == 'suspended_companies'){
            $data['all_company'] = CoData::where('co_statues',2)->get();
        }

        return View::make('management.home.index',$data);
    }

    public function updateCompanyReservations(){

        $inputs = Input::all();
        $co_id  =  intval($inputs['co_id']);
        if($co_id == 0){
            Session::flash('error','عفواً لم يتم تعديل الفترة يرجى المحاولة مرة أخرى');
            return Redirect::back();
        }

        $company = CoData::where('id',$co_id)->first();

        if(!empty($company)){

            $year   = intval($inputs['year']);
            $month  = intval($inputs['month']);
            $day    = intval($inputs['day']);
            $last_date = $company->co_expiration_date;


                $date = new DateTime($last_date);
                $date->modify("+$day day");
                $date->modify("+$month month");
                $date->modify("+$year year");

                $company->co_expiration_date = $date->format('Y-m-d');
                $company->update();
                Session::flash('success','تم تعديل  معاد انتهاء الحجز بنجاح');
                return Redirect::route('elrasedManagement');


        }

    }

    public function stopCompany(){

        $inputs = Input::all();
        $co_id  =  intval($inputs['co_id']);
        if($co_id == 0){
            Session::flash('error','عفواً لم يتم إيقاف الشركة يرجى المحاولة مرة أخرى');
            return Redirect::back();
        }

        $company = CoData::where('id',$co_id)->first();

        if(!empty($company)){
           $company->co_statues = 2;
            $company->update();
            Session::flash('success','تم إيقاف الشركة بنجاح');
            return Redirect::route('elrasedManagement');
        }
    }

    public function activationCompany(){

        $inputs = Input::all();
        $co_id  =  intval($inputs['co_id']);
        if($co_id == 0){
            Session::flash('error','عفواً لم يتم تفعيل الشركة يرجى المحاولة مرة أخرى');
            return Redirect::back();
        }

        $company = CoData::where('id',$co_id)->first();

        if(!empty($company)){
            $company->co_statues = 1;
            $company->update();
            Session::flash('success','تم تفعيل الشركة بنجاح');
            return Redirect::route('elrasedManagement');
        }
    }

    public function deleteCompany(){

        $inputs = Input::all();
        $co_id  =  intval($inputs['co_id']);
        if($co_id == 0){
            Session::flash('error','عفواً لم يتم حذف الشركة يرجى المحاولة مرة أخرى');
            return Redirect::back();
        }

        $company = CoData::where('id',$co_id)->first();

        if(!empty($company)){

            foreach(BaseController::$all_tabels as $table){

                $delete_from_table = DB::table($table)->where('co_id',$co_id)->get();
                if(!empty($delete_from_table)){
                    DB::table($table)->where('co_id',$co_id)->delete();
                }

        }
            DB::table('co_data')->where('id',$co_id)->delete();
            Session::flash('success','تم حذف الشركة بنجاح');
            return Redirect::route('elrasedManagement');
        }else{

            Session::flash('error','عفواً لم يتم حذف الشركة يرجى المحاولة مرة أخرى');
            return Redirect::back();
        }

    }

}