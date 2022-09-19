<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sub_category');
            $table->string('category_id');
            $table->string('banner')->nullable();
            $table->string('icon')->nullable();
            $table->longText('description')->nullable();
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_sub_categories');
    }
}
