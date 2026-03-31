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
        Schema::create('merchants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->enum('merchant_type', ['personal', 'business']);
            $table->foreignUuid('category_id')->nullable();
            $table->longText('bio')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('cac_document')->nullable();
            $table->string('cac_number')->nullable();
            $table->string('identity_type')->nullable();
            $table->string('identity_document')->nullable();
            $table->string('job_title')->nullable();
            $table->string('years_of_experience')->nullable();
            $table->string('hours_per_week')->nullable();
            $table->string('charges_per_hour')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
};
