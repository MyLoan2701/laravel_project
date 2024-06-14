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
        Schema::create('xaphuongthitran', function (Blueprint $table) {
            $table->integer('id_xp')->primary();
            $table->string('name_xp');
            $table->string('type_xp');
            $table->integer('id_qh');

            $table->foreign('id_qh')->references('id_qh')->on('quanhuyen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xaphuongthitran');
    }
};
