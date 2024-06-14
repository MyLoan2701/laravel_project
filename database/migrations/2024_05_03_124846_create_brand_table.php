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
        Schema::create('brand', function (Blueprint $table) {
            $table->increments('id_brand');
            $table->string('name_brand');
            $table->string('slug_brand');
            $table->string('status_brand', 10)->default(0);
            $table->string('parent_brand', 10)->default(0);
            $table->text('description_brand')->nullable();
            $table->string('key_brand')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand');
    }
};
