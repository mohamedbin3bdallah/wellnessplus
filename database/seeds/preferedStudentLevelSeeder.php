<?php

use Illuminate\Database\Seeder;

class preferedStudentLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('prefered_student_level')->delete();

        \DB::table('prefered_student_level')->insert(array (
            0 =>array (
                    'id' => 1,
                    'student_level' => 'Beginner',
					'student_level_ar' => 'مبتدئ',
                    'created_at' => '2020-01-21 12:08:34',
                    'updated_at' => '2020-01-21 12:08:34',
                ),
            1 => array (
                'id' => 2,
                'student_level' => 'Pre Intermediate',
				'student_level_ar' => 'ما قبل المتوسط',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            2 => array (
                'id' => 3,
                'student_level' => 'Intermediate',
				'student_level_ar' => 'متوسط',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            3 => array (
                'id' => 4,
                'student_level' => 'Upper Intermediate',
				'student_level_ar' => 'وسيط ذو مستوي رفيع',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            4 => array (
                'id' => 5,
                'student_level' => 'Advanced',
				'student_level_ar' => 'متقدم',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            5 => array (
                'id' => 6,
                'student_level' => 'Proficiency',
				'student_level_ar' => 'الكفاءة',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
            6 => array (
                'id' => 7,
                'student_level' => 'Not Specified',
				'student_level_ar' => 'غير محدد',
                'created_at' => '2020-01-21 12:08:34',
                'updated_at' => '2020-01-21 12:08:34',
            ),
        ));
    }
}
