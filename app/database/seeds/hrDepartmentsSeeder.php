<?php

class hrDepartmentsSeeder extends Seeder {

    public function run()
    {
        DB::table('hr_departments')->truncate();
        DB::table('hr_departments')->insert(array(
            array(
                'department_id'             => '12',
                'name'                      => 'ahmed',
                'deleted'                   => '1',
                'user_id'                   => '294'


            ),
            array(
                'department_id'             => '13',
                'name'                      => 'omar',
                'deleted'                   => '1',
                'user_id'                   => '295'


            ),
            array(
                'department_id'             => '14',
                'name'                      => 'mohamed',
                'deleted'                   => '1',
                'user_id'                   => '214'


            ),
            array(
                'department_id'             => '16',
                'name'                      => 'moaaz',
                'deleted'                   => '1',
                'user_id'                   => '224'


            ),
            array(
                'department_id'             => '46',
                'name'                      => 'hazem',
                'deleted'                   => '1',
                'user_id'                   => '24'


            ),

        ));

    }

}
