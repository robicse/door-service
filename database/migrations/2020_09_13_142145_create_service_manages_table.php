<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_manages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_id');
            $table->string('sub_category');
            $table->string('parent');
            $table->string('service_name');
            $table->string('service_type');
            $table->string('slug');
            $table->longText('description');
            $table->string('image');
            $table->string('icon_image');
            $table->integer('home_service_status')->default(0);
            $table->integer('trending_service_status')->default(0);
            $table->integer('recommended_service_status')->default(0);
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
        Schema::dropIfExists('service_manages');
    }
}
