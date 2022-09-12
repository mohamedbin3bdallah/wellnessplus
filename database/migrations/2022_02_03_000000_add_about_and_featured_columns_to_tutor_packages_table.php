<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAboutAndFeaturedColumnsToTutorPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutor_packages', function (Blueprint $table) {
            $table->text('about')->after('title');
			$table->boolean('featured')->default(0)->after('status');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutor_packages', function (Blueprint $table) {
            $table->dropColumn('about');
			$table->dropColumn('featured');
        });
    }
}
