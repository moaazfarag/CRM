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
}