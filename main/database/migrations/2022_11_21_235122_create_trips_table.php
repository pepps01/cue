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
        Schema::create('trips', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('driver_id')->nullable();
            $table->foreignUuid('rider_id')->nullable();
            $table->float('base_price', 10, 2)->nullable();
            $table->float('total_price', 10, 2)->nullable();
            $table->integer('trip_duration')->nullable();
            $table->dateTime('driver_arrival_time')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->string('start_trip_location')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->string('end_trip_location')->nullable();
            $table->integer('total_duration_spent')->default(0);
            $table->string('distance_to_pickup')->nullable();
            $table->string('duration_to_pickup')->nullable();
            $table->string('request_location')->nullable();
            $table->dateTime('request_date_time')->nullable();
            $table->dateTime('request_acceptance_time')->nullable();
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->string('cancel_location')->nullable();
            $table->dateTime('cancel_date_time')->nullable();
            $table->string('canceled_by')->nullable();
            $table->integer('total_distance_covered')->default(0);
            $table->enum('status', ['Requested', 'Canceled', 'Accepted', 'Arrived', 'Rejected', 'Ongoing', 'Completed'])->default('Requested');
            $table->boolean('is_paid')->default(false);
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
        Schema::dropIfExists('trips');
    }
};
