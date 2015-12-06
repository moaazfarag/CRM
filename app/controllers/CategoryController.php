<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/8/2015
 * Time: 3:05 PM
 */
class CategoryController extends  BaseController
{
    /**
     * return view of add form
     * @return mixed
     */
        public function addCategory()
        {
            $data = $this->categoryData();
            $data['catActive'] = "active";
            return View::make('dashboard.products.category.index',$data);
        }

    /**
     * add new category to database
     */
        public function storeCategory()
            {
                $category           = new Category ;
                $category->true_id  = BaseController::maxId($category);
                $category->name     = Input::get('name'); //category name from input
                $category->co_id    = Auth::user()->co_id; // company id
                $category->user_id  = Auth::id();// user who add this record
                if($category->save()){

                    Session::flash('success',BaseController::addSuccess('القسم'));
                }else{

                    Session::flash('error',BaseController::addError('القسم'));
                }
                return Redirect::route('addCategory');
            }

        public function editCategory($id)
            {
                //dd('saddsa');
                $data = $this->categoryData();
                $data['catActive'] = "active";
                $data['editCategory']  = Category::findOrFail($id);
                return View::make('dashboard.products.category.index',$data);

            }
        public function updateCategory($id)
            {
                $category           = Category::findOrFail($id) ;
                $category->name     = Input::get('name'); //category name from input
                $category->co_id    = Auth::user()->co_id; // company id
                $category->user_id  = Auth::id();// user who add this record

                if($category->update()){
                    Session::flash('success',BaseController::editSuccess('القسم'));
                }else{
                    Session::flash('error',BaseController::editError('القسم'));
                }

                return Redirect::route('addCategory');

            }

    /**
     * data will use in category
     * @return mixed
     */
        protected function categoryData()
        {
            $itemCat                =Lang::get('main.itemCat');
            $item                   =Lang::get('main.item');
            $data['table_name']     = 'cat';
            $data['title']          = $itemCat;
            $data['activeCatNav']   = "active";
            $data['asideOpen']      = "open";
            $data['catFunName']     = "editCategory";
            $data['categoryMini']   = "";
            $data['arabicName']     = $item;
            $data['tablesData']     = Category::company()->get();

            return $data;
        }

    public function deleteCategory($id)
    {

        $cat = Category::company()->find($id);
        $items  = Items::where('cat_id','=',$id)->company()->first();


        if(!empty($cat)){

            if(!empty($items)) {
//            die(var_dump($items));
                Session::flash('error', 'لا يمكن الحذف ...   هناك أصناف تحمل اسم هذة الفئة ');
                return Redirect::back();
            }else{

                $cat->delete();
                $edit_ids = BaseController::editIds('models','Models','true_id');
                if($edit_ids) {
                    Session::flash('success', 'تم حذف فئة الصنف بنجاح ');
                    return Redirect::back();
                }
            }//end else employees

        }
    }
}