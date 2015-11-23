<?php

class companyDataSeeder extends Seeder {


  public function run()
  {
    
    DB::table('co_data')->truncate();
    DB::table('co_data')->insert(array(

    array(
      'created_at'       =>new DateTime(),
      'co_name'          =>'شركة الحمد للملابس',
      'co_address'       =>'55 شارع احمد لطفى متفرع من شارع الطيران',
      'co_tel'           =>'002556699',
      'co_mobile_1'      =>'0104445566',
      'co_mobile_2'      =>'0108956565',
      'co_currency'      =>'جنية مصرى',
      'co_print_size'    =>'A4',
      'co_use_serial'   =>'0',
      'co_supplier_must' =>'0',
      'co_use_season'    =>'0',
      'co_use_markes_models'=>'0',
      'co_statues'       =>'1',
        'user_id'          =>'1',
        'co_expiration_date'=>'2015-11-23',
        'confirmed'=>'1',
    ),

    array(
        'created_at'       =>new DateTime(),
        'co_name'             =>'شركة البركة للسيارات',
      'co_address'          =>'النزهة الجديدة 44 شارع عثمان بن عفان ',
      'co_tel'              =>'00296299',
      'co_mobile_1'         =>'0114445566',
      'co_mobile_2'         =>'0128956565',
      'co_currency'         =>'دولار',
      'co_print_size'       =>'A3',
      'co_use_serial'       =>'0',
      'co_supplier_must'    =>'0',
      'co_use_season'       =>'0',
      'co_use_markes_models'=>'0',
      'co_statues'          =>'0',
      'user_id'             =>'2',
        'co_expiration_date'=>'2016-11-15',
        'confirmed'=>'1',
    ),

    array(
        'created_at'       =>new DateTime(),
        'co_name'          =>'شركة التقوى سوبر ماركت ',
      'co_address'       =>'55 عباس العقاد مدينة نصر  القاهرة ',
      'co_tel'           =>'002555006',
      'co_mobile_1'      =>'01089320255',
      'co_mobile_2'      =>'01089569325',
      'co_currency'      =>'ين يابانى',
      'co_print_size'    =>'A4',
      'co_use_serial'   =>'1',
      'co_supplier_must' =>'1',
      'co_use_season'    =>'1',
      'co_use_markes_models'=>'1',
      'co_statues'       =>'2',
      'user_id'          =>'3',
        'co_expiration_date'=>'2016-6-3',
        'confirmed'=>'1',
    )

    ));

  } // end function run

} // end class 
