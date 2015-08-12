<?php
class hrEmpDesDedSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_empDesDed')->truncate();
        DB::table('hr_empDesDed')->insert(array(
            array(
                'employee_id'     => '1 ',
                'des_ded'         => '54',
                'val'             => '54.65',
                'deleted'         => '1',
                'user_id'         => '22'
            ),
            array(
                'employee_id'     => '2 ',
                'des_ded'         => '5',
                'val'             => '54.5',
                'deleted'         => '1',
                'user_id'         => '23'
            ),
            array(
                'employee_id'     => '3 ',
                'des_ded'         => '4',
                'val'             => '4.6',
                'deleted'         => '1',
                'user_id'         => '22'
            ),
            array(
                'employee_id'     => '4 ',
                'des_ded'         => '5',
                'val'             => '5.65',
                'deleted'         => '1',
                'user_id'         => '2'
            ),
            array(
                'employee_id'     => '5 ',
                'des_ded'         => '55',
                'val'             => '99.65',
                'deleted'         => '1',
                'user_id'         => '33'
            ),

        ));

    }
}
