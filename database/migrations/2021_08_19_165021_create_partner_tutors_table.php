<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('partner_tutors')){

            Schema::create('partner_tutors', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('partner_id');
				$table->foreign('partner_id')->references('id')->on('users');
				$table->unsignedBigInteger('tutor_id');
				$table->foreign('tutor_id')->references('user_id')->on('instructors');
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
        Schema::dropIfExists('partner_tutors');
    }
}
