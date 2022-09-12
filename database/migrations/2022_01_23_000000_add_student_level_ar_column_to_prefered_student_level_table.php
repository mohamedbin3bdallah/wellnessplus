<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentLevelArColumnToPreferedStudentLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prefered_student_level', function (Blueprint $table) {
            $table->string('student_level_ar')->nullable()->after('student_level');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prefered_student_level', function (Blueprint $table) {
            $table->dropColumn('student_level_ar');

        });
    }
}
