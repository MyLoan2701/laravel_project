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
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id_admin');
            $table->string('email_admin');
            $table->string('password_admin');
            $table->string('name_admin');
            $table->string('status_admin')->default(0);
            $table->string('phone_admin');
            $table->string('address_admin');
            $table->string('sex_admin');
            $table->string('birth_admin');
            $table->string('hometown_admin');
            $table->string('avatar_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
