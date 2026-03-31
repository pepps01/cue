<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('product_id');
            $table->foreignUuid('seller_id');
            $table->foreignUuid('buyer_id');
            $table->string('price')->nullable();
            $table->string('quantity')->nullable();
            $table->string('delivery_charge')->nullable();
            $table->string('exp_delivery_date')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('state')->nullable();
            $table->string('lga')->nullable();
            $table->string('phone')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('status')->default("Pending");
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
};
