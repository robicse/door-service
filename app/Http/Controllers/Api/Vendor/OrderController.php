<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Events\OrderAcceptByVendor;
use App\Http\Controllers\Controller;
use App\Http\Resources\VendorOrderRequestCollection;
use App\Order;
use App\OrderDetails;
use App\OrderVendor;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class OrderController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;
     public function ongoingOrderList($id){
//         $orderReqToVendor = OrderVendor::where('vendor_id', Auth::id())->latest()->get();
         //$orderReqToVendor = DB::table('order_vendors')
//         $orderReqToVendor = OrderVendor::join('orders','orders.id','=','order_vendors.order_id')
//             ->where('orders.status_id','!=',4)
//             ->where('order_vendors.vendor_id', $id)
//             ->select('order_vendors.order_id','orders.user_id')
//             ->orderBy('order_vendors.id','DESC')
//             ->get();
         $orderReqToVendor = DB::table('order_vendors')
             ->join('orders','orders.id','=','order_vendors.order_id')
             ->where('order_vendors.vendor_id',$id)
             ->where('orders.status_id','!=',4)
             ->select('order_vendors.*')
             ->orderBy('order_vendors.id','DESC')
             ->get();
         return new VendorOrderRequestCollection($orderReqToVendor);
     }
     public function completedOrderList($id){
//         $orderReqToVendor = OrderVendor::where('vendor_id', Auth::id())->latest()->get();
         $orderReqToVendor = DB::table('order_vendors')
             ->join('orders','orders.id','=','order_vendors.order_id')
             ->where('order_vendors.vendor_id',$id)
             ->where('orders.status_id','=',4)
             ->select('order_vendors.*')
             ->orderBy('order_vendors.id','DESC')
             ->get();
         return new VendorOrderRequestCollection($orderReqToVendor);
     }
     public function deliveryStatusList(){
         $status = Status::select('id','name')->get();
         if (!empty($status)){
             return response()->json(['success'=>true,'response' => $status], $this->successStatus);
         }else{
             return response()->json(['success'=>false,'response' => 'Something went wrong'], $this->failStatus);
         }
     }
     public function deliveryStatusUpdate(Request $request){
         $order = Order::find($request->order_id);
         $order->status_id = $request->status_id;
         $update = $order->save();
         if (!empty($update)){
             return response()->json(['success'=>true,'response' => 'Delivery Status updated successfully'], $this->successStatus);
         }else{
             return response()->json(['success'=>false,'response' => 'Something went wrong'], $this->failStatus);
         }

     }
     public function orderAccept(Request $request, $order_id, $vendor_id){
         $order = Order::find($order_id);
         if ($request->status == 'accept') {
             if (empty($order->vendor_id)) {
//                $order->vendor_id = Auth::id();
//                $order->save();
                 $ven=OrderVendor::where('vendor_id',$vendor_id)->where('order_id',$order_id)->where('user_id',null)->first();
                 if(!empty($ven)){
                     $ven->chat_id="id_".$ven->id."-"."orderId_".$ven->order_id."-"."vendorId_".$ven->vendor_id;
                     $ven->user_id=$order->user_id;
                     $ven->update();

                     $options = array(
                         'cluster' => 'ap2',
                         'useTLS' => true
                     );
                     $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), $options);
                     $data = ['userId' => $order->user_id];
                     event(new OrderAcceptByVendor($data));
                     return response()->json(['success'=>true,'response' => 'Order Accepted.'], $this->successStatus);
                 }else{
                     return response()->json(['success'=>false,'response' => 'Order already accepted.'], 409);
                 }
             }else{
                 return response()->json(['success'=>false,'response' => 'Order already assigned.'], 409);
             }
         }else{
             return response()->json(['success'=>false,'response' => "It's ok!! Next time try. Thanks!"], $this->failStatus);
         }
     }

}
