<?php

class settleSeeder extends Seeder
{

    public function run(){

        DB::table('trans_details')->truncate();
        DB::table('trans_details')->insert(array(

           array(

               
               'trans_header_id' => '1',
               'co_id'           => '1',
               'item_id'         => '3',
               'qty'             => '2',
               'created_at'      => new DateTime,
               'updated_at'      => new DateTime,

           ),

            array(

                'trans_header_id' => '2',
                'co_id'           => '1',
                'item_id'         => '2',
                'qty'             => '4',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,

            ),
            array(
                
                'trans_header_id' => '3',
                'co_id'           => '1',
                'item_id'         => '2',
                'qty'             => '6',
                'created_at'      => new DateTime,
                'updated_at'    => new DateTime,


            ),

            array(
                'trans_header_id' => '4',
                'co_id'           => '1',
                'item_id'         => '2',
                'qty'             => '8',
                'created_at'      => new DateTime,
                'updated_at'    => new DateTime,

            ),




        ));



        DB::table('trans_header')->truncate();
        DB::table('trans_header')->insert(array(

            array(
                'true_id'       => '1',
                'co_id'         => '1',
                'user_id'       =>'1',
                'br_id'         =>'1',
                'invoice_no'    =>'1',
                'invoice_type'  =>'settleDown',
                'date'          => new dateTime,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),

            array(
                'true_id'       => '2',
                'co_id'         => '1',
                'user_id'       =>'1',
                'br_id'          =>'1',
                'invoice_no'    =>'2',
                'invoice_type'  =>'settleDown',
                'date'          => new dateTime,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),

            array(

                'true_id'       => '1',
                'co_id'         => '1',
                'user_id'       =>'1',
                'br_id'         =>'1',
                'invoice_no'    =>'3',
                'invoice_type'  =>'settleAdd',
                'date'          => new dateTime,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,

            ),

            array(
                'true_id'       => '2',
                'co_id'         => '1',
                'user_id'       =>'1',
                'br_id'       =>'1',
                'invoice_no'    =>'4',
                'invoice_type'  =>'settleAdd',
                'date'          => new dateTime,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,

            ),
        ));
     }
}
