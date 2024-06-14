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
        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id_contact');
            $table->integer('id_client')->nullable();
            $table->string('name_contact');
            $table->string('email_contact');
            $table->string('phone_contact');
            $table->string('subject_contact');
            $table->string('message_contact');
            $table->string('status_contact')->default('Chờ phản hồi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};
