<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Date;
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
        Schema::create('merchant_work_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('merchant_id');
            $table->string('job_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->longText('job_description')->nullable();
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
        Schema::dropIfExists('merchant_work_histories');
    }
};
