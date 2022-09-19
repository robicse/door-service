<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->longText('shipping_address')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('ssl_status')->nullable();
            $table->string('currency')->nullable();
            $table->string('amount_after_getaway_fee')->nullable();
            $table->longText('payment_details')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('invoice_code')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('delivery_cost')->nullable();
            $table->string('delivery_status')->nullable();
            $table->string('view')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
