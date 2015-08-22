<?php

class hrDepartmentsSeeder extends Seeder {

    public function run()
    {
        DB::table('hr_departments')->truncate();
        DB::table('hr_departments')->insert(array(
            array(
                'department_id'             => '1',
                'co_id'                     => '1',
                'name'                      => 'developers',
                'deleted'                   => '1',
                'user_id'                   => '1'


            ),
            array(
                'department_id'             => '2',
                'co_id'                     => '1',
                'name'                      => 'designers',
                'deleted'                   => '1',
                'user_id'                   => '2'


            ),
            array(
                'department_id'             => '3',
                'co_id'                     => '1',
                'name'                      => 'sales',
                'deleted'                   => '1',
                'user_id'                   => '3'


            ),
            array(
                'department_id'             => '4',
                'co_id'                     => '1',
                'name'                      => 'accounting',
                'deleted'                   => '1',
                'user_id'                   => '4'


            ),
            array(
                'department_id'             => '5',
                'co_id'                     => '1',
                'name'                      => 'marketing',
                'deleted'                   => '1',
                'user_id'                   => '5'


            ),

        ));

    }

}
