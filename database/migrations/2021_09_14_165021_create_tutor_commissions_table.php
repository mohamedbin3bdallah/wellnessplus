<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tutor_commissions')){

            Schema::create('tutor_commissions', function (Blueprint $table) {
                $table->increments('id');
				$table->unsignedBigInteger('user_id');
				$table->foreign('user_id')->references('id')->on('users');
				$table->unsignedBigInteger('tutor_id');
				$table->foreign('tutor_id')->references('id')->on('instructors');
				$table->unsignedBigInteger('appointment_id');
				$table->foreign('appointment_id')->references('id')->on('appointments');
				$table->unsignedBigInteger('organization_id');
				$table->foreign('organization_id')->references('id')->on('organizations');
				$table->float('originalvalue', 8, 2);
				$table->integer('commissionrate');
				$table->float('commissionvalue', 8, 2);
				$table->boolean('active');
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
        Schema::dropIfExists('tutor_commissions');
    }
}
