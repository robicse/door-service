<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('subcategory_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->float('buying_price',8,2)->nullable();
            $table->float('regular_price',8,2)->nullable();
            $table->float('sale_price',8,2)->nullable();
            $table->integer('flash_sale')->nullable();
            $table->float('flash_sale_price',8,2)->nullable();
            $table->integer('quantity')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('gallery_1')->nullable();
            $table->string('gallery_1_alt')->nullable();
            $table->string('gallery_2')->nullable();
            $table->string('gallery_2_alt')->nullable();
            $table->string('gallery_3')->nullable();
            $table->string('gallery_3_alt')->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->timestamps();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
