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
        Schema::create('cue_chow_vendors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->string('business_name')->nullable();
            $table->string('business_type')->nullable();
            $table->foreignId('restaurant_type_id')->nullable();
            $table->string('business_location')->nullable();
            $table->string('business_email')->nullable();
            $table->string('business_phone')->nullable();
            $table->integer('no_of_stores')->nullable();
            $table->string('delivery_type')->nullable();
            $table->longText('opening_days')->nullable();
            $table->string('opening_hours')->nullable();
            $table->string('closing_hours')->nullable();
            $table->string('tax_id')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_opened')->default(false);
            $table->integer('ratings')->default(0);
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
        Schema::dropIfExists('cue_chow_vendors');
    }
};
