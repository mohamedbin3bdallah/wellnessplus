<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSenderIdToMessengerMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messenger_messages', function (Blueprint $table) {
            $table->biginteger('sender_id')->nullable();
            $table->tinyinteger('is_read')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messenger_messages', function (Blueprint $table) {
            $table->dropColumn('sender_id');
            $table->dropColumn('is_read');
        });
    }
}
