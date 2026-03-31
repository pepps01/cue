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
        Schema::create('sos_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sos_id');
            $table->foreignUuid('user_id');
            $table->longText('message')->nullable();
            $table->string('reported_from')->nullable();
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
        Schema::dropIfExists('sos_reports');
    }
};
