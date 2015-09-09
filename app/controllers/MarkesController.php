<?php

class MarkesController extends \BaseController
{

	protected function markData()
	{
		$itemCat = Lang::get('main.markCat');
		$data['catFunName'] = "editMark";
		$data['title'] = $itemCat;
		$data['asideOpen'] = 'open';
		$data['modelMini'] = "";
		$data['tablesData'] = Markes::company()->get();

		return $data;
	}

	public function addMark()
	{
		$company_info  = DB::table('co_data')
			->join('branches', 'co_data.id', '=', 'branches.co_id')
			->join('items','co_data.id', '=', 'items.co_id')
			->where('co_data.id',$this->coAuth())
			->select('co_data.co_name AS company_name','co_data.co_address AS company_address','branches.br_name AS branch_name','branches.br_address AS branch_address')
			->get();


		foreach($company_info as $info){

			echo 'اسم الشركة : ' . $info->company_name;
			echo 'اسم الفرع: ' . $info->branch_name;

		}
//		foreach ($test as $t){
//			echo $t->name;
//			echo '<br/>';
//	}
//	dd($company);


		$data = $this->markData();

		return View::make('dashboard.products.markes.index', $data);
	}


	public function storeMark()
	{

		$mark = new Markes;
		$mark->true_id    = BaseController::maxId($mark);
		$mark->name = Input::get('name');
		$mark->co_id = Auth::user()->co_id; // company id
		$mark->user_id = Auth::id();// user who add this record
		$mark->save();
		return Redirect::route('addMark');
	}


	public function editMark($id)
	{
		//dd('saddsa');
		$data = $this->markData();
		$data['catActive'] = "active";
		$data['editMark'] = Markes::findOrFail($id);
		return View::make('dashboard.products.markes.index', $data);
	}

	public function updateMark($id)
	{
		$mark = Markes::findOrFail($id);

		$mark->name = Input::get('name');
		$mark->co_id = Auth::user()->co_id; // company id
		$mark->user_id = Auth::id();// user who add this record

		$mark->update();

		return Redirect::route('addMark');

	}

	public function deleteMark($id)
	{

		$markes = Markes::find($id)->company()->first();
		$model = DB::table('models')->company()->where('marks_id', '=', $id)->first();
//		$items =  DB::table('items')->company()->where('marks_id', '=', $id)->first();

//		var_dump($markes);
//		echo '<br/>';
//		var_dump($model);
//		echo '<br/>';
//
//		die();

		if (!empty($markes)) {

			if (!empty($model)) {



				Session::flash('error', 'لا يمكن حذف الماركة  لأنها تحتوى على موديلات  ');
				return Redirect::back();

//			} elseif (!empty($items)) {
//
//				Session::flash('error', 'لا يمكن الحذف ...   هناك أصناف تحمل اسم هذا الماركة ');
//				return Redirect::back();
//			}


			} else {

				$markes->delete();
				$edit_ids = BaseController::editIds('marks','Markes','true_id');
				if($edit_ids) {
					Session::flash('success', 'تم حذف الماركة بنجاح ');
					return Redirect::back();
				}
			}
		}
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
