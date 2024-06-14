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
        Schema::create('client', function (Blueprint $table) {
            $table->increments('id_client');
            $table->string('email');
            $table->string('password');
            $table->string('name', 100);
            $table->string('status', 10)->default(0);
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('sex', 10)->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('email_verified_at');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
