<?php

use Illuminate\Database\Seeder;

class SpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('specialties')->delete();

        \DB::table('specialties')->insert(array (
            0 =>array (
                'id' => 1,
                'specialty' => 'All',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            1 => array (
                'id' => 2,
                'specialty' => 'Arabic_literature',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            2 => array (
                'id' => 3,
                'specialty' => 'Arabic_for_beginners',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            3 => array (
                'id' => 4,
                'specialty' => 'Arabic_for_children',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            4 => array (
                'id' => 5,
                'specialty' => 'Business_arabic',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            5 => array (
                'id' => 6,
                'specialty' => 'Conversational_arabic',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            6 => array (
                'id' => 7,
                'specialty' => 'Egyptian_arabic',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            7 => array (
                'id' => 8,
                'specialty' => 'General_arabic',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            8 => array (
                'id' => 9,
                'specialty' => 'Intensive_arabic',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            9 => array (
                'id' => 10,
                'specialty' => 'Moroccan_arabic',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            10 => array (
                'id' => 11,
                'specialty' => 'Quran',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
        ));
    }
}
