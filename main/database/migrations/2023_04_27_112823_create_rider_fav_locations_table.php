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
        Schema::create('rider_fav_locations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('rider_id');
            $table->string('fav_location')->nullable();
            $table->string('fav_long')->nullable();
            $table->string('fav_lat')->nullable();
            $table->string('fav_place_id')->nullable();
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
        Schema::dropIfExists('rider_fav_locations');
    }
};
