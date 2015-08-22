<?php
class hrLoansSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_loans')->truncate();
        DB::table('hr_loans')->insert(array(
            array(
                'employee_id'            => '2',
                'co_id'                  => '1',
                'loan_date'              => '',
                'loan_val'                => '1200',
                'loan_start'             => '',
                'loan_end'               => '',
                'user_id'                => '1',
                'loan_currBal'           => '13',
                'finish'                 => '1',
            ),
            array(
                'employee_id'            => '1',
                'co_id'                  => '1',
                'loan_date'              => '',
                'loan_val'                => '1700',
                'loan_start'             => '',
                'loan_end'               => '',
                'user_id'                => '2',
                'loan_currBal'           => '184',
                'finish'                 => '1',
            ),
            array(
                'employee_id'            => '3',
                'co_id'                  => '1',
                'loan_date'              => '',
                'loan_val'                => '1900',
                'loan_start'             => '',
                'loan_end'               => '',
                'user_id'                => '3',
                'loan_currBal'           => '129',
                'finish'                 => '1',
            ),
            array(
                'employee_id'            => '5',
                'co_id'                  => '1',
                'loan_date'              => '',
                'loan_val'                => '2000',
                'loan_start'             => '',
                'loan_end'               => '',
                'user_id'                => '4',
                'loan_currBal'           => '123',
                'finish'                 => '1',
            ),
            array(
                'employee_id'            => '5',
                'co_id'                  => '1',
                'loan_date'              => '',
                'loan_val'                => '2200',
                'loan_start'             => '',
                'loan_end'               => '',
                'user_id'                => '5',
                'loan_currBal'           => '123',
                'finish'                 => '1',
            ),

        ));
    }
}