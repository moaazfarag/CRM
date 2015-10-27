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
    public static function  getBranchId()
    {
        //check if  user can controller all barnches or not
        $branches =Branches::company()->get();
        if(Auth::user()->all_br && $branches->count()>1){
            $data['branches'] = $branches;
            $data['all_br']   = "all_br";
            return $data;
        }elseif(!Auth::user()->all_br && $branches->count()>1)
        {
            return Auth::user()->br_id;
        }else{
            return $branches->first()->id;
        }
    }

    public function isHaveBranch()
    {
        //check if  user can controller all barnches or not
        if(Auth::user()->all_br ){
            return true;
        }else{
            return false;
        }
    }

    public function branchName()
    {
     return Branches::find(BaseController::getBranchId())->br_name;
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

    public static function addSuccess($text){

        return Lang::get('main.add_done').$text .Lang::get('main.with_success');
    }

    public static function editSuccess($text){

        return Lang::get('main.edit_done').$text .Lang::get('main.with_success');
    }


    public static function deleteSuccess($text){

        return Lang::get('main.delete_done').$text .Lang::get('main.with_success');
    }


     public static function addError($text){

        return Lang::get('main.add_not_done').$text .Lang::get('main.try_again');
    }

     public static function editError($text){

        return Lang::get('main.edit_not_done').$text .Lang::get('main.try_again');
    }




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
        'password_confirm.same'=> 'كلمتان السر غير متطابقتان',
        'email.unique'         =>'هذا الإيميل مستخدم من قبل ',
        'username.unique'      =>'هذا الأسم مستخدم من قبل',
        'account_id.not_in'    => 'هذا الحقل مطلوب',
        'confirm_new_password.same'=>'كلمتان السر غير متطابقتان',
        );


    public static function ViewDate($date){
       $date_format =  date('d /m /Y',strtotime($date));

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

    public static function LastOneDay($date_from){

        $date = date_create($date_from);
        date_sub($date, date_interval_create_from_date_string('1 days'));
        return date_format($date, 'd-m-Y');
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

    public function IsItemsBelongToCompany()
    {
        
       $ids         =  array_unique(TransDetails::countOfInputs(Input::all()));
       $postedItems = Items::company()->whereIn('id',$ids)->get();
        if($postedItems->count() != count($ids)){
            return false;
        }else{
            return true;
        }
    }
    public function IsSerialsBelongToCompany()
    {
       $ids         =  TransDetails::countOfInputs(Input::all());
       $postedItems = Items::company()->where('has_serial',1)->whereIn('id',$ids)->get();
        if($postedItems->count() != count($ids)){
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
    public function priceBaseOnAccount($accountId = null,$item)
    {

        if (isset($accountId)) {
            $account = Accounts::company()->find($accountId);
            if($account){
                if ($account->pricing == "sell_nos_gomla" && $item->sell_nos_gomla > 0) {
                    return $item->sell_nos_gomla;
                }elseif ($account->pricing == "sell_gomla" && $item->sell_gomla > 0) {
                    return $item->sell_gomla;
                }elseif ($account->pricing == "sell_gomla_gomla" && $item->sell_gomla_gomla > 0) {
                    return $item->sell_gomla_gomla;
                }else{
                    return $item->sell_users;
                }
            }else{
                return $item->sell_users;
            }

        } else {
            return $item->sell_users;
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

    public static function negativeValue($stock) {

        if($stock < 0 ){
            $num    = $stock * -1;
            $result = '( '.$num.' )';
        }else{
            $result = $stock;
        }
        return $result;
    }

}
