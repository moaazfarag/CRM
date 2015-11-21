<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		switch ($response = Password::remind(Input::only('email')))
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', 'هذا البريد الألكترونى غير مسجل لدينا ');

			case Password::REMINDER_SENT:
				return Redirect::back()->with('success', 'تم إرسال رابط تغيير كلمة المرور إلى البريد الألكترونى الخاص بك ');
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{

		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
				return Redirect::back()->with('error','كلمتا السر غير متطابقتان');
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', 'لا يمكنك تغيير كلمة المرور الان ');

			case Password::PASSWORD_RESET:
				Session::flash('success_set_password','تم تغيير كلمة المرور بنجاح ');
				return Redirect::to('/login');
		}
	}

}
