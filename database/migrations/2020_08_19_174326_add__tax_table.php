<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('taxes')){
            Schema::create('taxes', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('name', 191)->nullable();
                $table->double('rate')->nullable();
                $table->boolean('status')->default(0);
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
        Schema::drop('taxes');
    }
}
