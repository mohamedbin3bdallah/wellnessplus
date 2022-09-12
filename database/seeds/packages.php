<?php

use Illuminate\Database\Seeder;

class packages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('packages')->delete();

        \DB::table('packages')->insert(array (
            0 => array (
                'id' => 1,
                'name' => 'Casual',
                'numOfHours' => '6',
                'discountPercentage' => '5',
                'icon' => 'light.png',
                'active' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ),
            1 => array (
                'id' => 2,
                'name' => 'Dedicated',
                'numOfHours' => '12',
                'discountPercentage' =>'6',
                'icon' => 'plane.png',
                'active' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ),
            2 => array (
                'id' => 3,
                'name' => 'Unstoppable',
                'numOfHours' =>'20',
                'discountPercentage'=> '7',
                'icon' => 'rocket.png',
                'active' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ),

        ));


    }
}
