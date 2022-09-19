<?php

namespace App\Http\Controllers\Admin;

use App\Model\Seller;
use App\Model\SellerWithdrawRequest;
use App\Payment;
use App\VendorDetails;
use App\VendorWithdrawRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class VendorController extends Controller
{
    public function withdrawRequest()
    {
        $withdrawRequests = VendorWithdrawRequest::latest()->get();
        //dd($withdrawRequests);
        return view('backend.admin.vendor.withdraw_request', compact('withdrawRequests'));
    }

    public function paymentHistory()
    {
        $paymentHistories = Payment::latest()->get();
        return view('backend.admin.vendor.payment_history',compact('paymentHistories'));
    }

    public function withdraw_payment_modal(Request $request)
    {
        $withdrawData = VendorWithdrawRequest::find($request->id);
        $vendorDetails = VendorDetails::where('user_id',$withdrawData->user_id)->first();
        return view('backend.admin.vendor.withdraw_payment_modal', compact('vendorDetails','withdrawData'));
    }

    public function pay_to_vendor_commission(Request $request)
    {
        //dd($request->all());
        $data['vendor_id'] = $request->vendor_id;
        $data['amount'] = $request->amount;
        $data['type'] = $request->type;
        $data['payment_method'] = $request->payment_option;
        $data['phone'] = $request->phone;
        //$data['payment_withdraw'] = $request->payment_withdraw;
        if ($data['type'] == 'withdraw'){
            $data['withdraw_request_id'] = $request->withdraw_request_id;
        }
        if ($request->txn_code != null) {
            $data['txn_code'] = $request->txn_code;
        }
        else {
            $data['txn_code'] = null;
        }
        //dd($data);
        $request->session()->put('payment_type', 'vendor_payment');
        $request->session()->put('payment_data', $data);
        if ($request->payment_option == 'cash') {
            return $this->vendor_payment_done($request->session()->get('payment_data'), null);
        }
        else{
            return $this->vendor_payment_done($request->session()->get('payment_data'), null);
        }

    }

    public function vendor_payment_done($payment_data, $payment_details){
        //dd($payment_data);
        //$vendorDetails = VendorDetails::findOrFail($payment_data['vendor_id']);
        $vendorDetails = VendorDetails::where('user_id',$payment_data['vendor_id'])->first();
        //dd($vendorDetails);
        //if($payment_data['type'] == 'payment'){
        if($payment_data['type'] == 'withdraw'){
            $vendorDetails->admin_to_pay = $vendorDetails->admin_to_pay - $payment_data['amount'];
            $vendorDetails->save();
        }

        $payment = new \App\Payment;
        $payment->vendor_withdraw_request_id = $payment_data['withdraw_request_id'];
        $payment->vendor_id = $payment_data['vendor_id'];
        $payment->amount = $payment_data['amount'];
        $payment->payment_method = $payment_data['payment_method'];
        $payment->txn_code = $payment_data['txn_code'];
        $payment->payment_details = $payment_details;
        $payment->phone = $payment_data['phone'];
        //dd($payment);
        $payment->save();

        if ($payment_data['type'] == 'withdraw') {
            $vendor_withdraw_request = VendorWithdrawRequest::find($payment_data['withdraw_request_id']);
            $vendor_withdraw_request->status = '1';
            $vendor_withdraw_request->viewed = '1';
            $vendor_withdraw_request->save();
        }

        Session::forget('payment_data');
        Session::forget('payment_type');

        if ($payment_data['type'] == 'payment') {
            Toastr::success('Payment completed', 'Success');
            return redirect()->route('admin.vendor.payment.history');
        }else{
            Toastr::success('Payment completed', 'Success');
            return redirect()->route('admin.vendor.withdraw.request');
        }

    }
}
