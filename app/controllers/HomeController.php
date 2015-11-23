<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function home()
	{
		return View::make('frontend/index');
	}

	public function confirm($confirm){
		$company = CoData::where('confirmation_code',$confirm)->first();
		if(!$company){
			return View::make('errors.missing');
		}else{
			$company->confirmed = 1;
			$company->confirmation_code = null;
			$company->update();
			Session::flash('success','تم تفعيل الشركة بنجاح');
			return Redirect::route('login');
		}
	}

	public function contactUs(){

		$inputs = Input::all();
		$ruels  = array(
			'name'   =>'required',
			'email'  =>'required|email',
			'subject'=>'required',
			'message'=>'required',
		);
		$validation = Validator::make($inputs, $ruels, BaseController::$messages);
		if ($validation->fails()) {
			return Redirect::to('/#contact')->withInput()->withErrors($validation->messages());
		} else {

			$data['name']     =  HTML::entities($inputs['name']);
			$data['email']    =  HTML::entities($inputs['email']);
			$data['subject']  =  HTML::entities($inputs['subject']);
			$data['messages'] =  HTML::entities($inputs['message']);

			Mail::send('emails.users_messages', $data, function($message){
			$message->to('elrased.web@gmail.com')->subject('message from elrased web |'.Input::get('subject'));
		});

			if(count(Mail::failures()) > 0){
				Session::flash('error','عفواً لم يتم إرسال الرسالة .. يرجى المحاولة مرة أخرى ');
				return Redirect::to('/#contact');
			}else{
				Session::flash('success','تم إرسال الرسالة بنجاح');
				return Redirect::to('/#contact');
			}
		}
	}


}
