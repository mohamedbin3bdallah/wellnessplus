<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCoubonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('student_coupons')){

            Schema::create('student_coupons', function (Blueprint $table) {
                $table->increments('id');
				$table->unsignedBigInteger('user_id');
				$table->foreign('user_id')->references('id')->on('users');
				$table->unsignedBigInteger('coupon_id');
				$table->foreign('coupon_id')->references('id')->on('coupons');
				$table->boolean('done');
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
        Schema::dropIfExists('student_coupons');
    }
}
