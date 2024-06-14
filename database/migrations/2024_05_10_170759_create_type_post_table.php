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
        Schema::create('type_post', function (Blueprint $table) {
            $table->increments('id_typePost');
            $table->string('name_typePost');
            $table->string('slug_typePost');
            $table->string('description_typePost')->nullable();
            $table->string('status_typePost')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_post');
    }
};
