<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAndChangeColumnInReviewRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_ratings', function (Blueprint $table) {
            $table->integer('tutor_id')->nullable();
            $table->string('course_id')->nullable()->change();
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
            $table->dropColumn('tutor_id');

        });
    }
}
