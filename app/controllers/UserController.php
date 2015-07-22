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
    public function checkLogin()
    {
        $rules = array(
            'password'=> 'required',
            'username'=> 'required',
        );
        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $username   = Input::get('username');
            $password   = Input::get('password');
            if(Auth::attempt(array('username'=>$username,'password'=>$password)))
            {
                Session::put('permissions', json_decode(Auth::user()->permission,true));
                $user = User::find(Auth::id());
                $user->session_id =  Session::getId();
                $user->update();
                return Redirect::intended('admin');
            }else{
                Session::flash('error','هذه البيانات غير صحيحه');
                return Redirect::to('/login');
            }

        }
    }

    public  function addUser()
    {
        $data['company'] = CoData::find(Auth::user()->co_id);
        $data['button']  = 'اضف';
        $data['title']  = ' اضف مستخدم';
        return View::make('dashboard.add_user',$data);
    }
    public  function storeUser()
    {
        $validation = Validator::make(Input::all(), User::$store_rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            $newUser = new User;
            $newUser->co_id = Auth::user()->co_id;
            $newUser->br_code = Input::get('br_code');
            $newUser->id =  User::max('id')+1 ;
            $newUser->all_br = Input::get('all_br');
            $newUser->name = Input::get('name');
            $newUser->username = Input::get('username');
            $newUser->password = Hash::make(Input::get('password'));
            $newUser->email = Input::get('email');
            $newUser->save();
            return Redirect::route('addUser');
        }
    }
    public  function editUser($id)
    {
        $data['company'] = CoData::find(Auth::user()->co_id);
        $data['user']    = $data['company']->users()->where('id','=',$id)->first();;
        $data['button']  = 'تعديل';
        $data['title']  = '  تعديل مستخدم';
        if ($data['user'])
        {
            return View::make('dashboard.add_user',$data);
        }else{
            return 'user not found !!';
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
                $oldUser->br_code = Input::get('br_code');
                $oldUser->all_br = Input::get('all_br');
                $oldUser->name = Input::get('name');
                $oldUser->username = Input::get('username');
                $oldUser->password = Hash::make(Input::get('password'));
                $oldUser->email = Input::get('email');
                $oldUser->update();
            }
            return Redirect::route('addUser');
        }else{
            return "there ara no user ";
        }
    }
}