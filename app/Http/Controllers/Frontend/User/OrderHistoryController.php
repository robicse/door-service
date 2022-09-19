<?php

namespace App\Http\Controllers\Frontend\User;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function orderHistory()
    {
        $orderHistory = Order::where('user_id', Auth::id())->where('order_type','ecommerce')->latest()->get();
        return view('Frontend.Users.order-history', compact('orderHistory'));
    }
    public function wishlist(){
        $user= Auth::id();
        $products = Product::latest()->get();
        return view('Frontend.Users.order-history');
    }
    public function orderDetails($id)
    {
        $orderHistory = Order::find($id);
        return view('Frontend.Pages.invoice', compact('orderHistory'));
    }
    public function ServiceOrderHistory()
    {
        $orderHistory = Order::where('user_id', Auth::id())->where('order_type','service')->latest()->get();
        return view('Frontend.Users.service_order-history', compact('orderHistory'));
    }
    public function serviceOrderDetails($id)
    {
        $orderHistory = Order::find($id);
        return view('Frontend.Pages.service_invoice', compact('orderHistory'));
    }
}
