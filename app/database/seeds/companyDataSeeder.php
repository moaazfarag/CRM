<?php
  
class companyDataSeeder extends Seeder {


  public function run()
  {
    
    DB::table('co_data')->truncate();
    DB::table('co_data')->insert(array(

    array(
      'co_name'          =>'شركة الحمد للملابس',
      'co_address'       =>'55 شارع احمد لطفى متفرع من شارع الطيران',
      'co_tel'           =>'002556699',
      'co_mobile_1'      =>'0104445566',
      'co_mobile_2'      =>'0108956565',
      'co_carrency'      =>'جنية مصرى',
      'co_print_size'    =>'A4',
      'co_use_seireal'   =>'yes',
      'co_supplier_must' =>'no',
      'co_use_season'    =>'yes',
      'co_use_markes_models'=>'no',
      'co_statues'       =>'0',
      'user_id'          =>'1',
      ),

    array(
      'co_name'          =>'شركة البركة للسيارات',
      'co_address'       =>'النزهة الجديدة 44 شارع عثمان بن عفان ',
      'co_tel'           =>'00296299',
      'co_mobile_1'      =>'0114445566',
      'co_mobile_2'      =>'0128956565',
      'co_carrency'      =>'دولار',
      'co_print_size'    =>'A3',
      'co_use_seireal'   =>'yes',
      'co_supplier_must' =>'no',
      'co_use_season'    =>'yes',
      'co_use_markes_models'=>'no',
      'co_statues'       =>'0',
      'user_id'          =>'2',
      ),

    array(
      'co_name'          =>'شركة التقوى سوبر ماركت ',
      'co_address'       =>'55 عباس العقاد مدينة نصر  القاهرة ',
      'co_tel'           =>'002555006',
      'co_mobile_1'      =>'01089320255',
      'co_mobile_2'      =>'01089569325',
      'co_carrency'      =>'ين يابانى',
      'co_print_size'    =>'A4',
      'co_use_seireal'   =>'yes',
      'co_supplier_must' =>'no',
      'co_use_season'    =>'yes',
      'co_use_markes_models'=>'no',
      'co_statues'       =>'0',
      'user_id'          =>'3',
      )

    ));

  } // end function run

} // end class 
