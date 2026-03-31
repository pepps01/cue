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
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('serial')->unique();
            $table->foreignUuid('merchant_id');
            $table->foreignUuid('user_id');
            $table->string('service_name')->nullable();
            $table->foreignUuid('category_id')->nullable();
            $table->integer('years_of_exp')->nullable();
            $table->string('amount')->nullable();
            $table->string('location')->nullable();
            $table->string('state')->nullable();
            $table->string('lga')->nullable();
            $table->string('phone_number')->nullable();
            $table->json('other_details')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('services');
    }
};
