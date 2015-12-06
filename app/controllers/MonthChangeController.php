<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/17/2015
 * Time: 4:32 PM
 */
class MonthChangeController extends BaseController
{
    public function addMonthChange()
    {
        $data = $this->depData();
        $data['title'] = Lang::get('main.month_change'); // page title
        $data['employees'] = "open";
        $data['monthchange'] = MonthChange::company()->first();
        $data['co_info'] = CoData::thisCompany()->first();
        return View::make('dashboard.hr.month_change.index', $data);
    }

    //Function Store Employee In Data Base
    public function storeMonthChange()
    {
        $validation = Validator::make(Input::all(), MonthChange::$store_rules,BaseController::$messages);

        if ($validation->fails()) {
//            dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $inputs = Input::all();

            $newMonthChange = new MonthChange;
            $newMonthChange->co_id         = $this->coAuth();
            $newMonthChange->user_id       = Auth::id();
            $newMonthChange->employee_id   = Input::get('employee_id');
            $newMonthChange->des_ded_id     = Input::get('ds_id');
            $newMonthChange->trans_date    = $this->strToTime($inputs['trans_date']);
//            $newMonthChange->trans_serial = Input::get('trans_serial');
            $newMonthChange->for_year      = Input::get('for_year');
            $newMonthChange->for_month     = Input::get('for_month');
            $newMonthChange->day_cost      = Input::get('day_cost');
            $newMonthChange->val           = Input::get('val');

            if($newMonthChange->save()){

                Session::flash('success',BaseController::addSuccess('التغير الشهرى '));
            }else{

                Session::flash('error',BaseController::addError('التغير الشهرى '));
            }
            return Redirect::route('addMonthChange');
        }
    }

    public function editMonthChange($id)
    {
        $data = $this->depData() ;
        $data['title'] = Lang::get('main.month_change_edit'); // page title
        $data['employees'] = "open";
        $data['employee'] = MonthChange::findOrFail($id);
        $data['monthchange'] = MonthChange::company()->first();
        $data['co_info'] = CoData::thisCompany()->first();
        return View::make('dashboard.hr.month_change.index', $data);
    }

    public function updateMonthChange($id)
    {
        if(Input::has('canceled')){
            $ruels = MonthChange::$update_rules_with_cause;
        }else{
            $ruels = MonthChange::$update_rules;
        }

        $validation = Validator::make(Input::all(), $ruels,BaseController::$messages);

        if ($validation->fails()) {

            //dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            $inputs = Input::all();
            $oldMonthChange = MonthChange::where('id', '=', $id)->thisCompany()->first();

                $oldMonthChange                       = MonthChange::find($id);
                $oldMonthChange->co_id                 = $this->coAuth();
                 $oldMonthChange->user_id              = Auth::id();
                $oldMonthChange->employee_id          = Input::get('employee_id');
                $oldMonthChange->des_ded_id            = Input::get('ds_id');
                $oldMonthChange->trans_date           = $this->strToTime($inputs['trans_date']);
//                $oldMonthChange->trans_serial         = Input::get('trans_serial');
                $oldMonthChange->for_year             = Input::get('for_year');
                $oldMonthChange->for_month            = Input::get('for_month');
                $oldMonthChange->day_cost             = Input::get('day_cost');
                $oldMonthChange->val                  = Input::get('val');
                if(Input::has('canceled')) {

                    $oldMonthChange->canceled      = @Input::get('canceled');
                    $oldMonthChange->cancel_cause  = @Input::get('cancel_cause');
                }
//                $oldMonthChange->cause                = Input::get('cause');

            if($oldMonthChange->update()){
                Session::flash('success',BaseController::editSuccess('التغير الشهرى '));
            }else{
                Session::flash('error',BaseController::editError('التغير الشهرى '));
            }
                return Redirect::route('addMonthChange');


        }
    }
    protected function depData()
            {
                $data['title']              = Lang::get('main.month_change');
                $data['employees']          = 'open' ;
                $data['tablesData']         = MonthChange::company()->get();
                return $data;
            }
    public function deleteMonthChange($id){
        $MonthChange = MonthChange::company()
            ->where('id',$id)
            ->first();

        if (!empty($MonthChange)) {

            $MonthChange->delete();

            Session::flash('success','تم حذف التغير الشهرى بنجاح ');
            return Redirect::back();
        }else{
            Session::flash('error', 'عفواً لم يتم حذف التغير الشهرى ... حاول مرة أخرى');
            return Redirect::back();
        }
    }

    public function multiDeleteMonthChange()
    {
        $inputs = Input::all();

        // if user not select any check box
        if (!isset($inputs['checkbox'])) {
            Session::flash('error', 'لم يتم تحديد بيانات لحذفها ');
            return Redirect::back();
        }

        $count_of_deleted = 0;
        $want_to_delete = count($inputs['checkbox']);

        foreach ($inputs['checkbox'] as $id) {

            $delete =  MonthChange::company()->find($id);
            if($delete){

                $delete->delete();
                $count_of_deleted++;
            }

        }
        if($want_to_delete != $count_of_deleted){
            $msg = Lang::get('main.delete_is_done').' ('.$count_of_deleted.' )'.Lang::get('main.from_rows').' ('.$want_to_delete.' )';
            $type_of_msg = 'error';

        }else{
            $msg         = Lang::get('main.the_delete_is_done').Lang::get('main.with_success');
            $type_of_msg = 'success';
        }
        Session::flash($type_of_msg, $msg);
        return Redirect::back();

    }
}