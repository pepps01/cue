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
        Schema::create('rider_reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('rider_id');
            $table->foreignUuid('driver_user_id');
            $table->string('reviewer');
            $table->integer('rating');
            $table->longText('review');
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
        Schema::dropIfExists('rider_reviews');
    }
};
