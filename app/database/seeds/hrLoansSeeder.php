<?php
class hrLoansSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_loans')->truncate();
        DB::table('hr_loans')->insert(array(
            array(
                'employee_id'            => '2',
                'loan_date'              => '',
                'loan_val'                => '1200',
                'loan_start'             => '',
                'loan_end'               => '',
                'user_id'                => '12',
                'loan_currBal'           => '13',
                'finish'                 => '1',
            ),
            array(
                'employee_id'            => '21',
                'loan_date'              => '',
                'loan_val'                => '1700',
                'loan_start'             => '',
                'loan_end'               => '',
                'user_id'                => '56',
                'loan_currBal'           => '183',
                'finish'                 => '1',
            ),
            array(
                'employee_id'            => '22',
                'loan_date'              => '',
                'loan_val'                => '1900',
                'loan_start'             => '',
                'loan_end'               => '',
                'user_id'                => '125',
                'loan_currBal'           => '129',
                'finish'                 => '1',
            ),
            array(
                'employee_id'            => '15',
                'loan_date'              => '',
                'loan_val'                => '2000',
                'loan_start'             => '',
                'loan_end'               => '',
                'user_id'                => '756',
                'loan_currBal'           => '123',
                'finish'                 => '1',
            ),
            array(
                'employee_id'            => '5',
                'loan_date'              => '',
                'loanVal'                => '2200',
                'loan_start'             => '',
                'loan_end'               => '',
                'user_id'                => '16',
                'loan_currBal'           => '123',
                'finish'                 => '1',
            ),

        ));
    }
}