<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/27/2015
 * Time: 1:22 PM
 */
class TestController extends BaseController
        {
            public function index()
            {
                return Response::json(Items::get());

            }

                public function view()
            {
                return View::make('dashboard.test');
            }
            public function addTest()
            {
                $newItem = new Items;
                $newItem->item_name = Input::get('item_name');
                $newItem->save();
//        dd('sdda');
                return Response::json(array('success' => true));
            }


        public function store()
        {
            Items::create(array(
                'item_name' => Input::get('author'),
                'unit' => Input::get('text')
            ));

            return Response::json(array('success' => true));
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return Response
         */
        public function destroy($id)
        {
            Items::destroy($id);

            return Response::json(array('success' => true));
        }

}