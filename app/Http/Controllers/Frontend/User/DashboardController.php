<?php

namespace App\Http\Controllers\Frontend\User;

use App\Order;
use App\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function user_Dashboard()
    {
        $orders = Order::where('user_id', Auth::id())->where('order_type','ecommerce')->sum('grand_total');
        $serviceOrders = Order::where('user_id', Auth::id())->where('order_type','service')->sum('grand_total');
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
         return view('Frontend.Users.dashboard', compact('orders','wishlist','serviceOrders'));
    }
}
