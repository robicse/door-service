<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_contact_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->string('service_name')->nullable();
            $table->string('service_price')->nullable();
            $table->string('patient_name')->nullable();
            $table->integer('age')->nullable();
            $table->string('disease')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('assign_to')->nullable();
            $table->string('assign_amount')->nullable();
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_contact_details');
    }
}
