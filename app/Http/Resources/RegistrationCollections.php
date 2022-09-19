<?php

namespace App\Http\Resources;

use App\VendorDetails;
use App\VendorService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RegistrationCollections extends ResourceCollection
{
    public function toArray($request)
    {
        //dd($request->password);
        return [
            'data' => $this->collection->map(function($data) {

                return [
                    //dd($data),
                    'id' => $data->id,
                    'role_id' => (int) $data->role_id,
                    'type' => (string) $data->role_id == 3 ? 'User' : 'Vendor',
                    'is_vendor_profile' =>  '',
                    'address' =>  '',
                    'rating' =>  0,
                    'name' => (string) $data->name,
                    'email' => (string) $data->email,
                    'mobile_number' => (string) $data->mobile_number,
                    'status' => (string) $data->status,
                    'is_profile_complete' => (string) $data->is_profile_complete,
                    'image' => (string) $data->image,
                    'key' => encrypt($data->password),
                    'token' => '',
                    'firebase_token' => '',
//                    'vendor' => new VendorDetailDataCollections(VendorDetails::where('user_id',$data->id )->get()),
//                    'vendor_services' => new VendorServiceDataCollections(VendorService::where('vendor_id',$data->id)->get()),
//                    'links' => [
//                        'vendor_detail' => route('vendor.detail', $data->user_id),
//                    ]
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
