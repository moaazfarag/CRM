<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/7/2015
 * Time: 3:15 PM
 */
class BranchController extends  BaseController
{
    /**
     * create add branch view
     * @return mixed
     *
     */

    public  function addBranch()
    {
        $data = $this->settingData();
        $data['miniBranch']  = "" ;
        $data['currency'] = BaseController::$currency;
        $data['print_size_types'] = array(

            "A3"=>"A3",
            "A4"=>"A4",
            "A5"=>"A5",

        );
        return View::make('dashboard.company.index', $data);
    }
        /**
     * store new  branch into database
     * @return mixed
     *
     */
    public  function storeBranch()
    {
        $validation = Validator::make(Input::all(), Branches::$store_rules, BaseController::$messages);

        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }
        $branch             = new Branches; //object from branch will add
        $branch->true_id    = BaseController::maxId($branch);
        $branch->br_name    = Input::get('branch_name');
        $branch->br_address = Input::get('branch_address');
        $branch->user_id    = Auth::id();  // id of user  who add  this branch
        $branch->co_id      = Auth::user()->co_id;// id of company related this branch

       if($branch->save()){

           Session::flash('success_br',BaseController::addSuccess('الفرع'));

       }else{
           Session::flash('error_br',BaseController::addError('الفرع'));

       }
//        return Redirect::back();
        

        return Redirect::route('addBranch');
    }
    /**
     * create edit branch view
     * @return mixed
     *
     */
    public  function editBranch()
    {
        $id                  = Input::get('br_id');
        $data                = $this->settingData(); //company info data
        $data['print_size_types'] = array(

            "A3"=>"A3",
            "A4"=>"A4",
            "A5"=>"A5",

        );
        $data['currency'] = BaseController::$currency;
        $data['branch']      = Branches::company()->where('deleted',0)->where('id',$id)->first(); //get branch will update
        $data['miniBranch']  = "" ; //to maxmize  branch card in view
        return View::make('dashboard.company.index', $data);
    }

    /**
     * update branch into database
     * @param $id of branch
     * @return mixed
     */
    public  function updateBranch($id)
    {
        //d(Input::get('branch_name') );
        $branch             =  Branches::findOrFail($id); //object from branch will update
        $branch->br_name    = Input::get('branch_name');
        $branch->br_address = Input::get('branch_address');
        $branch->user_id    = Auth::id(); // id of user  who update this branch
        $branch->co_id      = Auth::user()->co_id; // id of company related this branch
        if($branch->update()){

            Session::flash('success_br',BaseController::editSuccess('الفرع'));
        }else{
            Session::flash('error_br',BaseController::editError('الفرع'));

        }
        return Redirect::route('addBranch');
//        return Redirect::route('editBranch',array("br_id"=>$branch->id));
    }

    public function deleteBranch($id){

        $branch = Branches::company()->where('id',$id)->first();
        if(!$branch){
            Session::flash('error','الفرع المراد حذفة غير موجود ');
            return Redirect::back();
        }
        $balances      =  DB::table('items_balance')
            ->company()
            ->groupBy('br_id')
            ->groupBy('item_id')
            ->where('br_id',$id)
            ->select(DB::raw('SUM(item_bal) AS balance') ,'items_balance.*')
            ->get();
        if(count($balances)){
            $data['branch_name']        = $branch->br_name;
            $data['branch_delete_id']   = $branch->id;
            $branches                   = Branches::company()->whereNotIn('id',[$id])->where('deleted',0)->get();
            if(count($branches)){
                $data['all_branches']   = Branches::company()->whereNotIn('id',[$id])->where('deleted',0)->get()->lists('br_name','id');
            }else{

                Session::flash('error_br','لا يمكنكم حذف الفرع .. لإتمام عملية الحذف يرجى إنشاء فرع جديد والمحاولة مرة أخرى');
                return Redirect::route('addBranch');
            }

            return View::make('dashboard.company.delete_branch',$data);
        }else{
            $delete_branch = Branches::company()->find($id);
            $delete_branch->deleted = 1;
            $delete_branch->update();
            Session::flash('success_br','تم حذف الفرع بنجاح');
            return Redirect::route('addBranch');
        }

//        if(count($branches)){ $data['all_branches'] =  Branches::company()->whereNotIn('id',[$id])->where('deleted',0)->get()->lists('br_name','id'); }else{ $data['all_branches'] = array(); }

    }

   public function cutBalance(){

       $inputs        = Input::all();
       $branch_from   = $inputs['branch_from'];
       $branch_to     = $inputs['branch_to'];
       $delete_branch = 1;
       $date = new DateTime();
       $balances      =  DB::table('items_balance')
           ->company()
           ->groupBy('br_id')
           ->groupBy('item_id')
           ->where('br_id',$branch_from)
           ->select(DB::raw('SUM(item_bal) AS balance') ,'items_balance.*')
            ->get();
       if(count($balances)){
           foreach($balances as $k=>$balance){

            $inputs['id_'.$k]         = $balance->item_id;
            $inputs['quantity_'.$k]   = $balance->balance;
            $inputs['serial_'.$k]     = $balance->has_serial;

           }

           $inputs['date'] = $date->format("Y-m-d");
           $trans = new TransController;
           $settle_down = $trans->storeTrans('settleDown',$branch_from,$inputs,$delete_branch);
           if($settle_down){
               $settle_add = $trans->storeTrans('settleAdd',$branch_to,$inputs,$delete_branch);
               if($settle_add){
                   $delete_branch = Branches::company()->find($branch_from);
                   $delete_branch->deleted = 1;
                   $delete_branch->update();
                   Session::flash('success_br','تم حذف الفرع بنجاح');
                   return Redirect::route('addBranch');
               }

           }else{
               Session::flash('success_br','تم حذف الفرع بنجاح');
               return Redirect::back();
           }
       }
   }
}