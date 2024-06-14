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
        Schema::create('coupon', function (Blueprint $table) {
            $table->increments('id_coupon');
            $table->string('name_coupon');
            $table->string('code_coupon');
            $table->string('type_coupon');
            $table->string('price_coupon');
            $table->string('limit_coupon')->default('no');
            $table->integer('limit_number_coupon')->nullable();
            $table->date('date_coupon')->nullable();
            $table->date('exp_date_coupon')->nullable();
            $table->string('description_coupon')->nullable();
            $table->string('status_coupon')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon');
    }
};
