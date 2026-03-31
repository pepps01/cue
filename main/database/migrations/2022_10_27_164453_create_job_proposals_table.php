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
        Schema::create('job_proposals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('job_id');
            $table->foreignUuid('consumer_id');
            $table->foreignUuid('merchant_id');
            $table->foreignUuid('user_id');
            $table->enum('payment_option', ['by_milestone', 'by_project']);
            $table->string('total_price')->default(0);
            $table->string('num_of_milestones')->nullable();
            $table->string('expected_amount')->default(0)->nullable();
            $table->string('expected_duration');
            $table->longText('cover_letter')->nullable();
            $table->longText('review_comment')->nullable();
            $table->longText('rejection_reason')->nullable();
            $table->string('payment_status')->default("Pending");
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
        Schema::dropIfExists('job_proposals');
    }
};
