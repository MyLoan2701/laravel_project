<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fee_ship2', function (Blueprint $table) {
            $table->increments('id_fee');
            $table->integer('id_tp');
            $table->integer('price_fee');

            $table->foreign('id_tp')->references('id_tp')->on('tinhthanhpho');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_ship2');
    }
};
