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
//                $data = Response::json(Items::get());
//                return View::make('dashboard.test',$data);
                $data['items']= Items::with('cat')->get();
                $data['users']= User::get();
                return Response::make(json_encode($data));
//                return Response::json(Items::get());

            }

                public function view()
            {
                return View::make('dashboard.test');
            }
            public function addTest()
            {
                dd(input::all());
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

            return Response::json(array('success' => true,'data'));
        }

}