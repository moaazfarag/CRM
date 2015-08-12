<?php
class hrJobsSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_jobs')->truncate();
        DB::table('hr_jobs')->insert(array(
            array(
                'job_id'             => '15',
                'name'               => 'teacher',
                'deleted'            => '1',
                'user_id'            => '12',
            ),
            array(
                'job_id'             => '13',
                'name'               => 'mister',
                'deleted'            => '1',
                'user_id'            => '55',
            ),
            array(
                'job_id'             => '3',
                'name'               => 'accounting',
                'deleted'            => '1',
                'user_id'            => '126',
            ),
            array(
                'job_id'             => '159',
                'name'               => 'engineer',
                'deleted'            => '1',
                'user_id'            => '16',
            ),
            array(
                'job_id'             => '13',
                'name'               => 'developer',
                'deleted'            => '1',
                'user_id'            => '19',
            ),
            array(
                'job_id'             => '3',
                'name'               => 'designer',
                'deleted'            => '1',
                'user_id'            => '156',
            ),

        ));
    }
}
