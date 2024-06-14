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
        Schema::create('quanhuyen', function (Blueprint $table) {
            $table->integer('id_qh')->primary();
            $table->string('name_qh');
            $table->string('type_qh');
            $table->integer('id_tp');

            $table->foreign('id_tp')->references('id_tp')->on('tinhthanhpho');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quanhuyen');
    }
};
