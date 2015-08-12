<?php
class hrMSHeaderSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_MSHeader')->truncate();
        DB::table('hr_MSHeader')->insert(array(
            array(
                'employee_id'               => '2',
                'for_year'                  => '2015',
                'for_month'                 => '5',
                'fixed_salary'              => '1500.20',
                'deserves'                  => '2000',
                'deductions'                => '238.15',
                'loan'                      => '5000',
                'net'                       => '3500',
                'got_sal'                   => '1',
                'sel_date'                  => '',
                'user_id'                   => '1',
            ),
            array(
                'employee_id'               => '3',
                'for_year'                  => '2015',
                'for_month'                 => '5',
                'fixed_salary'              => '150',
                'deserves'                  => '2050',
                'deductions'                => '25',
                'loan'                      => '5000',
                'net'                       => '3500',
                'got_sal'                   => '1',
                'sel_date'                  => '',
                'user_id'                   => '6',
            ),
            array(
                'employee_id'               => '4',
                'for_year'                  => '2015',
                'for_month'                 => '5',
                'fixed_salary'              => '200.25',
                'deserves'                  => '2000',
                'deductions'                => '238.15',
                'loan'                      => '5000',
                'net'                       => '3500',
                'got_sal'                   => '1',
                'sel_date'                  => '',
                'user_id'                   => '7',
            ),
            array(
                'employee_id'               => '5',
                'for_year'                  => '2015',
                'for_month'                 => '5',
                'fixed_salary'              => '800.2',
                'deserves'                  => '2000',
                'deductions'                => '238.15',
                'loan'                      => '5000',
                'net'                       => '3500',
                'got_sal'                   => '1',
                'sel_date'                  => '',
                'user_id'                   => '4',
            ),
            array(
                'employee_id'               => '6',
                'for_year'                  => '2015',
                'for_month'                 => '5',
                'fixed_salary'              => '700.2',
                'deserves'                  => '2000',
                'deductions'                => '238.15',
                'loan'                      => '5000',
                'net'                       => '3500',
                'got_sal'                   => '1',
                'sel_date'                  => '',
                'user_id'                   => '9',
            ),

        ));
    }
}
