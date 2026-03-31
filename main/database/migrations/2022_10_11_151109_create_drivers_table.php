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
        Schema::create('drivers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->string('drivers_licence_number')->nullable();
            $table->string('drivers_licence_front')->nullable();
            $table->string('drivers_licence_back')->nullable();
            $table->integer('completed_rides')->default(0);
            $table->boolean('is_online')->default(false);
            $table->dateTime('came_online_at')->nullable();
            $table->dateTime('went_offline_at')->nullable();
            $table->string('total_online_duration')->default(0);
            $table->string('total_distance')->default(0);
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
        Schema::dropIfExists('drivers');
    }
};
