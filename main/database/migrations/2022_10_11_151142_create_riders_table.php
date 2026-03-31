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
        Schema::create('riders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->string('home_location')->nullable();
            $table->string('home_long')->nullable();
            $table->string('home_lat')->nullable();
            $table->string('home_place_id')->nullable();
            $table->string('work_location')->nullable();
            $table->string('work_long')->nullable();
            $table->string('work_lat')->nullable();
            $table->string('work_place_id')->nullable();
            $table->integer('completed_rides')->default(0);
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
        Schema::dropIfExists('riders');
    }
};
