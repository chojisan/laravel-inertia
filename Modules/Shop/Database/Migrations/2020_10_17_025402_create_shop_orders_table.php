<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->string('shipping_option');
            $table->string('payment_option');
            $table->foreignId('order_status_id');
            $table->foreignId('currency_id')->nullable()->default(null);
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('shipping_address_id')->nullable();
            $table->foreignId('billing_address_id')->nullable();
            $table->string('track_code')->nullable();
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
        Schema::dropIfExists('shop_orders');
    }
}
