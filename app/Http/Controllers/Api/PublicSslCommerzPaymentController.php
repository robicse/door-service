<?php

namespace App\Http\Controllers\API;

use App\Order;
use App\OrderCommission;
use App\VendorDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Redirect;
//use Session;
use Illuminate\Support\Facades\Session;
use Lang;
//use Illuminate\Routing\UrlGenerator;
use App\Http\Controllers\Controller;
session_start();

class PublicSslCommerzPaymentController extends Controller
{

    public function index(Request $request)
    {

        $order =  Order::where('id',$request->order_id)->firstOrFail();
        //dd($order);
        //$this->oldDiscount= $order->coupon_discount;
        //$this->oldTotal= $order->grand_total;
//        Session::put('oldtotal',"12");
//        Session::put('olddiscount',"56");
        $_SESSION['oldtotal']=$order->grand_total;
        $_SESSION['olddiscount']=$order->coupon_discount;

        if($order->coupon_discount==0){
            $order->grand_total=$request->total-$request->discount;
            $order->coupon_discount=$request->discount;
        }else{
            $order->grand_total=$request->total;
            $order->coupon_discount=$request->discount;
        }
        $order->update();

        $grand_total =$order->grand_total;
        //$delivery_cost = number_format(Session::get('delivery_cost'),2);
        $total = $grand_total;
        # Here you have to receive all the order data to initate  payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "order_id","ssl_status" field contain status of the transaction, "grand_total" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique
        Order::where('id',$request->order_id)->update(
            array(
                'currency' => $post_data['currency'],
                'transaction_id' => $post_data['tran_id'],
                'ssl_status' => 'Pending',
            )
        );

        #Start to save these value  in session to pick in success page.
        $_SESSION['payment_values']['tran_id']=$post_data['tran_id'];
        #End to save these value  in session to pick in success page.
//dd($_SESSION['payment_values']['tran_id']);
//        $server_name=$request->root()."/";
        $server_name=url('/');
        $post_data['success_url'] = $server_name . "/api/success";
        $post_data['fail_url'] = $server_name . "/api/fail";
        $post_data['cancel_url'] = $server_name . "/api/cancel";

        #Before  going to initiate the payment order status need to update as Pending.
        $sslc = new SSLCommerz();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->initiate($post_data, true);
///        dd($payment_options);

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {

        $sslc = new SSLCommerz();
        #Start to received these value from session. which was saved in index function.
        $tran_id = $request->tran_id;
        #End to received these value from session. which was saved in index function.
        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'ssl_status','currency','grand_total','delivery_cost')->first();

        //$chekTotal= $order_detials->grand_total + number_format(Session::get('delivery_cost'),2);
        $chekTotal= $order_detials->grand_total;

        if($order_detials->ssl_status=='Pending')
        {
            $validation = $sslc->orderValidate($tran_id, $chekTotal, $order_detials->currency, $request->all());
            if($validation == TRUE)
            {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update([
                        //'payment_process' => 'Authorized',
                        'ssl_status' => 'Completed',
                        'payment_type' => 'ssl',
                        'payment_status' => '1',
                        'payment_details' => json_encode($_POST),
                    ]);

                $order=Order::where('transaction_id', $tran_id)->first();
                $commission = OrderCommission::first();
                $commissionValue = $order->grand_total*$commission->commission_percentage / 100;
                DB::table('payment_histories')->insert([
                    'order_id' => $order->id,
                    'payment_type' => 'ssl',
                    'vendor_amount'=>$order->grand_total - $commissionValue,
                    'admin_amount'=>$commissionValue,
                ]);

                $vendor_details = VendorDetails::where('user_id',$order->vendor_id)->first();
                //dd($vendor_details);
                $vendor_details->admin_to_pay += $order->grand_total - $commissionValue;
                $vendor_details->save();

                //Toastr::success('Transaction is successfully Completed tar','Success');
                //Cart::destroy();
                //Session::forget('delivery_cost');
//                $message = Lang::get("website.Payment has been processed successfully");
//                return redirect('/');

                return redirect('api/ssl/redirect/success');
            }
            else
            {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */;
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update([
                        'coupon_discount' => $this->oldDiscount,
                        'grand_total' => $this->oldTotal
                    ]);
                return redirect('api/ssl/redirect/fail');
            }
        }
        else if($order_detials->ssl_status=='Processing' || $order_detials->ssl_status=='Complete')
        {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update([
                    'coupon_discount' => $this->oldDiscount,
                    'grand_total' => $this->oldTotal
                ]);
            return redirect('api/ssl/redirect/fail');
        }
        else
        {
            #That means something wrong happened. You can redirect customer to your product page.
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update([
                    'coupon_discount' => $this->oldDiscount,
                    'grand_total' => $this->oldTotal
                ]);
            return redirect('api/ssl/redirect/fail');
        }
    }
    public function fail(Request $request)
    {
        //dd($_SESSION['oldtotal']);
        $tran_id = $request->tran_id;
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('id', 'ssl_status','currency','grand_total')->first();

        if($order_detials->ssl_status=='Pending')
        {

            //dd($_POST);
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['ssl_status' => 'Failed','coupon_discount' => $_SESSION['olddiscount'],
                    'grand_total' => $_SESSION['oldtotal']]);
            return redirect('api/ssl/redirect/fail');
        }
        else if($order_detials->ssl_status=='Processing' || $order_detials->ssl_status=='Complete')
        {
            return redirect('api/ssl/redirect/success');
        }
        else
        {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['coupon_discount' => $_SESSION['olddiscount'],
                    'grand_total' => $_SESSION['oldtotal']]);
            return redirect('api/ssl/redirect/fail');
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $tran_id = $request->tran_id;
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('id', 'ssl_status','currency','grand_total')->first();
//dd($order_detials);
        if($order_detials->ssl_status=='Pending')
        {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['ssl_status' => 'Canceled','coupon_discount' =>  $_SESSION['olddiscount'],
                    'grand_total' =>$_SESSION['oldtotal']]);
            echo "Transaction is Cancel";
        }
        else if($order_detials->ssl_status=='Processing' || $order_detials->ssl_status=='Complete')
        {
//            echo "Transaction is already Successful";
            return redirect('api/ssl/redirect/success');
        }
        else
        {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['coupon_discount' => $_SESSION['olddiscount'],
                    'grand_total' => $_SESSION['oldtotal']]);
            return redirect('api/ssl/redirect/cancel');
        }


    }
    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('id', 'ssl_status','currency','grand_total')->first();

            if($order_details->ssl_status =='Pending')
            {
                $sslc = new SSLCommerz();
                $validation = $sslc->orderValidate($tran_id, $order_details->grand_total, $order_details->currency, $request->all());
                if($validation == TRUE)
                {
                    /*
                     *
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successfull transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['ssl_status' => 'Complete']);

                    echo "Transaction is successfully Complete";
                }
                else
                {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('order_id', $tran_id)
                        ->update(['ssl_status' => 'Failed','coupon_discount' => $_SESSION['olddiscount'],
                            'grand_total' => $_SESSION['oldtotal']]);

                    echo "validation Fail";
                }

            }
            else if($order_details->ssl_status == 'Processing' || $order_details->ssl_status =='Complete')
            {
                #That means Order status already updated. No need to udate database.
                echo "Transaction is already successfully Complete";
            }
            else
            {
                echo "Invalid Transaction";
            }
        }
        else
        {
            echo "Inavalid Data";
        }
    }
    public function status($status)
    {
        return view("status",compact('status'));
    }
    public function statusWeb($status)
    {
        return view("status",compact('status'));
    }
}

