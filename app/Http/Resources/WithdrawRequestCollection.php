<?php

namespace App\Http\Resources;

use App\ServiceCategory;
use App\ServiceManage;
use App\ServicesSubCategory;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WithdrawRequestCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
            if ($data->status == 1){
                $status = 'Paid';
            }else{
                $status = 'Not paid';
            }
                return [
                    'date' => date('j-m-Y',strtotime($data->created_at)),
                    'amount' => $data->amount,
                    'status' => $status,
                    'message' => $data->message,
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
