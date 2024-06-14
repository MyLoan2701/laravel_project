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
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id_order');
            $table->integer('id_client')->unsigned();
            $table->integer('id_payment')->unsigned();
            $table->string('code_order');
            $table->string('email_order');
            $table->string('name_order', 100);
            $table->string('status_order')->default('Đang chờ xử lý');
            $table->string('address_order');
            $table->string('phone_order');
            $table->string('code_coupon_order')->nullable();
            $table->string('price_coupon_order')->nullable();
            $table->string('fee_delivery_order')->nullable();
            $table->string('total_order');
            $table->text('note_order')->nullable();
            $table->text('note_a')->nullable();
            $table->timestamps();

            $table->foreign('id_client')->references('id_client')->on('client');
            $table->foreign('id_payment')->references('id_payment')->on('payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
