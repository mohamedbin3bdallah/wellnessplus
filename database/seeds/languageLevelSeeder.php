<?php

use Illuminate\Database\Seeder;

class languageLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('language_level')->delete();
        \DB::table('language_level')->insert(array (
            0 => array (
                'id' => 1,
                'name' => 'A1',
                'active' => 1,
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            1 => array (
                'id' => 2,
                'name' => 'A2',
                'active' => 1,
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            2 => array (
                'id' => 3,
                'name' => 'B1',
                'active' => 1,
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            3 => array (
                'id' => 4,
                'name' => 'B2',
                'active' => 1,
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            4 => array (
                'id' => 5,
                'name' => 'C1',
                'active' => 1,
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            5 => array (
                'id' => 6,
                'name' => 'C2',
                'active' => 1,
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            6 => array (
                'id' => 7,
                'name' => 'Native',
                'active' => 1,
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
			7 => array (
                'id' => 8,
                'name' => 'Not Specified',
                'active' => 1,
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
        ));
    }
}
