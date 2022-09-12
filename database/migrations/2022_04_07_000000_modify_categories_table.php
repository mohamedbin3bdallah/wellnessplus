<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->longText('title')->nullable()->change();
			$table->longText('slug')->nullable()->change();
			$table->boolean('featured')->default('0')->change();
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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('title', 191)->nullable();
			$table->string('slug', 191)->nullable();
			$table->enum('featured', array('1','0'));
			$table->enum('status', array('1','0'));
        });
    }
}
