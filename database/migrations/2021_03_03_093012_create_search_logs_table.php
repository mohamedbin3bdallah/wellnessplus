<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_logs', function (Blueprint $table) {
            $table->id();
            $table->text('country')->nullable();
            $table->text('specialties')->nullable();
            $table->string('from' , 250 )->nullable();
            $table->string('to' , 250 )->nullable();
            $table->text('language')->nullable();
            $table->string('search_words' , 250 )->nullable();
            $table->biginteger('user_id')->nullable();
            $table->text('times')->nullable();
            $table->text('days')->nullable();
            $table->string('native_speaker' , 250 )->nullable();
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
        Schema::dropIfExists('search_logs');
    }
}
