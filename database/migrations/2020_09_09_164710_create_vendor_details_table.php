<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('status');
            $table->string('account_category');
            $table->string('vendor_company_name')->nullable();
            $table->string('service_category')->nullable();
            $table->string('sub_service_category')->nullable();
            $table->longText('address')->nullable();
            $table->string('practical_experiences')->nullable();
            $table->string('ven_service_provide_schedule')->nullable();
            $table->string('ven_service_provide_time')->nullable();
            $table->string('services_longitude')->nullable();
            $table->string('services_latitude')->nullable();
            $table->string('services_city')->nullable();
            $table->string('services_area')->nullable();
            $table->string('trade_license_number')->nullable();
            $table->string('validity_of_license')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('trade_lic_incorporation_copy')->nullable();
            $table->string('upload_clear_photo_showroom')->nullable();
            $table->string('vendor_image')->nullable();
            $table->string('vendor_nid')->nullable();
            $table->longText('short_bio')->nullable();
            $table->string('comple_service_photo')->nullable();
            $table->longText('vendor_feedback')->nullable();
            $table->string('professional_ref_name')->nullable();
            $table->string('professional_ref_number')->nullable();
            $table->string('personal_ref_name')->nullable();
            $table->string('personal_ref_mobile')->nullable();
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
        Schema::dropIfExists('vendor_details');
    }
}
