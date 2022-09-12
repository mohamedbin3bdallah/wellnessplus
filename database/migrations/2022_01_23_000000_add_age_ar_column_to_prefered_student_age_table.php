<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgeArColumnToPreferedStudentAgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prefered_student_age', function (Blueprint $table) {
            $table->string('age_ar')->nullable()->after('age');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prefered_student_age', function (Blueprint $table) {
            $table->dropColumn('age_ar');

        });
    }
}
