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
        Schema::create('sort', function (Blueprint $table) {
            $table->increments('id_sort');
            $table->integer('id_brand');
            $table->string('name_sort');
            $table->string('href_sort');
            $table->string('description_sort')->nullable();
            $table->string('from_sort', 100);
            $table->string('to_sort', 100);
            $table->string('status_sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sort');
    }
};
