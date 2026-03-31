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
        Schema::create('trip_earnings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('trip_id');
            $table->foreignUuid('driver_id');
            $table->string('rider');
            $table->double('trip_fare', 10, 2)->default(0);
            $table->double('trip_comm', 10, 2)->default(0);
            $table->double('added_tip', 10, 2)->default(0);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('trip_earnings');
    }
};
