<?php
class hrDesDedSeeder extends Seeder{
    public function run()
    {
        DB::table('hr_desDed')->truncate();
        DB::table('hr_desDed')->insert(array(
            array(
            'ds_id'          => '1',
            'co_id'          => '1',
            'name'           => 'ahmed',
            'ds_type'        => 'text',
            'ds_cat'         => 'category',
            'deleted'        => '1',
            'user_id'        => '166',
            ), array(
            'ds_id'          => '13',
            'co_id'          => '1',
            'name'           => 'mohamed',
            'ds_type'        => 'text',
            'ds_cat'         => 'category',
            'deleted'        => '1',
            'user_id'        => '66',
            ), array(
            'ds_id'          => '6',
                'co_id'          => '1',

                'name'           => 'ahmed',
            'ds_type'        => 'text',
            'ds_cat'         => 'category',
            'deleted'        => '1',
            'user_id'        => '566',
            ), array(
            'ds_id'          => '15',
                'co_id'          => '1',

                'name'           => 'tarek',
            'ds_type'        => 'text',
            'ds_cat'         => 'category',
            'deleted'        => '1',
            'user_id'        => '131566',
            ), array(
            'ds_id'          => '16',
                'co_id'          => '1',

                'name'           => 'gamal',
            'ds_type'        => 'text',
            'ds_cat'         => 'category',
            'deleted'        => '1',
            'user_id'        => '136',
            ),



        ));
}
}
