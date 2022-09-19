<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' =>(integer) $data->id,
                    'sender_id' =>(integer) $data->from,
                    'sender_name' =>(string) $data->sender->name,
                    'receiver_id' =>(integer) $data->to,
                    'receiver_name' =>(string) $data->receiver->name,
                    'message' =>(string) $data->message,
                    'status' =>(integer) $data->is_read,

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
