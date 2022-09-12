<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();
        \DB::table('categories')->insert(array (
            0 => array (
                'id' => 1,
                'title' => '{"en":"Therapist","ar":"\u0645\u0639\u0627\u0644\u062c"}',
				'icon' => NULL,
				'slug' => '{"en":"therapist","ar":"\u0645\u0639\u0627\u0644\u062c"}',
				'featured' => 1,
				'status' => 1,
                'position' => 1,
                'created_at' => '2022-04-07 00:00:00',
                'updated_at' => '2022-04-07 00:00:00',
                ),
			1 => array (
                'id' => 2,
                'title' => '{"en":"Coach","ar":"\u0645\u062f\u0631\u0628"}',
				'icon' => NULL,
				'slug' => '{"en":"coach","ar":"\u0645\u062f\u0631\u0628"}',
				'featured' => 1,
				'status' => 1,
                'position' => 2,
                'created_at' => '2022-04-07 00:00:00',
                'updated_at' => '2022-04-07 00:00:00',
                ),
			2 => array (
                'id' => 3,
                'title' => '{"en":"Psychiatrist","ar":"\u0637\u0628\u064a\u0628 \u0646\u0641\u0633\u064a"}',
				'icon' => NULL,
				'slug' => '{"en":"psychiatrist","ar":"\u0637\u0628\u064a\u0628-\u0646\u0641\u0633\u064a"}',
				'featured' => 1,
				'status' => 1,
                'position' => 3,
                'created_at' => '2022-04-07 00:00:00',
                'updated_at' => '2022-04-07 00:00:00',
                ),
        ));

    }
}
