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
        Schema::create('job_proposal_milestones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('proposal_id');
            $table->string('description')->nullable();
            $table->date('due_date')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('job_proposal_milestones');
    }
};
