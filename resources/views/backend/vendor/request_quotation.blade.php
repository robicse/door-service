@extends('backend.layouts.master')
@section('title', 'Request Quotation')
@push('css')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quotation</h1>
                </div>
                {{-- <div class="col-sm-6"> --}}
                {{-- <ol class="breadcrumb float-sm-right"> --}}
                {{-- <li class="breadcrumb-item"><a href="{{route('vendor.dashboard')}}">Home</a></li> --}}
                {{-- <li class="breadcrumb-item active">Request Order Details</li> --}}
                {{-- </ol> --}}
                {{-- </div> --}}
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        {{ print_r($vndMes) }}
        <div class="row">
            @php $shippingInfo = json_decode($order->shipping_address) @endphp
            <div class="col-12">
                <div class="card card-info card-outline">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fa fa-globe"></i> Door Service
                                        <small class="float-right">Generated on:
                                            {{ date('Y-m-d', strtotime($order->created_at)) }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info mt-3">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>{{ Auth::user()->name }}</strong><br>
                                        {{ Auth::user()->vendorDetails->address }}<br>
                                        Phone: {{ Auth::user()->phone }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{ $shippingInfo->name }}</strong><br>
                                        {{ $shippingInfo->address }}<br>
                                        Phone: {{ $shippingInfo->phone }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #{{ $order->invoice_code }}</b><br>
                                    <b>Order ID:</b> {{ $order->id }}<br>
                                    <b>Request date:</b> {{ $shippingInfo->service_date }}<br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    {{-- <strong>Service Name: </strong> {{$order->orderDetails->service_name}} --}}
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Service Name</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{dd(json_decode($order->orderDetails->answer_set))}} --}}
                                            <tr>
                                                <td>{{ $order->orderDetails->service_name }}</td>
                                                <td>1</td>
                                                <td>{{ $order->grand_total }} TK</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-8">
                                    {{-- <p class="lead">Payment Methods:</p>
                                     <img src="../../dist/img/credit/visa.png" alt="Visa">
                                     <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                                     <img src="../../dist/img/credit/american-express.png" alt="American Express">
                                     <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
                                     <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                         Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                                         plugg
                                         dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                     </p> --}}
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    {{-- <p class="lead">Amount Due 2/22/2014</p> --}}
                                    <div class="table-responsive">
                                        <table class="table">
                                            {{-- <tr> --}}
                                            {{-- <th style="width:53%">Subtotal:</th> --}}
                                            {{-- <td>{{$order->grand_total}} TK</td> --}}
                                            {{-- </tr> --}}
                                            <tr>
                                                <th>Tax (0%)</th>
                                                <td>0.00 TK</td>
                                            </tr>
                                            {{-- <tr>
                                                <th>Shipping:</th>
                                                <td>$5.80</td>
                                            </tr> --}}
                                            <tr>
                                                <th>Total:</th>
                                                <td>{{ $order->grand_total }} TK</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="#" target="_blank" class="btn btn-default float-right "><i
                                            class="fa fa-paper-plane"></i> Send</a>
                                    {{-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                        Payment
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
    </section>


@stop
@push('js')
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    {{-- <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-app.js"></script> --}}

    {{-- <!-- TODO: Add SDKs for Firebase products that you want to use --}}
    {{-- https://firebase.google.com/docs/web/setup#available-libraries --> --}}
    {{-- <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-analytics.js"></script> --}}
    {{-- <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-firestore.js"></script> --}}
    {{-- <script> --}}
    {{-- // Your web app's Firebase configuration --}}
    {{-- // For Firebase JS SDK v7.20.0 and later, measurementId is optional --}}
    {{-- var firebaseConfig = { --}}
    {{-- apiKey: "AIzaSyAdc_EP4Oyio_3hxs-n5pHzJjTGpbXzl-k", --}}
    {{-- authDomain: "dschat-b633c.firebaseapp.com", --}}
    {{-- databaseURL: "https://dschat-b633c.firebaseio.com", --}}
    {{-- projectId: "dschat-b633c", --}}
    {{-- storageBucket: "dschat-b633c.appspot.com", --}}
    {{-- messagingSenderId: "389109485499", --}}
    {{-- appId: "1:389109485499:web:0beed73c86ef0436e27e9e", --}}
    {{-- measurementId: "G-WWYCWXZZ54" --}}
    {{-- }; --}}
    {{-- // Initialize Firebase --}}
    {{-- var app=firebase.initializeApp(firebaseConfig); --}}
    {{-- db = firebase.firestore(app); --}}
    {{-- db.collection("conversation").doc("id_3-orderId_1-vendorId_18") --}}
    {{-- .onSnapshot((doc) => { --}}
    {{-- console.log("Current data: ", doc.data()); --}}
    {{-- }); --}}
    {{-- firebase.analytics(); --}}
    {{-- </script> --}}
@endpush
