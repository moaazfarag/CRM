<?php
class hrLoansSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_loans')->truncate();
        DB::table('hr_loans')->insert(array(
            array(
                'true_id'                => '1',
                'employee_id'            => '2',
                'co_id'                  => '1',
                'loan_date'              =>  new DateTime(),
                'loan_val'                => '1200',
                'loan_start'             => new DateTime(),
                'loan_end'               => date('Y-m-d', strtotime("+3 months")),
                'user_id'                => '1',
                'loan_currBal'           => '13',
                'finish'                 => '1',
            ),
            array(
                'true_id'                => '2',
                'employee_id'            => '1',
                'co_id'                  => '1',
                'loan_date'              => new DateTime(),
                'loan_val'                => '1700',
                'loan_start'             => new DateTime(),
                'loan_end'               => date('Y-m-d', strtotime("+4 months")),
                'user_id'                => '2',
                'loan_currBal'           => '184',
                'finish'                 => '1',
            ),
            array(
                'true_id'                => '3',
                'employee_id'            => '3',
                'co_id'                  => '1',
                'loan_date'              => new DateTime(),
                'loan_val'                => '1900',
                'loan_start'             => new DateTime(),
                'loan_end'               => date('Y-m-d', strtotime("+5 months")),
                'user_id'                => '3',
                'loan_currBal'           => '129',
                'finish'                 => '1',
            ),
            array(
                'true_id'                => '4',
                'employee_id'            => '5',
                'co_id'                  => '1',
                'loan_date'              => new DateTime(),
                'loan_val'                => '2000',
                'loan_start'             => new DateTime(),
                'loan_end'               => date('Y-m-d', strtotime("+6 months")),
                'user_id'                => '4',
                'loan_currBal'           => '123',
                'finish'                 => '1',
            ),
            array(
                'true_id'                => '5',
                'employee_id'            => '5',
                'co_id'                  => '1',
                'loan_date'              => new DateTime(),
                'loan_val'                => '2200',
                'loan_start'             => new DateTime(),
                'loan_end'               => date('Y-m-d', strtotime("+8 months")),
                'user_id'                => '5',
                'loan_currBal'           => '123',
                'finish'                 => '1',
            ),

        ));
    }
}