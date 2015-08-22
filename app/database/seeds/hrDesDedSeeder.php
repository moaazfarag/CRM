<?php
class hrDesDedSeeder extends Seeder{
    public function run()
    {
        DB::table('hr_desDed')->truncate();
        DB::table('hr_desDed')->insert(array(
            array(
            'ds_id'          => '1',
            'co_id'          => '1',
            'name'           => 'band 1',
            'ds_type'        => 'استحقاق',
            'ds_cat'         => 'ثابت',
            'deleted'        => '1',
            'user_id'        => '1',
            ), array(
            'ds_id'          => '2',
            'co_id'          => '1',
            'name'           => 'band 2',
            'ds_type'        => 'استقطاع',
            'ds_cat'         => 'مؤقت',
            'deleted'        => '1',
            'user_id'        => '2',
            ),
            array(
            'ds_id'          => '3',
            'co_id'          => '1',
            'name'           => 'band 3',
            'ds_type'        => 'استحقاق',
            'ds_cat'         => 'مؤقت',
            'deleted'        => '1',
            'user_id'        => '3',
            ),
            array(
            'ds_id'          => '4',
            'co_id'          => '1',
            'name'           => 'band 4',
            'ds_type'        => 'استقطاع',
            'ds_cat'         => 'ثابت',
            'deleted'        => '1',
            'user_id'        => '4',
            ),
            array(
            'ds_id'          => '5',
            'co_id'          => '1',
            'name'           => 'band 5',
            'ds_type'        => 'استقطاع',
            'ds_cat'         => 'ثابت',
            'deleted'        => '1',
            'user_id'        => '5',
            ),



        ));
}
}
