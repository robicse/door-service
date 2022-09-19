<?php

namespace App\Http\Controllers\Admin;

use App\Events\MyEvent;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Order;
use App\OrderVendor;
use App\VendorDetails;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Pusher\Pusher;

class OrderController extends Controller
{
    public function OrderList()
    {
        $orders = Order::latest()->get();
        return view('backend.admin.order-history.order', compact('orders'));
    }

    public function OrderListAccepted()
    {
        $acceptedOrders = Order::where('status_id',1)->latest()->get();
        return view('backend.admin.order-history.accepted_order', compact('acceptedOrders'));
    }
    public function OrderListPending()
    {
        $pendingOrders = Order::where('status_id',2)->latest()->get();
        return view('backend.admin.order-history.pending_order', compact('pendingOrders'));
    }
    public function OrderListOnReview()
    {
        $onReviewOrders = Order::where('status_id',3)->latest()->get();
        return view('backend.admin.order-history.on_review_order', compact('onReviewOrders'));
    }
    public function OrderListComplete()
    {
        $completeOrders = Order::where('status_id',4)->latest()->get();
        return view('backend.admin.order-history.complete_order', compact('completeOrders'));
    }
    public function OrderListCancel()
    {
        $cancelOrders = Order::where('status_id',5)->latest()->get();
        return view('backend.admin.order-history.cancel_order', compact('cancelOrders'));
    }
    public function orderDetails($id)
    {
        $order = Order::find($id);
        return view('backend.admin.order-history.order_details', compact('order'));
    }



    public function OrderAssignToVendor($id)
    {

        $order = Order::find($id);
        $shippingInfo = json_decode($order->shipping_address);
        $lat = $shippingInfo->lat;
        $lng = $shippingInfo->lng;
        $vendors= VendorDetails::whereBetween('services_latitude',[$lat-0.07,$lat+0.07])
            ->whereBetween('services_longitude',[$lng-0.07,$lng+0.07])
            ->where('status',1)->get();
        if (empty($vendors)) {
            $vendors= VendorDetails::whereBetween('services_latitude',[$lat-0.10,$lat+0.10])
                ->whereBetween('services_longitude',[$lng-0.10,$lng+0.10])
                ->where('status',1)->get();
        }

        return response()->json(['success'=> true, 'response'=>$vendors]);

    }

    public function OrderAssignToVendorStore($vendorId, $orderId)
    {
        //return response()->json(['success'=> true, 'response'=>$vendorId, 'orderId' => $orderId]);
        if (empty($vendorId) || empty($orderId)) {
            return response()->json(['success'=> 0]);
        }
        $check = OrderVendor::where('order_id', $orderId)->where('vendor_id',$vendorId)->first();
        if(!empty($check)) {
            //Toastr::warning('This vendor assign to this order already');
            return response()->json(['success'=> true, 'response'=>0]);
        }else {
            $orderVendor = new OrderVendor();
            $orderVendor->order_id = $orderId;
            $orderVendor->vendor_id = $vendorId;
            $orderVendor->save();

            $ven = OrderVendor::find($orderVendor->id);
            $ven->chat_id="id_".$orderVendor->id."-"."orderId_".$orderId."-"."vendorId_".$vendorId;
            $ven->update();

            $notification = new Notification();
            $notification->from = $vendorId;
            $notification->message = 'One order created, if you want you can take this order';
            $notification->is_read = 0;
            $notification->save();

            $options = array(
                'cluster' => 'ap2',
                'useTLS' => true
            );
            $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), $options);

            $data = ['from' => $notification->from];
            event(new MyEvent($data));
            //$pusher->trigger('my-channel', 'my-event', $data);
            return response()->json(['success'=> true, 'response'=>1]);
        }


    }




}
