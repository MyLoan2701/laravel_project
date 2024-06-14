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
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id_comment');
            $table->integer('id_product');
            $table->integer('id_client');
            $table->integer('id_admin');
            $table->string('content_comment');
            $table->string('status_comment')->default(1);
            $table->string('name_comment');
            $table->string('email_comment');
            $table->text('rep_comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
