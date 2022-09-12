<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add4ColumnsToCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupons', function (Blueprint $table) {

            $table->string('name')->nullable()->after('code');
            $table->string('description')->nullable()->after('name');
            $table->integer('limitationForSingleUser')->nullable()->after('name');
            $table->dateTime('from')->nullable()->after('minamount');
            $table->boolean('status')->default(0)->after('minamount');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupon', function (Blueprint $table) {
            //
        });
    }
}
