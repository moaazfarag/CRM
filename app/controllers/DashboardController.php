<?php

class dashboardController extends BaseController {

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
		$data['title']  = 'الصفحة الرئيسية ';
		$data['topics']    = Topic::company()->orderBy('id', 'DESC')->paginate(10) ;
		$data['home_page'] = Home::company()->first();
		return View::make('dashboard.home.home',$data);
	}

	public function editHome(){
		$data['home_page'] = Home::company()->first();
		return View::make('dashboard.home.edit_home', $data);

	}



	public function addTopic()
	{
		$data['types'] = array(
				'default'	=> Lang::get('main.default_message'),
				'done'		=> Lang::get('main.done_message'),
				'warning'	=> Lang::get('main.warning_message'),
				'error'		=> Lang::get('main.error_message'),
		);
		$data['title']  = 'إضافة موضوع جديد';
		$data['tablesData'] =  Topic::company()->get();
		return View::make('dashboard.home.add_topic',$data);
	}
	public function editTopic($id)
	{
		$data['types'] = array(
				'default'	=> Lang::get('main.default_message'),
				'done'		=> Lang::get('main.done_message'),
				'warning'	=> Lang::get('main.warning_message'),
				'error'		=> Lang::get('main.error_message'),
		);
		$data['title']  = 'تعديل موضوع';
		$topic =  Topic::company()->where('id',$id)->first();
		$data['tablesData'] =  Topic::company()->get();
		if(empty($topic)){
			session::flash('error','الموضوع المراد تعديلة غير موجود ');
			return Redirect::route('addTopic',$data);
		}else{
			$data['topic'] = $topic;
			return View::make('dashboard.home.add_topic',$data);
		}

	}

	public function storeTopic(){

		$inputs = Input::all();
		$validation = Validator::make($inputs,Topic::$topic_ruels,BaseController::$messages);
		if($validation->fails()){

			return Redirect::back()->withInput()->withErrors($validation->messages());

		}else {

			$topic = new Topic;
			$topic->title   = $inputs['title'];
			$topic->content = $inputs['content'];
			$topic->type    = $inputs['type'];
			$topic->co_id   = Auth::user()->co_id;
			$topic->user_id = Auth::user()->id;

		}

			if($topic->save()){
					Session::flash('success',BaseController::addSuccess('الموضوع'));
					return Redirect::route('addTopic');
			}else{
					Session::flash('error',BaseController::addError('الموضوع'));
					return Redirect::route('addTopic');

			}

		}

	public function updateTopic($id){

		$inputs = Input::all();
		$validation = Validator::make($inputs,Topic::$topic_ruels,BaseController::$messages);
		if($validation->fails()){

			return Redirect::back()->withInput()->withErrors($validation->messages());

		}else {

			$topic = Topic::find($id);

			if(empty($topic)){
				Session::flash('error',BaseController::editError('الموضوع'));
				return Redirect::route('addTopic');
			}
			$topic->title   = $inputs['title'];
			$topic->content = $inputs['content'];
			$topic->type    = $inputs['type'];
			$topic->co_id   = Auth::user()->co_id;
			$topic->user_id = Auth::user()->id;

		}

		if($topic->update()){
			Session::flash('success',BaseController::editSuccess('الموضوع'));
			return Redirect::route('addTopic');
		}else{
			Session::flash('error',BaseController::editError('الموضوع'));
			return Redirect::route('addTopic');

		}
	}


	public function deleteTopic($id){

		$topic = Topic::find($id);
		if(empty($topic)){
			Session::flash('error',BaseController::deleteError('الموضوع'));
			return Redirect::route('addTopic');
		}

		$topic->delete();
		Session::flash('success',BaseController::deleteSuccess('الموضوع'));
		return Redirect::route('addTopic');
	}

	public function updateHome($type){

		  if($type == 'header'){
			$ruels = Home::$header_ruels;
		}elseif($type == 'about_us'){
			 $ruels = Home::$about_us_ruels;

		 }elseif($type == 'sochial'){
			 $ruels = Home::$sochial_ruels;

		 }elseif($type == 'email'){
			 $ruels = Home::$email_ruels;

		 }
		$inputs = Input::all();
		$validation = Validator::make($inputs,$ruels,BaseController::$messages);
		if($validation->fails()){

			return Redirect::back()->withInput()->withErrors($validation->messages());

		}else {

			$home_page = Home::company()->first();
			if($type == 'header'){
				$home_page->title = $inputs['title'];
				$home_page->details = $inputs['details'];
			}elseif($type == 'about_us'){
				$home_page->about = $inputs['about'];
				$home_page->about_content = $inputs['about_content'];

			}elseif($type == 'sochial'){
				$home_page->facebook = $inputs['facebook'];
				$home_page->twitter = $inputs['twitter'];
				$home_page->google = $inputs['google'];
				$home_page->youtube = $inputs['youtube'];
				$home_page->linkedin = $inputs['linkedin'];
				$home_page->instgram = $inputs['instgram'];

			}elseif($type == 'email'){
				$home_page->email = $inputs['email'];

			}

			if($home_page->update()){
				Session::flash('success',BaseController::editSuccess('البيانات'));
			}else{
				Session::flash('error',BaseController::editError('البيانات'));
			}

			$data['home_page'] = Home::company()->first();
			return View::make('dashboard.home.edit_home', $data);
		}



	}

	public function sendMailForAdmin(){

		$inputs = Input::all();
		$ruels  = array(
				'message'=>'required',
		);
		$validation = Validator::make($inputs, $ruels, BaseController::$messages);
		if ($validation->fails()) {
			return Redirect::to('/#contact')->withInput()->withErrors($validation->messages());
		} else {
			if(!Auth::check()){
				return Redirect::route('/');
			}
			$data['name']     =  Auth::user()->username;
			$data['email']    =  Auth::user()->email;
			$data['subject']  =  'رسالة من موقع الراصد لإدارة المحلات والشركات من المستخدم '. Auth::user()->username;
			$data['messages'] =  HTML::entities($inputs['message']);
			Mail::send('emails.admin_messages', $data, function($message){
				$message->to(Home::company()->first()->email)->subject('message from elrased web |'.Input::get('subject'));
			});

			if(count(Mail::failures()) > 0){
				Session::flash('error','عفواً لم يتم إرسال الرسالة .. يرجى المحاولة مرة أخرى ');
				return Redirect::to('/admin');
			}else{
				Session::flash('success','تم إرسال الرسالة بنجاح');
				return Redirect::to('/admin');
			}
		}
	}

    public function createSetting()
	{
		return View::make('dashboard.setting');
	}
    public function manageProduct()
	{
		return View::make('dashboard.product_home');
	}
    public function accounts()
	{
		return View::make('dashboard.accounts_home');
	}
    public function hr()
	{
		return View::make('dashboard.hr_home');
	}


}
