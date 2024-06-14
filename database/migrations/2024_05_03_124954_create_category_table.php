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
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id_category');
            $table->integer('id_brand')->unsigned();
            $table->string('name_category');
            $table->text('description_category')->nullable();
            $table->string('slug_category');
            $table->string('key_category')->nullable();
            $table->string('img_category')->nullable();
            $table->string('status_category', 10)->default(0);
            $table->timestamps();
            
            $table->foreign('id_brand')->references('id_brand')->on('brand');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
