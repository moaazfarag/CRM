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
        $data['title']       = "تعديل معلومات الشركة" ;
        $data['companyInfo'] = CoData::Where('id','=',Auth::user()->co_id)->first();
        $data['asideOpen']   = 'open' ;
        $data['printSize']   = array('a1'=>'صغير','a3'=>'متوسط','a4'=>'كبير');
        $data['branches']     = Branches::where('co_id','=',Auth::user()->co_id)->get();
        return $data;
    }

    /**
     * @return mixed
     */
    public function coAuth()
    {
        return Auth::user()->co_id;
    }
}
