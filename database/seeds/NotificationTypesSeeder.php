<?php

use Illuminate\Database\Seeder;

class NotificationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('notifications_types')->delete();

        \DB::table('notifications_types')->insert(array (
            0 => array (
                'id' => 1,
                'name' => 'Lesson_Scheduling',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            1 => array (
                'id' => 2,
                'name' => 'General_Reminder',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            2 => array (
                'id' => 3,
                'name' => 'Updates._Tips,_And_Offers',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            3 => array (
                'id' => 4,
                'name' => 'Arabi_Blog',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            4 => array (
                'id' => 5,
                'name' => 'Q&A_Section',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            5 => array (
                'id' => 6,
                'name' => 'Lessons_And_Messages',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            6 => array (
                'id' => 7,
                'name' => 'Allow_Arabi_Team_To_Conduct_Me_For_Product_Improvements',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
        ));
    }
}
