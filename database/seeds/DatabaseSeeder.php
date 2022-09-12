<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AllcitiesTableSeeder::class);
        $this->call(AllcountryTableSeeder::class);
        $this->call(AllstatesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(AboutsTableSeeder::class);
        $this->call(CareersTableSeeder::class);
        $this->call(allLanguagesSeeder::class);
        $this->call(languageLevelSeeder::class);
        $this->call(preferedStudentAgeSeeder::class);
        $this->call(preferedStudentLevelSeeder::class);
        $this->call(NotificationTypesSeeder::class);
        $this->call(SpecialtiesSeeder::class);
        $this->call(appointmentStatus::class);
        $this->call(packages::class);
    }
}
