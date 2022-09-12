<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('partner_students')){

            Schema::create('partner_students', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('partner_id');
				$table->foreign('partner_id')->references('id')->on('users');
				$table->unsignedBigInteger('student_id');
				$table->foreign('student_id')->references('id')->on('users');
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
        Schema::dropIfExists('partner_students');
    }
}
