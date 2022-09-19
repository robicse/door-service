<?php

namespace App\Http\Controllers\Vendor;

use App\Events\OrderAcceptByVendor;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderCommission;
use App\OrderVendor;
use App\PaymentHistory;
use App\Status;
use App\VendorOrderStatus;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use Kreait\Laravel\Firebase\Facades\Firebase;

class OrderRequestController extends Controller
{
    public function showList()
    {
        $orderReqToVendor = OrderVendor::where('vendor_id', Auth::id())->latest()->get();
        $orderStatus = Status::all();
        return view('backend.vendor.request_order', compact('orderReqToVendor','orderStatus'));
    }
    public function orderAccept(Request $request)
    {
        $order = Order::find($request->order_id);
        if ($request->status == 'receive') {
            if (empty($order->vendor_id)) {
//                $order->vendor_id = Auth::id();
//                $order->save();
                $ven=OrderVendor::where('vendor_id',Auth::id())->where('order_id',$request->order_id)->where('user_id',null)->first();

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
                    Toastr::success("Order Accepted.");
                    return redirect()->back();
                }else{
                    Toastr::warning("Order already accepted.");
                    return redirect()->back();
                }
            }else{
                Toastr::warning("Order already assigned.");
                return redirect()->back();
            }
        }else{
            Toastr::success("It's ok!! Next time try. Thanks!");
            return redirect()->back();
        }
    }
    public function orderPayment($id){
        $order = Order::find($id);
        //$commission = OrderCommission::first();
//        $commissionValue = $order->grand_total*$commission->commission_percentage / 100;
        $commissionValue = 0;
        if($order->payment_status==0){
            $order->payment_status = 1;
            $order->save();

            $payment = new PaymentHistory();
            $payment->order_id = $order->id;
            //$payment->payment_type = $order->payment_type;
            $payment->payment_type = 'cod';
            $payment->vendor_amount = $order->grand_total - $commissionValue;
            $payment->admin_amount =$commissionValue;
            $payment->created_at =date('Y-m-d H:i:s');
            $payment->updated_at =date('Y-m-d H:i:s');
            $payment->save();

            Toastr::success("Payment Done Successfully");
            return redirect()->back();
        }else{
            Toastr::warning("Already Paid");
            return redirect()->back();
        }
    }
    public function orderDetails($id)
    {
        $order = Order::find($id);
        return view('backend.vendor.request_order_details', compact('order'));
    }
    public function quotation($id)
    {
        $order = Order::find($id);
        $orderVendor=OrderVendor::where('order_id',$order->id)->where('vendor_id',Auth::id())->whereNotNull('chat_id')->first();

//        if(!empty($orderVendor)){
//            $docRef = Firebase::firestore()->database()->collection('conversation')->document($orderVendor->chat_id);
//            $snapshot = $docRef->snapshot();
//
//            if ($snapshot->exists()) {
//                $vndMes=$snapshot->data();
//                return view('backend.vendor.vendor_chat', compact('order','vndMes','orderVendor'));
//            } else {
//                dd('Document %s does not exist!');
//            }
//            return view('backend.vendor.vendor_chat', compact('order'));
//        }else{
//            return redirect()->back();
//        }
        return view('backend.vendor.vendor_chat', compact('order','orderVendor'));
    }
    public function orderStatusChange(Request $request, $id){
        $order = Order::find($id);
        $order->status_id = $request->status_id;
        $order->save();
        $vendorOrderStatus = VendorOrderStatus::where('order_id',$id)->where('user_id',Auth::id())->first();
        $vendorStatus = new VendorOrderStatus();
        $vendorStatus->user_id = Auth::id();
        $vendorStatus->order_id = $order->id;
        $vendorStatus->status_id = $request->status_id;
        $vendorStatus->save();
        Toastr::success("Order Status Changed Successfully.");
        return redirect()->back();

    }

    public function orderDetailCommunicationAccept(Request $request){
        //dd($request->all());
        $orderVendor = OrderVendor::find($request->order_vendor_id);
        $orderVendor->vendor_view = 1;
        $orderVendor->vendor_approve_status = $request->vendor_approve_status;
        $orderVendor->save();

        Toastr::success("Order Status Changed Successfully.");
        return redirect()->back();

    }
}
