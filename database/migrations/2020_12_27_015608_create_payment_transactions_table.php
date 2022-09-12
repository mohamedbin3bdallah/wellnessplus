<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_ref');
            $table->integer('user_id');
            $table->decimal('amount',8,2);
            $table->decimal('discount',8,2)->default(0)->nullable();
            $table->decimal('net_amount',8,2);
            $table->integer('status')->default(0);
            $table->string('payment_method')->nullable();
            $table->string('vendor_transaction_id')->nullable();
            $table->string('vendor_transaction_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_transactions');
    }
}
