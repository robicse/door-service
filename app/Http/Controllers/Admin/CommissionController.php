<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\OrderCommission;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function create(){
        $commission = OrderCommission::first();
        return view('backend.admin.commission.create',compact('commission'));
    }
    public function store(Request $request){
        $commission = OrderCommission::first();
        if (empty($commission)){
            $newCommission = new OrderCommission();
            $newCommission->commission_percentage = $request->commission_percentage;
            $newCommission->save();
            Toastr::success('Commission Created Successfully', 'Success');
            return redirect()->back();
        }else{
            $commission->commission_percentage = $request->commission_percentage;
            $commission->save();
            Toastr::success('Commission Updated Successfully', 'Success');
            return redirect()->back();
        }
    }
}
