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
                'user_id'         => '1',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,


            ),

            array(
                'employee_id'     => '1 ',
                'co_id'           => '1',
                'des_ded'         => '2',
                'val'             => '300',
                'deleted'         => '1',
                'user_id'         => '1',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,


            ),


            array(
                'employee_id'     => '1 ',
                'co_id'           => '1',
                'des_ded'         => '3',
                'val'             => '100',
                'deleted'         => '1',
                'user_id'         => '1',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,


            ),


            array(
                'employee_id'     => '1 ',
                'co_id'           => '1',
                'des_ded'         => '3',
                'val'             => '150',
                'deleted'         => '1',
                'user_id'         => '1',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,


            ),


            array(
                'employee_id'     => '1 ',
                'co_id'           => '1',
                'des_ded'         => '4',
                'val'             => '200',
                'deleted'         => '1',
                'user_id'         => '1',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,


            ),
            // user num 2


            array(
                'employee_id'     => '2 ',
                'co_id'           => '1',
                'des_ded'         => '1',
                'val'             => '120',
                'deleted'         => '1',
                'user_id'         => '1',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,


            ),

            array(
                'employee_id'     => '2 ',
                'co_id'           => '1',
                'des_ded'         => '2',
                'val'             => '320',
                'deleted'         => '1',
                'user_id'         => '1',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,


            ),


            array(
                'employee_id'     => '2 ',
                'co_id'           => '1',
                'des_ded'         => '3',
                'val'             => '200',
                'deleted'         => '1',
                'user_id'         => '1',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,


            ),


            array(
                'employee_id'     => '2 ',
                'co_id'           => '1',
                'des_ded'         => '3',
                'val'             => '400',
                'deleted'         => '1',
                'user_id'         => '1',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,


            ),


            array(
                'employee_id'     => '2 ',
                'co_id'           => '1',
                'des_ded'         => '4',
                'val'             => '100',
                'deleted'         => '1',
                'user_id'         => '1',
                'created_at'      => new DateTime,
                'updated_at'      => new DateTime,


            ),

        ));

    }
}
