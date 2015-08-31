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
        $data['title'] = 'التغيرات الشهريه '; // page title
        $data['employees'] = "open";
        $data['monthchange'] = MonthChange::where('co_id', '=', $this->coAuth())->first();
        $data['co_info'] = coData::where('id', '=', $this->coAuth())->first();
        return View::make('dashboard.hr.month_change.index', $data);
    }

    //Function Store Employee In Data Base
    public function storeMonthChange()
    {
        $validation = Validator::make(Input::all(), MonthChange::$store_rules);

        if ($validation->fails()) {
            dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $inputs = Input::all();

            $newMonthChange = new MonthChange;
            $newMonthChange->co_id         = $this->coAuth();
            $newMonthChange->user_id       = Auth::id();
            $newMonthChange->employee_id   = Input::get('employee_id');
            $newMonthChange->desded_id     = Input::get('ds_id');
            $newMonthChange->trans_date    = $this->strToTime($inputs['trans_date']);
//            $newMonthChange->trans_serial = Input::get('trans_serial');
            $newMonthChange->for_year      = Input::get('for_year');
            $newMonthChange->for_month     = Input::get('for_month');
            $newMonthChange->day_cost      = Input::get('day_cost');
            $newMonthChange->val           = Input::get('val');
            $newMonthChange->cause         = Input::get('cause');
            $newMonthChange->cancel_cause  = Input::get('cancel_cause');

            $newMonthChange->save();
            return Redirect::route('addMonthChange');
        }
    }

    public function editMonthChange($id)
    {
        $data = $this->depData() ;
        $data['title'] = 'تعديل فى التغيرات الشهريه    '; // page title
        $data['employees'] = "open";
        $data['employee'] = MonthChange::findOrFail($id);
        $data['monthchange'] = MonthChange::where('co_id', '=', $this->coAuth())->first();
        $data['co_info'] = coData::where('id', '=', $this->coAuth())->first();
        return View::make('dashboard.hr.month_change.index', $data);
    }

    public function updateMonthChange($id)
    {
        $validation = Validator::make(Input::all(), MonthChange::$update_rules);

        if ($validation->fails()) {

            //dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            $inputs = Input::all();
            $oldMonthChange = MonthChange::where('id', '=', $id)->where('id', '=', $this->coAuth())->first();
            if ($oldMonthChange) {
                $oldMonthChange                       = MonthChange::find($id);
                $oldMonthChange->id                   = $this->coAuth();
                $oldMonthChange->user_id              = Auth::id();
                $oldMonthChange->employee_id          = Input::get('employee_id');
                $oldMonthChange->desded_id            = Input::get('ds_id');
                $oldMonthChange->trans_date           = $this->strToTime($inputs['employee_date']);
//                $oldMonthChange->trans_serial         = Input::get('trans_serial');
                $oldMonthChange->for_year             = Input::get('for_year');
                $oldMonthChange->for_month            = Input::get('for_month');
                $oldMonthChange->day_cost             = Input::get('day_cost');
                $oldMonthChange->val                  = Input::get('val');
                $oldMonthChange->cause                = Input::get('cause');
                $oldMonthChange->cancel_cause         = Input::get('cancel_cause');

                $oldMonthChange->update();
                return Redirect::route('addMonthChange');

            }
        }
    }
    protected function depData()
            {
                $data['title']              = 'التغيرات الشهريه';
                $data['employees']          = 'open' ;
                $data['tablesData']        = MonthChange::where('co_id','=',$this->coAuth())->get();
                return $data;
            }

}