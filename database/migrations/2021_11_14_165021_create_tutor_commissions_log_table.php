<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorCommissionsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tutor_commissions_log')){

            Schema::create('tutor_commissions_log', function (Blueprint $table) {
                $table->increments('id');
				$table->unsignedBigInteger('user_id');
				$table->foreign('user_id')->references('id')->on('users');
				$table->unsignedBigInteger('tutor_id');
				$table->foreign('tutor_id')->references('id')->on('instructors');
				$table->unsignedBigInteger('appointment_id');
				$table->foreign('appointment_id')->references('id')->on('appointments');
				$table->float('value', 8, 2);
				$table->string('action');
				$table->unsignedBigInteger('created_by');
				$table->foreign('created_by')->references('id')->on('users');
				$table->unsignedBigInteger('updated_by');
				$table->foreign('updated_by')->references('id')->on('users');
                $table->timestamps();
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
        Schema::dropIfExists('tutor_commissions_log');
    }
}
