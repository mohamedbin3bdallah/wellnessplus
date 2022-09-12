<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_packages', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id');
            $table->integer('user_id');
            $table->integer('tutor_id');
            $table->integer('numOfHours');
            $table->decimal('originalPricePerHour');
            $table->decimal('discountPercentage');
            $table->decimal('netPrice');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('paid')->default(0);
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
        Schema::dropIfExists('student_packages');
    }
}
