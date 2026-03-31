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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('consumer_user_id');
            $table->foreignUuid('merchant_user_id');
            $table->foreignUuid('service_id');
            $table->string('amountPaid')->nullable();
            $table->enum('payment_status', ["Pending", "Initiated", "Failed", "Completed"])->default("Pending");
            $table->enum('status', ['Requested', "Accepted", "Rejected", "Ongoing", "Completed", "Canceled"])->default("Requested");
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
        Schema::dropIfExists('service_requests');
    }
};
