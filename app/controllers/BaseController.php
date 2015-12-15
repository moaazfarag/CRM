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
        $data['branches']    = Branches::company()->where('deleted',0)->get();
        return $data;
    }

    /**
     * @return mixed
     */

    /*
     *  check if  user can controller all barnches or not
     *
     * */
    public function saveImage($input_name){

    $dest = '/dashboard/logo_images/';
    $name = str_random(5).'.'.$input_name->getClientOriginalExtension();
    $img  = Image::make($input_name)->resize(300, 200);
    $img->save(public_path().$dest . $name);

//        dd($dest . $name);
    return $dest . $name;
}

    public function saveEmployeePhoto($input_name){

        $dest = '/dashboard/employee_photo/';
        $name = str_random(5).'.'.$input_name->getClientOriginalExtension();
        $img  = Image::make($input_name)->resize(300, 200);
        $img->save(public_path().$dest . $name);

//        dd($dest . $name);
        return $dest . $name;
    }
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
        $branches =Branches::company()->where('deleted',0)->get();
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

    public static function deleteError($text){

        return Lang::get('main.delete_not_done').$text .Lang::get('main.try_again');
    }


     public static function addError($text){

        return Lang::get('main.add_not_done').$text .Lang::get('main.try_again');
    }

     public static function editError($text){

        return Lang::get('main.edit_not_done').$text .Lang::get('main.try_again');
    }




    public static  $messages = array(

        'password.min'        => 'لا بد أن تحتوى كلمة المرور على 8 أحرف على الأقل',
        'old_password.min'    => 'لا بد أن تحتوى كلمة المرور على 8 أحرف على الأقل',
        'new_password.min'    => 'لا بد أن تحتوى كلمة المرور على 8 أحرف على الأقل',
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
        'confirm_password.same'=> 'كلمتان السر غير متطابقتان',
        'email.unique'         =>'هذا الإيميل مستخدم من قبل ',
        'username.unique'      =>'هذا الأسم مستخدم من قبل',
        'account_id.not_in'    => 'هذا الحقل مطلوب',
        'confirm_new_password.same'=>'كلمتان السر غير متطابقتان',

        'image'                => 'الملف المرفوع ليس بصورة',
        'co_logo.mimes'        => 'الملف المرفوع ليس بصورة',
        'co_logo.between'         => 'حجم الصورة كبيــر .. يرجى رفع صورة أقل من واحد ميجا ',
        );

        public static $currency = array(
        'جنية مصرى'=>'جنية مصرى',
        'دينار عراقى'=>'دينار عراقى',
        'ليرة سورية'=> 'ليرة سورية',
        'ليرة لبنانية'=>'ليرة لبنانية',
        'دينار أردنى'=>'دينار أردنى',
        'ريال سعودى'=>'ريال سعودى',
        'ريال يمنى'=>'ريال يمنى',
        'دينار ليبى'=>'دينار ليبى',
        'جنية سودانى'=>'جنية سودانى',
        'درهم مغربى'=>'درهم مغربى',
        'دينار تونسى'=>'دينار تونسى',
        'دينار كويتى'=>'دينار كويتى',
        'دينار جزائرى'=>'دينار جزائرى',
        'أوقية موريتانية'=>'أوقية موريتانية',
        'دينار بحرينى'=>'دينار بحرينى',
        'ريال قطرى'=>'ريال قطرى',
        'درهم إماراتى'=>'درهم إماراتى',
        'ريال عمانى'=>'ريال عمانى',
        'شلن صومالى'=>'شلن صومالى',
        'جنية فلسطينى'=>'جنية فلسطينى',
        'فرنك جيبوتى'=>'فرنك جيبوتى',
        'فرنك قمرى'=>'فرنك قمرى',
            'دولار أمريكى '=>'دولار أمريكى',
            'يورو'=>'يورو',
            'جنية استرلينى '=>'جنية استرلينى',
            'دولار كندى'=>'دولار كندى',
            'دولار استرالى'=>'دولار استرالى',
            'ين يابانى'=>'ين يابانى',


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
    // all table except co_data
    public static $all_tabels = array(
        'account_trans', 'accounts', 'accounts_balances', 'branches', 'cat','hr_departments', 'hr_desded',
        'hr_empdesded', 'hr_employees', 'hr_jobs', 'hr_loans', 'hr_monthchanges', 'hr_ms_details', 'hr_ms_header', 'items',
        'items_balances', 'marks', 'models', 'seasons', 'trans_details', 'trans_header', 'users',
    );

    public static function statues($start_date,$end_date,$statues){
        // end_date
        // date now

        $date = new DateTime();
        $date_now = $date->format('Y-m-d');

        $end_trial_date = $date->modify('+10 day');
        $end_trial_date = $end_trial_date->format('Y-m-d');

        if($date_now >= $start_date && $date_now  <= $end_trial_date  && $statues == 0 ){
                return 'trial';
        }elseif(  $statues == 1 && $date_now <= $end_date){
            return 'member';
        }elseif($statues == 2 || $date_now > $end_date){
            return 'stopped';
        }else{
            return 'something wrong';

        }
    }
    public function multiDeleteHrMsg($want_to_delete,$count_of_deleted,$name,$cant_delete_group){
        if($count_of_deleted <= 0){
            $i = 0;
            $num_count_of_deleted =$want_to_delete - $count_of_deleted -1;
            $msg = Lang::get('main.the_delete_not_done').Lang::get('main.rows').' '.Lang::get('main.from_rows').'(' .$want_to_delete .')'.Lang::get('main.this_because').
                Lang::get('main.employee_carry_some').' '.$name.' (';
            foreach($cant_delete_group as  $cant_delete){
                $msg .= $cant_delete;

                if($i< $num_count_of_deleted  ){
                    $msg .= ',';
                }
                $i++;
            }
            $msg .= ')' .Lang::get('main.has_selected');
            return $msg;
        }else{
            return  $msg = Lang::get('main.delete_is_done').'(' .$count_of_deleted .')'.Lang::get('main.rows').' '.Lang::get('main.from_rows').'(' .$want_to_delete .')'.Lang::get('main.this_because').Lang::get('main.employee_carry_some').' '.$name.' '.Lang::get('main.has_selected');
        }

    }
        public function multiDeleteDesdedMsg($want_to_delete,$count_of_deleted,$name,$cant_delete_group){
            $num_count_of_deleted =$want_to_delete - $count_of_deleted -1;
            $i = 0;
            if($count_of_deleted <= 0){

            $msg = Lang::get('main.the_delete_not_done').Lang::get('main.rows').' '
                .Lang::get('main.from_rows').'(' .$want_to_delete .')'
                .Lang::get('main.this_because').
                Lang::get('main.employee_desdes_use').' '
                .$name.' '.Lang::get('main.this_note_deleted')
                .' (';
            foreach($cant_delete_group as  $cant_delete){
                $msg .= $cant_delete;

                if($i< $num_count_of_deleted  ){
                    $msg .= ',';
                }
                $i++;
            }
            $msg .= ')';
            return $msg;
        }else{
                 $msg = Lang::get('main.delete_is_done').
                    '(' .$count_of_deleted .')'.Lang::get('main.rows').' '
                    .Lang::get('main.from_rows').'(' .$want_to_delete .')'.Lang::get('main.this_because').
                    Lang::get('main.employee_desdes_use').' '.$name.' '.Lang::get('main.this_note_deleted').' (';
            foreach($cant_delete_group as  $cant_delete){
                $msg .= $cant_delete;

                if($i< $num_count_of_deleted  ){
                    $msg .= ',';
                }
                $i++;
            }
            $msg .= ')';
            return $msg;
        }

    }
    //  multi Delete Product Msg
    public function multiDeleteProductMsg($want_to_delete,$count_of_deleted,$name,$cant_delete_group){
        if($count_of_deleted <= 0){
                $i = 0;
            $num_count_of_deleted =$want_to_delete - $count_of_deleted -1;
               $msg = Lang::get('main.the_delete_not_done').Lang::get('main.rows').' '.Lang::get('main.from_rows').'(' .$want_to_delete .')'.Lang::get('main.this_because').
                Lang::get('main.item_carry_some').' '.$name.' (';
            foreach($cant_delete_group as  $cant_delete){
                $msg .= $cant_delete;

                if($i< $num_count_of_deleted  ){
                    $msg .= ',';
                }
                $i++;
            }
                    $msg .= ')' .Lang::get('main.has_selected');
                return $msg;
        }else{
            return  $msg = Lang::get('main.delete_is_done').'(' .$count_of_deleted .')'.Lang::get('main.rows').' '.Lang::get('main.from_rows').'(' .$want_to_delete .')'.Lang::get('main.this_because').Lang::get('main.item_carry_some').' '.$name.' '.Lang::get('main.has_selected');
        }

    }

    public function multiDelete($table)
    {

        if (in_array($table, ['seasons','marks','models','cat','items','offer'])) {

            $inputs = Input::all();

            // if user not select any check box
            if (!isset($inputs['checkbox'])) {
                Session::flash('error', 'لم يتم تحديد بيانات لحذفها ');
                return Redirect::back();
            }

            $count_of_deleted = 0;
            $want_to_delete   = count($inputs['checkbox']);
            $cant_delete_group     = [];
            // seasons
            if($table == 'seasons') {

                $column     = 'seasons_id';
                $name   = 'المواسم';

            }elseif($table == 'models') {

                $column     = 'models_id';
                $name   = 'الموديلات';
            }elseif($table == 'marks') {

                $column     = 'marks_id';
                $name   = 'الماركات';
            }elseif($table == 'offer') {

                $column     = 'offer_id';
                $name   = 'العروض';
            }elseif($table == 'cat') {

                $column     = 'cat_id';
                $name   = 'فئات الأصناف';
            }
                foreach ($inputs['checkbox'] as $id) {
                    $items = Items::where($column, '=', $id)->company()->first();
                    if(!$items){
                        DB::table($table)->company()->where('id', $id)->delete();
                        $count_of_deleted++;
                    }else{
                        $cant_delete_group[] =  DB::table($table)->company()->where('id', $id)->first()->name;
                    }
                }

                if($count_of_deleted > 0 && $count_of_deleted  == $want_to_delete){
                    $type_of_msg = 'success';
                    $msg = $this->deleteSuccess($name);
                }else{
                    $type_of_msg = 'error';
                    $msg = $this->multiDeleteProductMsg($want_to_delete,$count_of_deleted,$name,$cant_delete_group);
                }

                Session::flash($type_of_msg,$msg);
                return Redirect::back();
            // models


        }else {

            $data['error'] = "هذا الرابط غير صحيح ";
            return View::make('errors.missing', $data);
        }
    }


}