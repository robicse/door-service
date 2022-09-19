<?php

namespace App\Http\Resources;

use App\OrderVendor;
use App\User;
use App\VendorDetails;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $order_vendors = OrderVendor::where('order_id',$data->id)->get();
                $vendor_details = VendorDetails::where('user_id',$data->vendor_id)->first();
                $v_array = [];
                if ($data->status_id != 4){
                    foreach ($order_vendors as $order_vendor){
                        $vendor_detail = VendorDetails::where('user_id',$order_vendor->vendor_id)->first();
                        $vendor['id'] =(integer) $order_vendor->vendor_id;
                        $vendor['image'] =(string) 'profile/'.$order_vendor->vendor->image;
                        $vendor['name'] = (string) $order_vendor->vendor->name;
                        $vendor['address'] =(string) $vendor_detail->address;
                        $vendor['rating'] = (float) vendorRating($order_vendor->vendor_id);
                        $vendor_info = json_encode($vendor);
                        array_push($v_array,$vendor_info);
                    }
                }else{
                    $vendor = User::find($data->vendor_id);
//                    $v_array['id'] = (integer) $data->vendor_id;
//                    $v_array['image'] =(string) 'profile/'.$vendor->image;
//                    $v_array['name'] =(string) $vendor->name;
//                    $v_array['address'] =(string) $vendor_details->address;
//                    $v_array['rating'] = (float) vendorRating($data->vendor_id);

                    $vendor['id'] =(integer) $data->vendor_id;
                    $vendor['image'] =(string) 'profile/'.$vendor->image;
                    $vendor['name'] = (string) $vendor->name;
                    $vendor['address'] =(string) $vendor_details->address;
                    $vendor['rating'] = (float) vendorRating($data->vendor_id);
                    $vendor_info = json_encode($vendor);
                    array_push($v_array,$vendor_info);
                }


                return [
                    'id' => $data->id,
                    'user_id' => (integer) $data->user_id,
                    'shipping_address' => (object) $data->shipping_address,
//                    'vendor_id' => (integer) $data->vendor_id,
                    'vendor' =>  $v_array,
                    'payment_process' => (string) $data->payment_process,
                    'payment_type' => (string) $data->payment_type,
                    'payment_status' => (integer) $data->payment_status,
                    'transaction_id' => (string) $data->transaction_id,
                    'ssl_status' => (string) $data->ssl_status,
                    'currency' => (string) $data->currency,
                    'payment_details' => (string) $data->payment_details,
                    'coupon_discount' => (string) $data->coupon_discount,
                    'invoice_code' => (string) $data->invoice_code,
                    'old_total' => (string) $data->old_total,
                    'grand_total' => (string) $data->grand_total,
                    'discount' => (integer) $data->discount,
                    'delivery_cost' => (string) $data->delivery_cost,
                    'status_id' => (integer) $data->status_id,
                    'view' => (string) $data->view,
                    'vendor_id' => $data->vendor_id,
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
