<?php

namespace App\Http\Resources;

use App\Order;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderDetailDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {

                $order = Order::find($data->order_id);
                $shippingInfo = json_decode($order->shipping_address);
                $user = User::find($order->user_id);
                return [
                    'id' => $data->id,
                    'user_id' => (integer) $data->user_id,
                    'user_name' =>(string) $user->name,
                    'user_phone' =>(string) $user->mobile_number,
                    'user_image' =>(string) 'profile/'.$user->image,
                    'service_name' => (string) $data->service_name,
                    'service_type' => (string) $data->service_type,
                    'question_set' => (string) $data->question_set,
                    'answer_set' => (string) $data->answer_set,
                    'total' => (string) $data->total,
                    'service_date' => (string) $shippingInfo->service_date,
                    'shipping_address' => (string) $shippingInfo->address,
                    'order_status' => (integer) $order->status_id,
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
