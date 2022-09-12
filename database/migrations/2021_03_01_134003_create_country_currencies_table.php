<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('country', 191 )->nullable();
            $table->string('currency', 191 )->nullable();
            $table->string('code', 191 )->nullable();
            $table->string('symbol', 191 )->nullable();
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
        Schema::dropIfExists('country_currencies');
    }
}
