<?php
namespace App\Http\Controllers\API;

use App\Http\Resources\OrderVendorDataCollections;
use App\Order;
use App\OrderVendor;
use App\PaymentHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use \Firebase\JWT\JWT;
use Intervention\Image\Facades\Image;



class OrderController extends Controller
{

    public $successStatus = 200;
    public $failStatus = 401;

    public function userOrderRequestVendorList(Request $request,$order_id){
        $orderVendorList = OrderVendor::where('order_id',$order_id)->get();
        return new OrderVendorDataCollections($orderVendorList);
    }

    public function orderPayment(Request $request,$id){
        $order = Order::find($id);
        //$commission = OrderCommission::first();
//        $commissionValue = $order->grand_total*$commission->commission_percentage / 100;
        $commissionValue = 0;
        if($order->payment_status==0){
            $order->payment_status = 1;
            $order->grand_total = $request->amount;
            $order->save();
            $payment = new PaymentHistory();
            $payment->order_id = $order->id;
            $payment->payment_type = $order->payment_type;
            $payment->vendor_amount = $order->grand_total - $commissionValue;
            $payment->admin_amount =$commissionValue;
            $payment->save();
            return response()->json(['success'=> true, 'response'=>'Payment Done Successfully'], $this-> successStatus);
        }else{
            return response()->json(['success'=> true, 'response'=>'Already Paid'], $this-> successStatus);
        }
    }

}
