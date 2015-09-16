<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/16/2015
 * Time: 1:43 PM
 */

class directMovementSeeder extends Seeder{


    public function run(){

        DB::table('account_trans')->truncate();
        DB::table('account_trans')->insert(array(

            array(

                'co_id'     =>'1',
                'br_id'     =>'1',
                'user_id'   =>'1',
                'debit'     =>'4000',
                'credit'    =>'0',
                'date'      =>'2015-09-16',
                'pay_type'  =>'cash',
                'account'   =>'customers',
                'type'      =>'direct_movement',
                'notes'     =>'Â–… «·Õ—ﬂ… «·„»«‘—… —ﬁ„ 1 ',
            ),

            array(

                'co_id'     =>'1',
                'br_id'     =>'1',
                'user_id'   =>'1',
                'debit'     =>'0',
                'credit'    =>'150',
                'date'      =>'2015-09-16',
                'pay_type'  =>'cash',
                'account'   =>'suppliers',
                'type'      =>'direct_movement',
                'notes'     =>'Â–… «·Õ—ﬂ… «·„»«‘—… —ﬁ„ 2 ',

            ),



        ));
    }
}