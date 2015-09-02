<?php
class hrMonthChangesSeeder extends Seeder {
    public function run()
    {
        DB::table('hr_monthChanges')->truncate();
        DB::table('hr_monthChanges')->insert(array(
            array(
                'employee_id'            => '2',
                'trans_date'             => '',
                'trans_serial'           => '15',
                'for_year'               => '2015',
                'for_month'              => '5',
                'des_ded_id'              => '1',
                'day_cost'               => '100',
                'val'                    => '1000',
                'cause'                  =>'hard work hard work hard work',
                'user_id'                => '1',
                'canceled'               => '1',
                'cancel_cause'           => ' because the time to finish tasks is to late',
            ),
            array(
                'employee_id'            => '3',
                'trans_date'             => '',
                'trans_serial'           => '16',
                'for_year'               => '2015',
                'for_month'              => '6',
                'des_ded_id'              => '1',
                'day_cost'               => '101',
                'val'                    => '1001',
                'cause'                  =>'hard work hard work hard work',
                'user_id'                => '2',
                'canceled'               => '1',
                'cancel_cause'           => ' because the time to finish tasks is to late',
            ),
            array(
                'employee_id'            => '4',
                'trans_date'             => '',
                'trans_serial'           => '17',
                'for_year'               => '2015',
                'for_month'              => '7',
                'des_ded_id'              => '3',
                'day_cost'               => '110',
                'val'                    => '1100',
                'cause'                  =>'hard work hard work hard work',
                'user_id'                => '3',
                'canceled'               => '1',
                'cancel_cause'           => ' because the time to finish tasks is to late',
            ),
            array(
                'employee_id'            => '5',
                'trans_date'             => '',
                'trans_serial'           => '18',
                'for_year'               => '2015',
                'for_month'              => '8',
                'des_ded_id'              => '4',
                'day_cost'               => '108',
                'val'                    => '1800',
                'cause'                  =>'hard work hard work hard work',
                'user_id'                => '4',
                'canceled'               => '1',
                'cancel_cause'           => ' because the time to finish tasks is to late',
            ),
            array(
                'employee_id'            => '6',
                'trans_date'             => '',
                'trans_serial'           => '19',
                'for_year'               => '2015',
                'for_month'              => '9',
                'des_ded_id'              => '5',
                'day_cost'               => '900',
                'val'                    => '9900',
                'cause'                  =>'hard work hard work hard work',
                'user_id'                => '5',
                'canceled'               => '1',
                'cancel_cause'           => ' because the time to finish tasks is to late',
            ),

        ));

    }
}