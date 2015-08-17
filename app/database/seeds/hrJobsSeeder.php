<?php
class hrJobsSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_jobs')->truncate();
        DB::table('hr_jobs')->insert(array(
            array(
                'job_id'             => '15',
                'co_id'              => '1',
                'name'               => 'teacher',
                'deleted'            => '1',
                'user_id'            => '12',
            ),
            array(
                'job_id'             => '13',
                'co_id'              => '1',
                'name'               => 'mister',
                'deleted'            => '1',
                'user_id'            => '55',
            ),
            array(
                'job_id'             => '3',
                'co_id'              => '1',
                'name'               => 'accounting',
                'deleted'            => '1',
                'user_id'            => '126',
            ),
            array(
                'job_id'             => '159',
                'co_id'              => '1',
                'name'               => 'engineer',
                'deleted'            => '1',
                'user_id'            => '16',
            ),
            array(
                'job_id'             => '13',
                'co_id'              => '1',
                'name'               => 'developer',
                'deleted'            => '1',
                'user_id'            => '19',
            ),
            array(
                'job_id'             => '3',
                'co_id'              => '1',
                'name'               => 'designer',
                'deleted'            => '1',
                'user_id'            => '156',
            ),

        ));
    }
}
