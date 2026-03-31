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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->string('headline')->nullable();
            $table->json('skills_needed')->nullable();
            $table->string('experience_level')->nullable();
            $table->string('job_duration')->nullable();
            $table->enum('job_scope', ['Large', 'Medium', 'Small'])->nullable();
            $table->string('budget')->nullable();
            $table->boolean('is_budget_negotiable')->default(true);
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
        Schema::dropIfExists('job_postings');
    }
};
