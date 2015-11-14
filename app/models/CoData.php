<?php


class CoData extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'co_data';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    public function formattedCreatedDate()
    {
        if ($this->created_at->diffInDays() > 15)
        {
            return  $this->created_at->toFormattedDateString();
        } else {
            return $this->created_at->diffForHumans();
        }
    }

    public function branches()
    {
        return $this->hasMany('Branches','co_id');
    }

    public function cat()
    {
        return $this->hasMany('Category','co_id');
    }

    public function seasons()
    {
        return $this->hasMany('Seasons','co_id');
    }

    public function marks()
    {
        return $this->hasMany('Markes','co_id');
    }

    public function models()
    {
        return $this->hasMany('Models','co_id');
    }

    public function items()
    {
        return $this->hasMany('Items','co_id')->where('deleted','=',0);
    }

    public function accounts()
    {
        return $this->hasMany('Accounts','co_id');
    }

    public function users()
    {
        return $this->hasMany('User','co_id');
    }

    public function employees()
    {
        return $this->hasMany('Employees','co_id');
    }

    public function departments()
    {
        return $this->hasMany('Department','co_id');
    }


    public function jobs()
    {
        return $this->hasMany('Job','co_id');
    }
    public function loans()
    {
        return $this->hasMany('Loans','co_id');
    }
    public function desded()
    {
        return $this->hasMany('Deduction','co_id');
    }
    public function employee_ded()
    {
        return $this->hasMany('EmployeeDeduction','co_id');
    }
    public function month_change()
    {
        return $this->hasMany('MonthChange','co_id');
    }

    public static $store_company = array(

        'co_name'    => 'required',
        'co_address' => 'required',
        'co_tel'     => 'required',
//        'username'  => 'required|unique:users,username,co_id',
        'password'   => 'required',
        'email'     => 'required|email|unique:users',
        'password_confirm' =>'required|same:password',
    );

    public static $edit_company = array(

        'co_name'         => 'required',
        'co_address'      => 'required',
        'co_tel'          => 'required',
        'co_currency'     => 'required',
        'co_print_size'   => 'required',
        'co_logo'         => 'image|between:1,1000|mimes:jpeg,jpg,png,gif',

    );

    public static $company_earnings = array(

        'date_from'    => 'required',
        'date_to'      => 'required',

    );

    public function ownerEmail(){
        @$users = User::where('co_id',$this->id)->where('owner','acount_creator')->first()->email;
        return $users;
    }
    public function countUsers(){
        $users = User::where('co_id',$this->id)->get();
        return count($users);
    }

    public function lastLoginUsers(){
        $last_login = User::where('co_id',$this->id)->max('updated_at');

        return $last_login;
    }
    public function countBranches(){
        $branches = Branches::where('co_id',$this->id)->get();
        return count($branches);
    }


}
