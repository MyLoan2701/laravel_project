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
        Schema::create('statistic', function (Blueprint $table) {
            $table->increments('id_statistic');
            $table->string('date_order_statistic');
            $table->string('sales_statistic');
            $table->string('profit_statistic');
            $table->integer('quantity_statistic');
            $table->integer('total_order_statistic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistical');
    }
};
