<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('description')->nullable()->default(null);
            $table->boolean('status')->nullable()->default(false);
            $table->enum('type', ['PERCENTAGE', 'FIXED', 'FREE_SHIPPING'])->nullable()->default(null);
            $table->decimal('amount', 10, 4)->nullable()->default(null);
            $table->timestamp('active_from')->nullable()->default(null);
            $table->timestamp('active_till')->nullable()->default(null);
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
        Schema::dropIfExists('shop_vouchers');
    }
}
