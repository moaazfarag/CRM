<?php
class hrDesDedSeeder extends Seeder{
    public function run()
    {
        DB::table('hr_desDed')->truncate();
        DB::table('hr_desDed')->insert(array(
            array(
            'co_id'          => '1',
            'name'           => 'طبيعة عمل',
            'ds_type'        => 'استحقاق',
            'ds_cat'         => 'ثابت',
            'deleted'        => '1',
            'user_id'        => '1',
            ),
            array(
            'co_id'          => '1',
            'name'           => 'خصم شهري',
            'ds_type'        => 'استقطاع',
            'ds_cat'         => 'ثابت',
            'deleted'        => '1',
            'user_id'        => '5',
            ), array(
                'ds_id'          => '2',
                'co_id'          => '1',
                'name'           => 'خصم غياب',
                'ds_type'        => 'استقطاع',
                'ds_cat'         => 'متغير',
                'deleted'        => '1',
                'user_id'        => '2',
            ),
            array(
                'co_id'          => '1',
                'name'           => 'مكافاءة',
                'ds_type'        => 'استحقاق',
                'ds_cat'         => 'متغير',
                'deleted'        => '1',
                'user_id'        => '3',
            ),
            array(
                'co_id'          => '1',
                'name'           => 'خصم ايام',
                'ds_type'        => 'استقطاع',
                'ds_cat'         => 'متغير',
                'deleted'        => '1',
                'user_id'        => '4',
            ),



        ));
}
}
