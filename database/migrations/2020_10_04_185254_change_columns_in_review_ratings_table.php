<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsInReviewRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_ratings', function (Blueprint $table) {
            $table->string('user_id')->nullable()->change();
            $table->integer('learn')->nullable()->change();
            $table->integer('price')->nullable()->change();
            $table->boolean('status')->nullable()->change();
            $table->boolean('approved')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_ratings', function (Blueprint $table) {
            //
        });
    }
}
