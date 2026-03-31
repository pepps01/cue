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
        Schema::create('trip_location_pricing_luxuries', function (Blueprint $table) {
            $table->id();
            $table->string('state')->nullable();
            $table->string('state_id')->nullable();
            $table->string('areas')->nullable();
            $table->string('base_fare')->nullable();
            $table->string('minimum_fare')->nullable();
            $table->string('distance_rate_per_km')->nullable();
            $table->string('time_rate_per_min')->nullable();
            $table->string('total_price')->nullable();
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
        Schema::dropIfExists('trip_location_pricing_luxuries');
    }
};
