<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsFromInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('instructors', 'fname'))
        {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn(['fname', 'lname', 'email', 'dob', 'gender', 'languageSpoken', 'level', 'mobile', 'role']);

        });
        }
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
