<?php

use Illuminate\Database\Seeder;

class allLanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('all_languages')->delete();
        \DB::table('all_languages')->insert(array (
            0 => array (
                'id' => 1,
                'isoName' => 'Abkhazian',
                'nativeName' => 'аҧсуа бызшәа, аҧсшәа',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
                ),
            1 => array (
                'id' => 2,
                'isoName' => 'Arabic',
                'nativeName' => 'العربية',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            2 => array (
                'id' => 3,
                'isoName' => 'English',
                'nativeName' => 'English',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            3 => array (
                'id' => 4,
                'isoName' => 'French',
                'nativeName' => 'français',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            4 => array (
                'id' => 5,
                'isoName' => 'Russian',
                'nativeName' => 'русский',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            5 => array (
                'id' => 6,
                'isoName' => 'Chinese',
                'nativeName' => 'Chinese',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            6 => array (
                'id' => 7,
                'isoName' => 'Turkish',
                'nativeName' => 'Türkçe',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            7 => array (
                'id' => 8,
                'isoName' => 'Japanese',
                'nativeName' => '日本語 (にほんご)',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            8 => array (
                'id' => 9,
                'isoName' => 'Korean',
                'nativeName' => '한국어',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            9 => array (
                'id' => 10,
                'isoName' => 'Latin',
                'nativeName' => 'latine, lingua latina',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            10 => array (
                'id' => 11,
                'isoName' => 'Hungarian',
                'nativeName' => 'magyar',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            11 => array (
                'id' => 12,
                'isoName' => 'Indonesian',
                'nativeName' => 'Bahasa Indonesia',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            12 => array (
                'id' => 13,
                'isoName' => 'Irish',
                'nativeName' => 'Gaeilge',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
        ));

    }
}
