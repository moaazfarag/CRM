<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/7/2015
 * Time: 2:49 PM
 */
class UserController extends BaseController
{
    public function logout()
    {
        $user = User::find(Auth::id());
        $user->session_id =  0;
        $user->update();
        Session::flush();
        Auth::logout();
        return Redirect::to('/login');
    }
    /*
     * check login
     * */
    public function checkLogin($co_id=null)
    {
        $rules = array(
                        'password'=> 'required',
                        'username'=> 'required',
                        'co_id'=> 'required',
                      );
        $validator=Validator::make(Input::all(),$rules,BaseController::$messages);

        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $username   = Input::get('username');
            $password   = Input::get('password');
            $co_id      = (Input::has('co_id'))?Input::get('co_id'):$co_id;
            if(Auth::attempt(array('username'=>$username,'password'=>$password,'co_id'=>$co_id)))
            {
                Session::put('permissions', json_decode(Auth::user()->permission,true));
                $user = User::find(Auth::id());
                $user->session_id =  Session::getId();
                $user->update();
                return Redirect::intended('admin/setting');
            }else{
                $error=Lang::get('main.error');
                Session::flash('error',$error);
                return Redirect::to('/login');
            }

        }
    }

    public  function addUser()
    {
        $add=Lang::get('main.add');
        $addUser=Lang::get('main.addUser');
        $data['company'] = CoData::find(Auth::user()->co_id);
        $data['button']  = $add;
        $data['asideOpen']   = 'open' ;
        $data['title']  = $addUser;
        return View::make('dashboard.users.index',$data);
    }
    public  function storeUser()
    {
        $validation = Validator::make(Input::all(), User::$store_rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            $newUser = new User;
            $newUser->co_id = Auth::user()->co_id;
            $data['asideOpen']   = 'open' ;
            $newUser->br_id = Input::get('br_id');
            $newUser->id =  User::max('id')+1 ;
            $newUser->all_br = Input::get('all_br');
            $newUser->name = Input::get('name');
            $newUser->username = Input::get('username');
            $newUser->password = Hash::make('12345678');
            $newUser->email = Input::get('email');
            $newUser->save();
            return Redirect::route('addUser');
        }
    }
    public  function editUser($id)
    {
        $edit=Lang::get('main.edit');
        $editUser=Lang::get('main.editUser');
        $data['company'] = CoData::find(Auth::user()->co_id);
        $data['user']    = $data['company']->users()->where('id','=',$id)->first();;
        $data['button']  =$edit;
        $data['title']  = $editUser;
        if ($data['user'])
        {
            return View::make('dashboard.users.index',$data);
        }else{

        $data['error']      ="هذا المستخدم غير موجود";
        return View::make('errors.missing',$data);
    }


    }
    public  function updateUser($id)
    {
        $data['company'] = CoData::find(Auth::user()->co_id);
        $oldUser         = $data['company']->users()->where('id','=',$id)->first();
        if($oldUser) {
            $rules_update = array(
                'password'         => 'min:8',
                'username'         => 'required|unique:users,username,' . $id,
                'name'             => 'required',
                'email'            => 'required|email|unique:users,email,' . $id,
                'confirm_password' => 'same:password',
            );
            $validation = Validator::make(Input::all(), $rules_update);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            } else {
                $oldUser->co_id = Auth::user()->co_id;
                $oldUser->br_id = Input::get('br_id');
                $oldUser->all_br = Input::get('all_br');
                $oldUser->name = Input::get('name');
                $oldUser->username = Input::get('username');
                $oldUser->password = Hash::make(Input::get('password'));
                $oldUser->email = Input::get('email');
                $oldUser->update();
            }
            return Redirect::route('addUser');
        }else{

            $data['error']      ="هذا المستخدم غير موجود";
            return View::make('errors.missing',$data);        }
    }

    //set_password
    public  function set_password() {
        return View::make('dashboard.users.set_password');
    }
    public  function storeNewPassword()
    {


            $rules_update = array(

                'old_password'    => "required|min:6",
                'new_password'         => 'required|min:6',
                'confirm_new_password' => 'required|same:new_password',
            );

            $validation = Validator::make(Input::all(), $rules_update,BaseController::$messages);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            } else {
                $old_user   = User::find(Auth::user()->id);

                $old_password_from_user    = Hash::make(Input::get('old_password'));
                $old_password_from_db      = $old_user->password;
                if(Hash::check(Input::get('old_password'), $old_user->getAuthPassword())){
                    $old_user->co_id = Auth::user()->co_id;
                    $old_user->password = Hash::make(Input::get('new_password'));
                    $old_user->update();
                    Session::flash('success','تم تغيير كلمة المرور بنجاح');
                    return Redirect::back();
                }else{
                    return $old_password_from_db .'<br/>'.$old_password_from_user;

                    Session::flash('error','عفواً كلمة المرور القديمة غير صحيحة');
                    return Redirect::back();

            }

        }
    }
}