<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeZoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_zones', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('time_zone_name', 191)->nullable();
            $table->string('time', 20)->nullable();
            $table->string('status', 50)->nullable();
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
        Schema::dropIfExists('time_zones');
    }
}
