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
        Schema::create('sos_records', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('trip_id');
            $table->foreignUuid('initiated_by');
            $table->string('sos_location');
            $table->string('emergencyType')->nullable();
            $table->foreignUuid('rider_id');
            $table->foreignUuid('driver_id');
            $table->enum('status', ['Pending', 'Accepted', 'Declined', 'Resolved'])->default('Pending');
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
        Schema::dropIfExists('sos_records');
    }
};
