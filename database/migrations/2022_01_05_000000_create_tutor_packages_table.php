<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tutor_packages')){

            Schema::create('tutor_packages', function (Blueprint $table) {
                $table->increments('id');
				$table->unsignedBigInteger('tutor_id');
				$table->foreign('tutor_id')->references('id')->on('instructors');
				$table->string('name');
				$table->string('title');
				$table->text('description');
				$table->integer('numOfHours');
				$table->float('origenalPrice', 8, 2);
				$table->float('discountPrice', 8, 2);
				$table->float('pricePerHour', 8, 2);
				$table->float('totalPrice', 8, 2);
				$table->boolean('status')->default('0');
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
        Schema::dropIfExists('tutor_packages');
    }
}
