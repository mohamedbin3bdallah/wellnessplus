<?php

use Illuminate\Database\Seeder;

class appointmentStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('appointment_status')->delete();
        \DB::table('appointment_status')->insert(array (
            0 => array (
                'id' => 1,
                'status' => 'Scheduled',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            1 => array (
                'id' => 2,
                'status' => 'Waiting for confirmation',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            2 => array (
                'id' => 3,
                'status' => 'Confirmed',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            3 => array (
                'id' => 4,
                'status' => 'Cancelled',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            4 => array (
                'id' => 5,
                'status' => 'Reserved',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            5 => array (
                'id' => 6,
                'status' => 'Awaiting resolution',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            6 => array (
                'id' => 7,
                'status' => 'Pending Payment',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            )

        ));

    }
}
