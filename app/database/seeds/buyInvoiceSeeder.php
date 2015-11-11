<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/30/2015
 * Time: 1:57 PM
 */

class buyInvoiceSeeder extends Seeder {
/*
 * id
 *  co_id
 * user_id
 * br_id
 * invoice_no
 * invoice_type
 * account
 *in_total
 *discount
 *tax
 *net
 *date
 *pay_type
 *deleted
 *note
 */

    public function run()
    {

        DB::table('trans_header')->truncate();
        DB::table('trans_header')->insert(array(

            /////// SALES INVOICES
            array(
                'co_id'         =>'1',
                'user_id'       =>'1',
                'br_id'         =>'1',
                'invoice_no'    =>'1',
                'invoice_type'  =>'sales',
                'account'       =>'1',
                'in_total'      =>'785',
                'discount'      =>'',
                'tax'           =>'',
                'net'           =>'785',
                'date'          =>'2015-09-5',
                'pay_type'      =>'cash',
                'deleted'       =>'0',
                'notes'          =>'هذة ملاحظة',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
                ),

            array(
                'co_id'         =>'1',
                'user_id'       =>'1',
                'br_id'         =>'1',
                'invoice_no'    =>'2',
                'invoice_type'  =>'sales',
                'account'       =>'',
                'in_total'      =>'1320',
                'discount'      =>'',
                'tax'           =>'',
                'net'           =>'1320',
                'date'          =>'2015-09-10',
                'pay_type'      =>'cash',
                'deleted'       =>'0',
                'notes'          =>'هذة ملاحظة',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
                ),


          /////// buy invoices

            array(
                'co_id'         =>'1',
                'user_id'       =>'1',
                'br_id'         =>'1',
                'invoice_no'    =>'1',
                'invoice_type'  =>'buy',
                'account'       =>'',
                'in_total'      =>'1320',
                'discount'      =>'',
                'tax'           =>'',
                'net'           =>'1320',
                'date'          =>'2015-09-5',
                'pay_type'      =>'cash',
                'deleted'       =>'0',
                'notes'          =>'هذة ملاحظة',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
            ),

            array(
                'co_id'         =>'1',
                'user_id'       =>'1',
                'br_id'         =>'1',
                'invoice_no'    =>'2',
                'invoice_type'  =>'buy',
                'account'       =>'',
                'in_total'      =>'1320',
                'discount'      =>'',
                'tax'           =>'',
                'net'           =>'1320',
                'date'          =>'2015-09-10',
                'pay_type'      =>'cash',
                'deleted'       =>'0',
                'notes'          =>'هذة ملاحظة',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
            ),

            //RETURN_SALES
            array(
                'co_id'         =>'1',
                'user_id'       =>'1',
                'br_id'         =>'1',
                'invoice_no'    =>'1',
                'invoice_type'  =>'salesReturn',
                'account'       =>'',
                'in_total'      =>'580',
                'discount'      =>'',
                'tax'           =>'',
                'net'           =>'580',
                'date'          =>'2015-09-10',
                'pay_type'      =>'cash',
                'deleted'       =>'0',
                'notes'          =>'هذة ملاحظة',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
            ),


            //RETURN_BUY
            array(
                'co_id'         =>'1',
                'user_id'       =>'1',
                'br_id'         =>'1',
                'invoice_no'    =>'1',
                'invoice_type'  =>'buyReturn',
                'account'       =>'',
                'in_total'      =>'80',
                'discount'      =>'',
                'tax'           =>'',
                'net'           =>'80',
                'date'          =>'2015-09-10',
                'pay_type'      =>'cash',
                'deleted'       =>'0',
                'notes'          =>'',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
            ),
        ));

        DB::table('trans_details')->truncate();
        DB::table('trans_details')->insert(array(

                //SALES INVOICES
             array(
                'co_id'             =>'1',
                'trans_header_id'   =>'1',
                'item_id'           =>'2',
                'qty'               =>'2',
                'unit_price'        =>'80',
                'item_total'        =>'160',
                'avg_cost'          =>'75',
                'serial_no'         =>'',
                 'created_at'       => new DateTime,
                 'updated_at'       => new DateTime,
                ),

            array(
                'co_id'             =>'1',
                'trans_header_id'   =>'1',
                'item_id'           =>'2',
                'qty'               =>'5',
                'unit_price'        =>'125',
                'item_total'        =>'625',
                'avg_cost'          =>'110',
                'serial_no'         =>'',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
                ),

            array(
                'co_id'             =>'1',
                'trans_header_id'   =>'2',
                'item_id'           =>'2',
                'qty'               =>'4',
                'unit_price'        =>'80',
                'item_total'        =>'320',
                'avg_cost'          =>'75',
                'serial_no'         =>'',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
                ),

            array(
                'co_id'             =>'1',
                'trans_header_id'   =>'2',
                'item_id'           =>'3',
                'qty'               =>'4',
                'unit_price'        =>'250',
                'item_total'        =>'1000',
                'avg_cost'          =>'220',
                'serial_no'         =>'',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
                ),

            // BUY INVOICES

            array(
                'co_id'             =>'1',
                'trans_header_id'   =>'3',
                'item_id'           =>'3',
                'qty'               =>'100',
                'unit_price'        =>'50',
                'item_total'        =>'5000',
                'avg_cost'          =>'',
                'serial_no'         =>'',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
            ),

            array(
                'co_id'             =>'1',
                'trans_header_id'   =>'4',
                'item_id'           =>'2',
                'qty'               =>'80',
                'unit_price'        =>'90',
                'item_total'        =>'7200',
                'avg_cost'          =>'',
                'serial_no'         =>'',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
            ),
            array(
                'co_id'             =>'1',
                'trans_header_id'   =>'4',
                'item_id'           =>'3',
                'qty'               =>'15',
                'unit_price'        =>'200',
                'item_total'        =>'3000',
                'avg_cost'          =>'',
                'serial_no'         =>'',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
            ),

            // RETURN_SALES

            array(
                'co_id'             =>'1',
                'trans_header_id'   =>'5',
                'item_id'           =>'3',
                'qty'               =>'1',
                'unit_price'        =>'80',
                'item_total'        =>'80',
                'avg_cost'          =>'75',
                'serial_no'         =>'',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
            ),

            array(
                'co_id'             =>'1',
                'trans_header_id'   =>'5',
                'item_id'           =>'3',
                'qty'               =>'2',
                'unit_price'        =>'250',
                'item_total'        =>'500',
                'avg_cost'          =>'220',
                'serial_no'         =>'',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
            ),

            //RETURN buy

            array(
                'co_id'             =>'1',
                'trans_header_id'   =>'6',
                'item_id'           =>'3',
                'qty'               =>'5',
                'unit_price'        =>'200',
                'item_total'        =>'1000',
                'avg_cost'          =>'',
                'serial_no'         =>'',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,
            ),


        ));

    } // end function run

} // end class
