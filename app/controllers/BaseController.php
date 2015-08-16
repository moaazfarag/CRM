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
    public function coAuth()
    {
        return Auth::user()->co_id;
    }
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
}
