<?php
class hrMSDetailsSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_MSDetails')->truncate();
        DB::table('hr_MSDetails')->insert(array(
            array(
            'employee_id'              => '2',
            'for_year'                 => '2015',
            'for_month'                => '5',
            'des_ded_id'                => '5',
            'desDed_type'              => 'el-rased',
            'desDed_val'               => '15000',
            ),
             array(
            'employee_id'              => '3',
            'for_year'                 => '2015',
            'for_month'                => '3',
            'des_ded_id'                => '3',
            'desDed_type'              => 'el-rased',
            'desDed_val'               => '13000',
            ),
             array(
            'employee_id'              => '4',
            'for_year'                 => '2015',
            'for_month'                => '4',
            'des_ded_id'                => '4',
            'desDed_type'              => 'el-rased',
            'desDed_val'               => '14000',
            ),
             array(
            'employee_id'              => '5',
            'for_year'                 => '2015',
            'for_month'                => '6',
            'des_ded_id'                => '6',
            'desDed_type'              => 'el-rased',
            'desDed_val'               => '16000',
            ),
             array(
            'employee_id'              => '6',
            'for_year'                 => '2015',
            'for_month'                => '7',
            'des_ded_id'                => '7',
            'desDed_type'              => 'el-rased',
            'desDed_val'               => '17000',
            ),
             array(
            'employee_id'              => '7',
            'for_year'                 => '2015',
            'for_month'                => '8',
            'des_ded_id'                => '8',
            'desDed_type'              => 'el-rased',
            'desDed_val'               => '18000',
            ),

        ));
    }
}