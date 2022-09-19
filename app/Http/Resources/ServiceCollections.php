<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'status' => (string) $data->status,
                    'account_category' => (string) $data->account_category,
                    'vendor_company_name' => (string) $data->vendor_company_name,
                    'address' => (string) $data->address,
                    'practical_experiences' => (string) $data->practical_experiences,
                    'month' => (string) $data->month,
                    'year' => (string) $data->year,
                    'ven_service_provide_schedule' => (string) $data->ven_service_provide_schedule,
                    'ven_service_provide_time' => (string) $data->ven_service_provide_time,
                    'services_longitude' => (string) $data->services_longitude,
                    'services_latitude' => (string) $data->services_latitude,
                    'services_city' => (string) $data->services_city,
                    'services_area' => (string) $data->services_area,
                    'trade_license_number' => (string) $data->trade_license_number,
                    'validity_of_license' => (string) $data->validity_of_license,
                    'bank_account_number' => (string) $data->bank_account_number,
                    'short_bio' => (string) $data->short_bio,
                    'vendor_feedback' => (string) $data->vendor_feedback,
                    'professional_ref_name' => (string) $data->professional_ref_name,
                    'professional_ref_number' => (string) $data->professional_ref_number,
                    'personal_ref_name' => (string) $data->personal_ref_name,
                    'personal_ref_mobile' => (string) $data->personal_ref_mobile,
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
