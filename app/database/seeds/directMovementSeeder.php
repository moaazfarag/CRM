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
                'account_id'=>'1',
                'account_trans_no'=>'1',
                'debit'     =>'0',
                'credit'    =>'4000',
                'date'      =>'2015-09-16',
                'pay_type'  =>'cash',
                'account'   =>'customers',
                'trans_type'=>'catch',
                'notes'     =>'ملاحظة',
            ),

            array(

                'co_id'     =>'1',
                'br_id'     =>'1',
                'user_id'   =>'1',
                'account_id'=>'3',
                'account_trans_no'=>'1',
                'debit'     =>'150',
                'credit'    =>'0',
                'date'      =>'2015-09-16',
                'pay_type'  =>'cash',
                'account'   =>'suppliers',
                'trans_type'=>'pay',
                'notes'     =>'هذة ملاحظة ',

            ),



        ));
    }
}