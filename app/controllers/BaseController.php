<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
    public function coAuth()
    {
        return Auth::user()->co_id;
    }

    public static function companyAuth()
    {
        return Auth::user()->co_id;
    }
   public static function isBelongToCompany($table,$col,$id){

        $check = DB::table($table)->where($col,intval($id))->where('co_id',self::companyAuth())->first();

       if(!empty($check)){
           return true;
       }else{
           return false;
       }

}

    protected function settingData()
    {
        $settingData         =Lang::get('main.settingData');
        $small               =Lang::get('main.small');
        $average             =Lang::get('main.average');
        $large               =Lang::get('main.large');
        $data['title']       = $settingData ;
        $data['companyInfo'] = CoData::Where('id','=',Auth::user()->co_id)->first();
        $data['asideOpen']   = 'open' ;
        $data['printSize']   = array('a1'=>$small,'a3'=>$average,'a4'=>$large);
        $data['branches']    = Branches::where('co_id','=',Auth::user()->co_id)->get();
        return $data;
    }

    /**
     * @return mixed
     */

    /*
     *  check if  user can controller all barnches or not
     *
     * */
    public function isAllBranch()
    {
        //check if  user can controller all barnches or not
        if(Auth::user()->all_br){
            return true;
        }else{
            return $this->branchName();
        }
    }
    public function branchName()
    {
     return Branches::find(Auth::user()->br_code)->br_name;
    }
    public function strToTime($date)
    {
        return date("Y-m-d", strtotime($date));
    }


    public static  $messages = array(
        'required'=>'هذا الحقل مطلوب',
        'email'=>'يرجى إدخال الإيميل بشكل صحيح ',
        'acc_limit.numeric'=>'يرجى ادخال حد الإتمان على شكل أرقام فقط ',

    );
}
