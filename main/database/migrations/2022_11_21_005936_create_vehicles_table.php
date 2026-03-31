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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('driver_id');
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->enum('status', [config('constants.vehicle.status')])->default(config('constants.vehicle.status.econonmy'));
            $table->string('color')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('car_interior_photo')->nullable();
            $table->string('car_exterior_photo')->nullable();
            $table->string('plate_number_on_car_photo')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
};
