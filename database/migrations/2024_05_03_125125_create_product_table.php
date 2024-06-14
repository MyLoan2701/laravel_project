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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id_product');
            $table->integer('id_category')->unsigned();
            $table->integer('id_brand')->unsigned();
            $table->string('name_product');
            $table->integer('price_product', 100);
            $table->integer('priceOld_product', 100);
            $table->integer('priceOrigin_product', 100);
            $table->string('type_brand_product')->nullable();;
            $table->string('status_product')->default('0');
            $table->text('description_product')->nullable();
            $table->text('info_product')->nullable();
            $table->string('img_product')->nullable();
            $table->integer('sale_product')->nullable();
            $table->integer('stock_product');
            $table->integer('stock2_product');
            $table->integer('sold_product')->nullable();
            $table->date('release_product')->nullable();
            $table->integer('view_product')->default('0')->nullable();
            $table->timestamps();

            $table->foreign('id_category')->references('id_category')->on('category');
            $table->foreign('id_brand')->references('id_brand')->on('brand');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
