<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddZoneColumnToTutorScheduleTimeBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutor_schedule_time_blocks', function (Blueprint $table) {
            $table->string('zone')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutor_schedule_time_blocks', function (Blueprint $table) {
            $table->dropColumn('zone');

        });
    }
}
