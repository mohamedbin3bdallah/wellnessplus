<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentHoursBalanceLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentHoursBalanceLogs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('tutor_id');
            $table->integer('studentHoursBalanceId');
            $table->decimal('numOfHours');
            $table->string('details')->comment('add/minus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studentHoursBalanceLogs');

    }
}
