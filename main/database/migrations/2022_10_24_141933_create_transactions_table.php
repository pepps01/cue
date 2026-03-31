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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('serial')->unique();
            $table->foreignUuid('user_id');
            $table->string('fullname')->nullable();
            $table->string('application_name')->nullable();
            $table->string('amount');
            $table->string('payment_method')->nullable();
            $table->string('purpose')->nullable();
            $table->string('payment_reference')->unique()->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
