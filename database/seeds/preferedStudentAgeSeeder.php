<?php

use Illuminate\Database\Seeder;

class preferedStudentAgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('prefered_student_age')->delete();

        \DB::table('prefered_student_age')->insert(array (
            0 => array (
                'id' => 1,
                'age' => 'Toddlers (1-3)',
				'age_ar' => 'الأطفال الصغار (1-3)',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            1 => array (
                'id' => 2,
                'age' => 'Preschoolers (4-6)',
				'age_ar' => 'مرحلة ما قبل المدرسة (4-6)',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            2 => array (
                'id' => 3,
                'age' => 'Primary school (6-12)',
				'age_ar' => 'المدرسة الابتدائية (6-12)',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            3 => array (
                'id' => 4,
                'age' => 'Secondary school (12-17)',
				'age_ar' => 'المدرسة الثانوية (12-17)',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            4 => array (
                'id' => 5,
                'age' => 'Undergraduate (17-22)',
				'age_ar' => 'المرحلة الجامعية (17-22)',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            5 => array (
                'id' => 6,
                'age' => 'Adults (23-40)',
				'age_ar' => 'الكبار (23-40)',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
            6 => array (
                'id' => 7,
                'age' => 'Adults (40+)',
				'age_ar' => 'الكبار (40+)',
                'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),
			/*7 => array (
                'id' => 8,
                'age' => 'All',
				'age_ar' => 'الكل',
				'created_at' => '2020-09-15 12:08:34',
                'updated_at' => '2020-09-15 12:08:34',
            ),*/
        ));
    }
}
