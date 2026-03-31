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
        Schema::create('trip_pricings', function (Blueprint $table) {
            $table->id();
            $table->string('base_fare')->default(400);
            $table->string('minimum_fare')->default(600);
            $table->string('distance_rate_per_km')->default(90);
            $table->string('time_rate_per_min')->default(15);
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
        Schema::dropIfExists('trip_pricings');
    }
};
