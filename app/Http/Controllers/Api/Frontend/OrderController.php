<?php


namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDataCollections;
use App\Http\Resources\OrderDetailDataCollections;
use App\OrderVendor;
use App\ServicesSubCategory;
use App\ServiceManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function userOrderList(Request $request, $user_id){

        $orderList= DB::table('orders')
            ->where('user_id','=',$user_id)
            ->where('status_id','=',4)
            ->get();

        return new OrderDataCollections($orderList);
    }
    public function userOrderOngoingList(Request $request, $user_id){

        $orderList= DB::table('orders')
            ->where('user_id','=',$user_id)
            ->where('status_id','!=',4)
            ->get();

        return new OrderDataCollections($orderList);
    }
    public function userOrderDetailList(Request $request, $order_id){

        $orderDetailList= DB::table('order_details')
            ->where('order_id','=',$order_id)
            ->get();

        return new OrderDetailDataCollections($orderDetailList);
    }
    public function getChatId($orderId, $vendorId){
        $chatId = OrderVendor::where('order_id',$orderId)->where('vendor_id',$vendorId)->pluck('chat_id');
        if (!empty($chatId)){
            return response()->json(['success'=> true, 'response'=>$chatId], $this-> successStatus);
        }else{
            return response()->json(['success'=> false, 'response'=>'Something went wrong'], $this-> failStatus);
        }

    }

}
