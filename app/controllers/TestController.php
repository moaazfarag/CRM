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
   public function hi(){
       $string ="<page>
<text><b>MOAAZ</b></text>mail<text><b>123</b></text><text><b>sdfdsf</b></text>
<text><b>ADDS</b></text>mail<text><b>123</b></text>
<text><b>MOSDSAAZ</b></text>mail<text><b>123</b></text><text><b>sdfdsf</b></text>
<text><b>MOAASDDSAZ</b></text>mail<text><b>123</b></text>

</page>";
$moaaz = preg_match("<text><b>(.*?)</b></text>",$string);
   dd($moaaz);    
   }
}