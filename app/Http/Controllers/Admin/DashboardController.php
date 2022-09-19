<?php

namespace App\Http\Controllers\Admin;

use App\BlogPost;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /*dd("test");*/
        $orders = Order::latest()->get();
        $acceptedOrders = Order::where('status_id',1)->count();
        $pendingOrders = Order::where('status_id',2)->count();
        $onReviewOrders = Order::where('status_id',3)->count();
        $completedOrders = Order::where('status_id',4)->count();
        $canceledOrders = Order::where('status_id',5)->count();
         return view('backend.admin.dashboard',compact('orders','acceptedOrders','pendingOrders','onReviewOrders','completedOrders','canceledOrders'));
    }
}
