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
            return View::make('dashboard.product_cat',$data);
        }

    /**
     * add new category to database
     */
        public function storeCategory()
            {
                $category           = new Cat ;
                $category->name     = Input::get('name'); //category name from input
                $category->co_id    = Auth::user()->co_id; // company id
                $category->user_id  = Auth::id();// user who add this record
                $category->save();
                return Redirect::route('addCategory');
            }

        public function editCategory($id)
            {
                //dd('saddsa');
                $data = $this->categoryData();
                $data['catActive'] = "active";
                $data['editCategory']  = Cat::findOrFail($id);
                return View::make('dashboard.product_cat',$data);

            }
        public function updateCategory($id)
            {
                $category           = Cat::findOrFail($id) ;
                $category->name = Input::get('name'); //category name from input
                $category->co_id    = Auth::user()->co_id; // company id
                $category->user_id  = Auth::id();// user who add this record
                $category->update();
                return Redirect::route('addCategory');

            }

    /**
     * data will use in category
     * @return mixed
     */
        protected function categoryData()
        {

            $data['title'] = "فئات الاصناف";
            $data['activeCatNav'] = "active";
            $data['catFunName'] = "editCategory";
            $data['categoryMini'] = "";
            $data['arabicName'] = "الصنف";
            $data['tablesData'] = Cat::all();
            return $data;
        }
}