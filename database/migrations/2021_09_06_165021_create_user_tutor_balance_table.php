<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTutorBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('user_tutor_balance')){

            Schema::create('user_tutor_balance', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('user_id');
				$table->foreign('user_id')->references('id')->on('users');
				$table->unsignedBigInteger('tutor_id');
				$table->foreign('tutor_id')->references('id')->on('instructors');
				$table->integer('balance');
				$table->unsignedBigInteger('created_by')->nullable();
				$table->foreign('created_by')->references('id')->on('users');
				$table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('user_tutor_balance');
    }
}
