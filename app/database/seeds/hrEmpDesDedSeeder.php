<?php
class hrEmpDesDedSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_empDesDed')->truncate();
        DB::table('hr_empDesDed')->insert(array(
            array(
                'employee_id'     => '1 ',
                'co_id'           => '1',
                'des_ded'         => '1',
                'val'             => '200',
                'deleted'         => '1',
                'user_id'         => '1'
            ),
            array(
                'employee_id'     => '2 ',
                'co_id'           => '2',
                'des_ded'         => '2',
                'val'             => '50',
                'deleted'         => '1',
                'user_id'         => '2'
            ),
            array(
                'employee_id'     => '3 ',
                'co_id'           => '1',
                'des_ded'         => '3',
                'val'             => '200',
                'deleted'         => '1',
                'user_id'         => '3'
            ),
            array(
                'employee_id'     => '4 ',
                'co_id'           => '2',
                'des_ded'         => '5',
                'val'             => '300',
                'deleted'         => '1',
                'user_id'         => '4'
            ),
            array(
                'employee_id'     => '5 ',
                'co_id'           => '1',
                'des_ded'         => '1',
                'val'             => '400',
                'deleted'         => '1',
                'user_id'         => '5'
            ),

        ));

    }
}
