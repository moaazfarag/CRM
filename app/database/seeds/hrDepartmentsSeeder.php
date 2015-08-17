<?php

class hrDepartmentsSeeder extends Seeder {

    public function run()
    {
        DB::table('hr_departments')->truncate();
        DB::table('hr_departments')->insert(array(
            array(
                'department_id'             => '12',
                'co_id'                     => '1',
                'name'                      => 'ahmed',
                'deleted'                   => '1',
                'user_id'                   => '294'


            ),
            array(
                'department_id'             => '13',
                'co_id'                     => '1',
                'name'                      => 'omar',
                'deleted'                   => '1',
                'user_id'                   => '295'


            ),
            array(
                'department_id'             => '14',
                'co_id'                     => '1',
                'name'                      => 'mohamed',
                'deleted'                   => '1',
                'user_id'                   => '214'


            ),
            array(
                'department_id'             => '16',
                'co_id'                     => '1',
                'name'                      => 'moaaz',
                'deleted'                   => '1',
                'user_id'                   => '224'


            ),
            array(
                'department_id'             => '46',
                'co_id'                     => '1',
                'name'                      => 'hazem',
                'deleted'                   => '1',
                'user_id'                   => '24'


            ),

        ));

    }

}
