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

    public static $months = array(
        "1"=>"يناير",
        "فبراير",
        "مارس",
        "أبريل",
        "مايو",
        "يونيو",
        "وليو",
        "أغسطس",
        "سبتمبر",
        "أكتوبر",
        "نوفمبر",
        "ديسمبر",

    );

    public static $years = array(

        '2014'=>'2014',
        '2015'=>'2015',
        '2016'=>'2016',
        '2017'=>'2017',
    );
    public static  $messages = array(
        'required'            => 'هذا الحقل مطلوب',
        'email'               => 'يرجى إدخال الإيميل بشكل صحيح ',
        'numeric'             => 'يرجى الإدخال  على شكل أرقام فقط ',
        'integer'             => 'يرجى الإدخال  على شكل أرقام فقط ',
        'loan_val.regex'      =>  'يمكنك فقط ادخال ارقام صحيحه موجبة او ارقام عشرية بحد اقصى رقمين عشريين  ',
        'loan_currBal.regex'  =>  'يمكنك فقط ادخال ارقام صحيحه موجبة او ارقام عشرية بحد اقصى رقمين عشريين   ',
        'date'                =>  ' يرجى ادخال التاريخ بشكل صحيح ',
        'min'                 =>  'لا بد أن يحتوى هذا الحقل على ثلاثة أحرف على الأقل',
        'val.regex'           =>  'يمكنك فقط ادخال ارقام صحيحه موجبة او ارقام عشرية بحد اقصى رقمين عشريين  ',
        'salary.regex'        => 'يمكنك فقط ادخال ارقام صحيحه موجبة او ارقام عشرية بحد اقصى رقمين عشريين  ',
        'ins_salary.regex'    => 'يمكنك فقط ادخال ارقام صحيحه موجبة او ارقام عشرية بحد اقصى رقمين عشريين  ',
        'ins_val.regex'       => 'يمكنك فقط ادخال ارقام صحيحه موجبة او ارقام عشرية بحد اقصى رقمين عشريين  ',
        'card_no.max'         => ' يرجى ادخال الرقم القومى بشكل صحيح',
        'card_no.min'         => ' يرجى ادخال الرقم القومى بشكل صحيح',
        'card_no.unique'      => 'هذا الرقم مستخدم من قبل ',
        // salary  ins_salary  ins_val

        );


    public static function ViewDate($date){
       $date_format =  date('d /m / Y',strtotime($date));

        return $date_format;
    }
    public static function ViewTime($date)
    {

        $date_format = date('h:i ', strtotime($date));

        $a = date('a', strtotime($date));
        if ($a == 'am') {
            $date_format .= 'صباحاً';
        } else {
            $date_format .= 'مساءً';
        }
        return $date_format;

    }

    public static function ViewDateAndTime($date_and_time)
    {
        $date_format = date('d /m / Y ', strtotime($date_and_time));
        $date_format .= '<br/>';
        $date_format .= date('h:i  ', strtotime($date_and_time));

        $a = date('a', strtotime($date_and_time));
        if ($a == 'am') {
            $date_format .= 'صباحاً';
        } else {
            $date_format .= 'مساءً';
        }
        return $date_format;
    }
    /**
     * search array of array
     * return index of array has same $key and $value
     * @param $array
     * @param $key
     * @param $value
     * @return int|string
     */
    public static function arraySearch($array,$key,$value){
        if(is_object($array)){
            foreach($array as $k=>$v){
                if ($v[$key] == $value) {
                    return $k;
                    break;
                }
            }
        }else{
            return "asd";
        }
    }

    public function IsItemBelongToCompany()
    {
       $postedItems = Items::whereNotIn('id',TransDetails::countOfInputs(Input::all()))->get();
//        dd($postedItems);
        if($postedItems->isEmpty()){
            return false;
        }else{
            return true;
        }

    }
    public function IsAccountBelongToCompany()
    {
        $accountId = Input::get('account_id');
//        dd($accountId);
        if($accountId>0){
            $postedAccount = Accounts::company()->where('id',$accountId)->get();
            if($postedAccount->isEmpty()){
                return false;
            }else{
                return true;
            }
        }else{
            return true;

        }
    }
    public function priceBaseOnAccount($accountId = null,$itemId)
    {
        if (isset($accountId)) {

            return Items::company()->find($itemId)->sell_users;

        } else {
            return Items::company()->find($itemId)->sell_users;
        }

    }
   public static function editIds($table_name,$model_name,$col_name)
    {
        // get all data from table
        $rows = DB::table($table_name)->lists("$col_name");

        // count the data
        $counts = count($rows);

        for ($i = 0; $i < $counts; $i++) {

            // get first row in table
            $first_row = DB::select(DB::raw("select * from $table_name"))[$i];

            if (!empty($first_row)) {

                $row_edit = $model_name::find($first_row->id);

                if (!empty($row_edit)) {
                    $row_edit->$col_name = $i + 1;
                    $row_edit->save();

                }


            }
        }
        return true;
    }


    public static function maxId ($var_name)
    {
        $true_id = $var_name->max('true_id') + 1;
        return $true_id;

    }
}
