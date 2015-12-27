<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/7/2015
 * Time: 2:49 PM
 */
class UserController extends BaseController
{
    public static function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect::to('/login');
    }

    public function logOutManagement()
    {
        Session::flush();
        Auth::logout();
        return Redirect::to('/login-management');
    }

    /*
     * check login
     * */
    public function checkLogin($co_id = null)
    {
        $rules = array(
            'username' => 'required',
            'password' => 'required',
            'co_id'    => 'required|integer',
        );
        if($co_id) {
            $rules = array(
                'username' => 'required',
                'password' => 'required',
            );
        }

        $validator = Validator::make(Input::all(), $rules, BaseController::$messages);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $username = Input::get('username');
            $password = Input::get('password');
            $co_id    = (Input::has('co_id')) ? Input::get('co_id') : $co_id;

            $company = CoData::find($co_id);
            $user    = User::where('username',$username)->first();

            if(empty($user) || empty($company)||  !Hash::check($password,$user->password) ){


                $error = Lang::get('main.error');
                Session::flash('error', $error);
                return Redirect::to('/login');
            }

            if($company->co_statues == 2 || BaseController::statues($company->created_at,$company->co_expiration_date,$company->co_statues) == 'stopped'  ){

                   return Redirect::route('trialEnd');
               }

                if($company->confirmed != 1){

                    return Redirect::route('notConfirmed');
                }

                if($user->deleted == 1){

                    Session::flash('error',  'عفواً تم حذف هذا المستخدم ');
                    return Redirect::to('/login');                }

                if (Auth::attempt(array('username' => $username, 'password' => $password, 'co_id' => $co_id))) {

                        if(Auth::user()->owner == 'acount_creator'){
                             Session::put('permission',PermissionController::setPermission(1));
                        }else{

                            Session::put('permission', json_decode(Auth::user()->permission, true));
                        }
                    $user = User::find(Auth::id());
                    Session::put('last_login',$user->updated_at->format('d M Y - H:i:s'));
                    return Redirect::intended('/admin');
                } else {

                $error = Lang::get('main.error');
                Session::flash('error', $error);
                return Redirect::to('/login');
                 }



        }

    }

    public function checkLoginManagement (){

        $rules = array(
                'username' => 'required',
                'password' => 'required',
            );
        $validator = Validator::make(Input::all(), $rules, BaseController::$messages);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $username = Input::get('username');
            $password = Input::get('password');

            if (Auth::attempt(array('username' => $username, 'password' => $password, 'co_id' => '0'))) {
                return Redirect::intended('management');
            } else {

                $error = Lang::get('main.error');
                Session::flash('error', $error);
                return Redirect::to('/login-management');
            }

        }
    }
    public function addUser()
    {
        $add                      = Lang::get('main.add');
        $addUser                  = Lang::get('main.addUser');
        $data['suspended']        = User::where('deleted',1)->where('username','!=','')->company()->get();
        $data['company']          = CoData::find(Auth::user()->co_id);
        $data['button']           = $add;
        $data['groupPermissions'] = PermissionController::setPermission();
        $data['group']            = ['add_all', 'edit_all', 'delete_all', 'show_all'];
        $data['asideOpen']        = 'open';
        $data['title']            = $addUser;

        return View::make('dashboard.users.index', $data);
    }

    public function storeUser()
    {
        $inputs = Input::all();
        $user_rules = array(
        'username'  => 'unique:users,username,NULL,id,co_id,'.Auth::user()->co_id ,
        'name'      => 'required',
        'br_id'     => 'required',
    );
        $permissions = PermissionController::setPermission();
        $validation = Validator::make(Input::all(), $user_rules,BaseController::$messages);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $newUser                = new User;
            $newUser->id            = User::max('id') + 1;
            $newUser->co_id         = Auth::user()->co_id;
            $newUser->br_id         = ($inputs['br_id'] == 'all')?0:$inputs['br_id'];
            $newUser->all_br        = ($inputs['br_id'] == 'all')?1:0;
            $newUser->name          = $inputs['name'];
            $newUser->username      = $inputs['username'];
            $newUser->password      = Hash::make('12345678');
            $newUser->email         = Input::get('email');
            $newUser->deleted         = 0;
            $newUser->permission    = json_encode($permissions);

            $newUser->save();

            return Redirect::route('addUserSuccess',array($newUser->name,$newUser->username));
        }
    }
    public function addUserSuccess($name,$user_name){

        $data['asideOpen']  = 'open';
        $data['name']       = $name;
        $data['user_name']  = $user_name;
        return View::make('dashboard.users.add_user_success',$data);
    }
    public function editUser($id)
    {
        $edit               = Lang::get('main.edit');
        $editUser           = Lang::get('main.editUser');
        $data['suspended']        = User::where('deleted',1)->where('username','!=','')->company()->get();
        $data['company']    = CoData::find(Auth::user()->co_id);
        $data['user']       = $data['company']->users()->where('id', '=', $id)->first();
        $data['group']      = ['add_all', 'edit_all', 'delete_all', 'show_all'];
        $data['asideOpen']  = 'open';
        $data['button']     = $edit;
        $data['title']      = $editUser;

        if ($data['user']->permission) {
            $array = json_decode($data['user']->permission, true);
            if (count($array)>0){
                $data['groupPermissions'] = array_replace_recursive(PermissionController::setPermission(), $array);
            }else{
                $data['groupPermissions'] = PermissionController::setPermission();
            }
        } else {
            $data['groupPermissions'] = PermissionController::setPermission();
        }

        if ($data['user']) {
            return View::make('dashboard.users.index', $data);
        } else {

            $data['error'] = "هذا المستخدم غير موجود";
            return View::make('errors.missing', $data);
        }


    }

    public function updateUser($id)
    {

        $data['company'] = CoData::find(Auth::user()->co_id);
        $oldUser         = $data['company']->users()->where('id', '=', $id)->first();
        $permissions     = PermissionController::setPermission();

        if ($oldUser) {

            $user_rules = array(
                'name'      => 'required',
                'br_id'     => 'required',
            );

            $validation = Validator::make(Input::all(), $user_rules);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }
                $inputs              = Input::all();
                $oldUser->co_id      = Auth::user()->co_id;
                $oldUser->br_id      = ($inputs['br_id'] == 'all')?0:$inputs['br_id'];
                $oldUser->all_br     = ($inputs['br_id'] == 'all')?1:0;
                $oldUser->name       = Input::get('name');
                $oldUser->permission = json_encode($permissions);

                if(isset($inputs['reset_password'])){
                    $oldUser->password = Hash::make('12345678');
                }

                $oldUser->update();

                Session::flash('success','تم تعديل بيانات المستخدم بنجاح');
                return Redirect::route('addUser');
        } else {

            $data['error'] = "هذا المستخدم غير موجود";
            return View::make('errors.missing', $data);
        }

    }

    //set_password
    public function set_password()
    {
        return View::make('dashboard.users.set_password');
    }

    /**
     * set new password for user has Auth
     * @return mixed
     */
    public function storeNewPassword()
    {
        $oldUser = User::find(Auth::id());
        if ($oldUser) {
            $rules_update = array(

                'old_password' => "required",
                'new_password' => 'required|min:8',
                'confirm_new_password' => 'required|same:new_password',

            );
            $validation = Validator::make(Input::all(), $rules_update, BaseController::$messages);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            } else {
                $old_user = User::find(Auth::user()->id);
                if (Hash::check(Input::get('old_password'), $old_user->getAuthPassword())) {

                    $old_user->co_id    = Auth::user()->co_id;
                    $old_user->password = Hash::make(Input::get('new_password'));
                    $old_user->update();
                    Session::flash('success','تم  تغيير كلمة المرور بنجاح');
                    return Redirect::back();
                } else {
//                    return $old_password_from_db . '<br/>' . $old_password_from_user;

                    Session::flash('error', 'كلمة المرور القديمة غير صحيحة ');
                    return Redirect::back();

                }
            }
        }
    }
    public function suspendUser($id)
    {
        $user = User::where('id',$id)->company()->first();
        if(!empty($user)){
//                     $user->username = '';
            $user->deleted  = 1 ;
            $user->update();

            Session::flash('success','تم إيقاف المستخدم بنجاح');
            return Redirect::back();
        }else{
            Session::flash('error','عفواً لم يتم إيقاف المستخدم حاول مرة أخرى ');
            return Redirect::back();
        }
    }

   public function returningUser($id)
   {
    $user = User::where('id',$id)->company()->first();
    if(!empty($user)){
//                     $user->username = '';
        $user->deleted  = 0 ;
        $user->update();

        Session::flash('success','تم تفعيل المستخدم بنجاح');
        return Redirect::back();
    }else{
        Session::flash('error','عفواً لم يتم تفعيل المستخدم حاول مرة أخرى ');
        return Redirect::back();
    }
}


    public function finaDeleteUser($id)
    {
        $user = User::where('id',$id)->company()->first();
        if(!empty($user)){
                     $user->username = null;
                     $user->deleted  = 1 ;
                     $user->update();

                    Session::flash('success','تم حذف المستخدم بنجاح');
                    return Redirect::back();
                }else{
                     Session::flash('error','عفواً لم يتم حذف المستخدم حاول مرة أخرى ');
                     return Redirect::back();
            }
    }
}