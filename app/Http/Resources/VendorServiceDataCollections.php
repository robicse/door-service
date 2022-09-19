<?php

namespace App\Http\Resources;

use App\ServiceCategory;
use App\ServiceManage;
use App\ServicesSubCategory;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VendorServiceDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $service_category = ServiceCategory::where('id',$data->category_id)->pluck('category')->first();
                $service_sub_category = ServicesSubCategory::where('id',$data->subcategory_id)->pluck('sub_category')->first();
                $service_name = ServiceManage::where('id',$data->service_id)->pluck('service_name')->first();
                return [
                    'vendor_service_id' =>(integer) $data->id,
                    'service_category_id' => $data->category_id,
                    'service_category_name' => $service_category,
                    'service_subcategory_id' => $data->subcategory_id,
                    'service_subcategory_name' => $service_sub_category,
                    'service_id' => $data->service_id,
                    'service_name' => (string) $service_name,
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
