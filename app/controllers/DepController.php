<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/10/2015
 * Time: 3:46 PM
 */
class DepController extends BaseController
{

    /**
     * return view of add form
     * @return mixed
     */
    public function addDep()
    {
        $data = $this->depData();
//        $data['catActive'] = "active";
        return View::make('dashboard.deps',$data);
    }

    /**
     * add new season to database
     */
    public function storeDep()
    {
        $dep           = new Dep ;
        $dep->depName     = Input::get('depName');
        $dep->co_id    = Auth::user()->co_id; // company id
        $dep->user_id  = Auth::id();// user who add this record
        $dep->save();
        return Redirect::route('addDep');
    }

    public function editDep($id)
    {
        //dd('saddsa');
        $data = $this->depData();
//        $data['catActive'] = "active";
        $data['editDep']  = Dep::findOrFail($id);
        return View::make('dashboard.deps',$data);

    }
    public function updateDep($id)
    {
        $dep           = Dep::findOrFail($id) ;
        $dep->depName = Input::get('depName'); //season name from input
        $dep->co_id    = Auth::user()->co_id; // company id
       $dep->user_id  = Auth::id();// user who add this record
        $dep->update();
        return Redirect::route('addDep');

    }

    /**
     * data will use in season
     * @return mixed
     */
    protected function depData()
    {
        $parts                    =Lang::get('main.parts');
        $data['title']              = $parts;
//        $data['activeModelNav']     = "active";
//        $data['catFunName']         = "editDep";
//        $data['seasonInputName']    = "seasons";
        $data['employees']          = 'open' ;
        $data['modelMini']          = "";
        $data['arabicName']         = $parts;
        $data['tablesData']         = Dep::where('co_id','=',$this->coAuth())->get();
        return $data;
    }
}