<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkHospitalToInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            //
            $table->string('work_center')->nullable();
			$table->string('center')->nullable();
			$table->string('work_hospital')->nullable();
			$table->string('hospital')->nullable();
			$table->string('work_sanatorium')->nullable();
            $table->string('sanatorium')->nullable();
            $table->text('social_links')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructors', function (Blueprint $table) {
            //
		

            

        });
    }
}
