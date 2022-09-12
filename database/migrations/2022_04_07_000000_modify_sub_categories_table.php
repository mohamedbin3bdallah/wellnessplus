<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->integer('category_id')->change();
			$table->longText('title')->nullable()->change();
			$table->longText('slug')->nullable()->change();
			$table->boolean('status')->default('0')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_categories', function (Blueprint $table) {
			$table->string('category_id')->change();
            $table->string('title')->nullable()->change();
            $table->string('slug')->nullable()->change();
            $table->enum('status',['1','0'])->change();
        });
    }
}
