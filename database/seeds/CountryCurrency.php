<?php

use Illuminate\Database\Seeder;

class CountryCurrency extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('country_currencies')->delete();

      $path = base_path() . '/database/seeds/country_currencies.sql';
      $sql = file_get_contents($path);
      DB::unprepared($sql);

    }
}
