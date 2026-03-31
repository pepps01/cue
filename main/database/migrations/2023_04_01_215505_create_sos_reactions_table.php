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
        Schema::create('sos_reactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sos_id');
            $table->foreignUuid('distressed_user');
            $table->foreignUuid('accepted_by');
            $table->string('accept_location');
            $table->dateTime('accepted_at');
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
        Schema::dropIfExists('sos_reactions');
    }
};
