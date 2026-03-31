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
        Schema::create('merchant_education_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('merchant_id');
            $table->string('school_name');
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->string('degree')->nullable();
            $table->string('area_of_study')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('merchant_education_histories');
    }
};
