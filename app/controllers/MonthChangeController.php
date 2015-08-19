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

//        $data = $this->depData();
        $data['title'] = 'التغيرات الشهريه '; // page title
        $data['employees'] = "open";
        $data['co_info'] = CoData::where('id', '=', $this->coAuth())->first();
        return View::make('dashboard.hr.month_change.index', $data);

    }

    //Function Store Employee In Data Base
    public function storeMonthChange()
    {
        $validation = Validator::make(Input::all(), MonthChange::$store_rules);

        if ($validation->fails()) {
            //dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $inputs = Input::all();

            $newMonthChange = new MonthChange;
            $newMonthChange->id = $this->coAuth();
            $newMonthChange->trans_date = $this->strToTime($inputs['employee_date']);
            $newMonthChange->trans_serial = Input::get('trans_serial');
            $newMonthChange->for_year = Input::get('trans_serial');
            $newMonthChange->for_month = Input::get('for_month');
            $newMonthChange->day_cost = Input::get('day_cost');
            $newMonthChange->val = Input::get('val');
            $newMonthChange->cause = Input::get('cause');

            $newMonthChange->save();
            return Redirect::route('addMonthChange');
        }
    }

    public function editMonthChange($id)
    {
//        $data = $this->depData() ;
        $data['title'] = 'تعديل فى التغيرات الشهريه    '; // page title
        $data['employees'] = "open";
        $data['employee'] = MonthChange::findOrFail($id);
        $data['co_info'] = CoData::where('id', '=', $this->coAuth())->first();
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
                $oldMonthChange = MonthChange::find($id);
                $oldMonthChange->id = $this->coAuth();
                $oldMonthChange->trans_date           = $this->strToTime($inputs['employee_date']);
                $oldMonthChange->trans_serial         = Input::get('trans_serial');
                $oldMonthChange->for_year             = Input::get('trans_serial');
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
//    protected function depData()
//    {
//        $data['title']              = 'التغيرات الشهريه';
//        $data['employees']          = 'open' ;
//        $data['tablesData']        = MonthChange::where('id','=',$this->coAuth())->get();
//        return $data;
//    }

}