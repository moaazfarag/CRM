<?php
class hrJobsSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_jobs')->truncate();
        DB::table('hr_jobs')->insert(array(
            array(
                'job_id'             => '1',
                'co_id'              => '1',
                'name'               => 'teacher',
                'deleted'            => '1',
                'user_id'            => '1',
            ),
            array(
                'job_id'             => '2',
                'co_id'              => '1',
                'name'               => 'mister',
                'deleted'            => '1',
                'user_id'            => '2',
            ),
            array(
                'job_id'             => '3',
                'co_id'              => '1',
                'name'               => 'accounting',
                'deleted'            => '1',
                'user_id'            => '3',
            ),
            array(
                'job_id'             => '4',
                'co_id'              => '1',
                'name'               => 'engineer',
                'deleted'            => '1',
                'user_id'            => '4',
            ),
            array(
                'job_id'             => '5',
                'co_id'              => '1',
                'name'               => 'developer',
                'deleted'            => '1',
                'user_id'            => '5',
            ),
            array(
                'job_id'             => '6',
                'co_id'              => '1',
                'name'               => 'designer',
                'deleted'            => '1',
                'user_id'            => '6',
            ),

        ));
    }
}
