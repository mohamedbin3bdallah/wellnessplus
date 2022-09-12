<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('user_categories')){

            Schema::create('user_categories', function (Blueprint $table) {
                $table->increments('id');
				$table->unsignedBigInteger('user_id');
				$table->foreign('user_id')->references('id')->on('users');
				$table->unsignedBigInteger('subcategory_id');
				$table->foreign('subcategory_id')->references('id')->on('sub_categories');
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
        Schema::dropIfExists('user_categories');
    }
}
