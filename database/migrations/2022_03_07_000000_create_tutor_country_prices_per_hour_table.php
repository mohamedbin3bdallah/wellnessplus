<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorCountryPricesPerHourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tutor_country_prices_per_hour')){

            Schema::create('tutor_country_prices_per_hour', function (Blueprint $table) {
                $table->increments('id');
				$table->unsignedBigInteger('tutor_id');
				$table->foreign('tutor_id')->references('id')->on('instructors');
				$table->unsignedBigInteger('country_id');
				$table->foreign('country_id')->references('id')->on('allcountry');
				$table->float('pricePerHour', 8, 2);
				$table->string('currency')->default('USD');
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
        Schema::dropIfExists('tutor_country_prices_per_hour');
    }
}
