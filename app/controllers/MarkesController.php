<?php

class MarkesController extends \BaseController {

	protected function markData()
	{
		$itemCat                    =Lang::get('main.markCat');
		$data['catFunName']         = "editMark";
		$data['title']              = $itemCat;
		$data['asideOpen']          = 'open' ;
		$data['modelMini']          = "";
		$data['tablesData']         = Markes::all();
		return $data;
	}


	public function addMark(){

		$data = $this->markData();

		return View::make('dashboard.product_markes',$data);
	}


	public function storeMark(){

		$mark = new Markes;
		$mark->name = Input::get('name');
		$mark->co_id    = Auth::user()->co_id; // company id
		$mark->user_id  = Auth::id();// user who add this record
		$mark->save();
		return Redirect::route('addMark');
	}


	public function editMark($id){
		//dd('saddsa');
		$data = $this->markData();
		$data['catActive'] = "active";
		$data['editMark']  = Markes::findOrFail($id);
		return View::make('dashboard.product_markes',$data);
	}

	public function updateMark($id)
	{
		$mark            = Markes::findOrFail($id) ;

		$mark->name      = Input::get('name');
		$mark->co_id     = Auth::user()->co_id; // company id
		$mark->user_id   = Auth::id();// user who add this record

		$mark->update();

		return Redirect::route('addMark');

	}


	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
