<?php

namespace App\Http\Controllers\Frontend;

use App\Order;
use App\OrderDetails;
use App\OrderDetailsTest;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function OrderStore(Request $request)
    {
        $this->validate($request,[
            'full_name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'payment_type' => 'required',
        ]);
        $data['name'] = $request->full_name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['city_state'] = $request->city_state;
        $data['phone'] = $request->phone;
        $shipping_info = json_encode($data);

        $order = new Order();
        $order->invoice_code = date('Ymd-his');
        $order->user_id = Auth::id();
        $order->shipping_address = $shipping_info;
        $order->payment_type = $request->payment_type;
        $order->payment_status = 0;
        $order->grand_total = Cart::total() + $request->shipcost;
        $order->delivery_cost = $request->shipcost;
        $order->delivery_status = "Pending";
        $order->view = 0;
        $order->save();

        foreach (Cart::content() as $content) {
            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->product_id = $content->id;
            $orderDetails->product_name = $content->name;
            $orderDetails->product_price = $content->price;
            $orderDetails->product_quantity = $content->qty;
            $product = Product::find($content->id);
            $product->quantity -= $content->qty;
            $product->save();
            $orderDetails->save();
        }
        if ($request->payment_type == 'cod') {
            Toastr::success('Order Successfully done! <span class="display-3">&#10084;&#65039;</span>');
            Cart::destroy();
            return redirect()->route('index');
        }else {
            Session::put('order_id',$order->id);
//            return redirect()->route('pay');
        }
    }
}
