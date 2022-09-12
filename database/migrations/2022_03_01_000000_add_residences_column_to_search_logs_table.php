<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResidencesColumnToSearchLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('search_logs', function (Blueprint $table) {
            $table->text('residences')->nullable()->after('country');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('search_logs', function (Blueprint $table) {
            $table->dropColumn('residences');

        });
    }
}
