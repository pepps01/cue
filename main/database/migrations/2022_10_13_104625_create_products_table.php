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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('serial')->unique();
            $table->foreignUuid('merchant_id');
            $table->foreignUuid('user_id');
            $table->string('name')->nullable();
            $table->string('brand')->nullable();
            $table->float('price', 10, 2)->nullable();
            $table->longText('description')->nullable();
            $table->float('weight', 10, 2)->nullable();
            $table->foreignUuid('category_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->enum('free_delivery', ['Yes', 'No'])->default('Yes');
            $table->float('shipping_fee', 10, 2)->default(0);
            $table->string('product_warranty')->nullable();
            $table->enum('discount_available', ['Yes', 'No']);
            $table->float('discount_percentage', 10, 2)->default(0);
            $table->float('discount_amount', 10, 2)->nullable();
            $table->integer('number_of_orders')->default(0);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('products');
    }
};
