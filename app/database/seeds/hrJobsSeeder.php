<?php
class hrJobsSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_jobs')->truncate();
        DB::table('hr_jobs')->insert(array(
            array(
                'jobCode'           => '159753',
                'jobName'           => 'teacher',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
            array(
                'jobCode'           => '159753',
                'jobName'           => 'mister',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
            array(
                'jobCode'           => '159753',
                'jobName'           => 'accounting',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
            array(
                'jobCode'           => '159753',
                'jobName'           => 'engineer',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
            array(
                'jobCode'           => '159753',
                'jobName'           => 'developer',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
            array(
                'jobCode'           => '159753',
                'jobName'           => 'designer',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
            array(
                'jobCode'           => '159753',
                'jobName'           => 'seller',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
            array(
                'jobCode'           => '159753',
                'jobName'           => 'artist',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
            array(
                'jobCode'           => '159753',
                'jobName'           => 'decorist',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
            array(
                'jobCode'           => '159753',
                'jobName'           => 'web',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
            array(
                'jobCode'           => '159753',
                'jobName'           => 'ux',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
            array(
                'jobCode'           => '159753',
                'jobName'           => 'ui',
                'deleted'           => '1',
                'userId'            => '123456',
            ),
        ));
    }
}
