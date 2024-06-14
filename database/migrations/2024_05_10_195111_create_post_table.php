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
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id_post');
            $table->string('name_post');
            $table->string('slug_post');
            $table->text('content_post')->nullable();
            $table->string('avatar_post')->nullable();
            $table->string('author_post');
            $table->string('poster_post');
            $table->string('status_post')->default(0);
            $table->string('tag_post')->nullable();
            $table->integer('view_post')->default(0)->nullable();
            $table->string('link_product_post')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
