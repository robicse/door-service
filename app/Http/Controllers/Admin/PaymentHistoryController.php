<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\PaymentHistory;
use Illuminate\Http\Request;

class PaymentHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('backend.admin.payment_history.index',compact('orders'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
