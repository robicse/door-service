@extends('backend.layouts.master')
@section('title', 'Request Order Details')
@push('css')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Request Order Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Request Order Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

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
                                        <small class="float-right">Date:
                                            {{ date('Y-m-d', strtotime($order->created_at)) }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>{{ $shippingInfo->name }}</strong><br>
                                        {{ $shippingInfo->address }}<br>
                                        Phone: {{ $shippingInfo->phone }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    {{-- To
                                    <address>
                                        <strong>John Doe</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        Phone: (555) 539-1037<br>
                                        Email: john.doe@example.com
                                    </address> --}}
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #{{ $order->invoice_code }}</b><br>
                                    <b>Order ID:</b> {{ $order->id }}<br>
                                    <b>Payment Due:</b> {{ date('Y-m-d', strtotime($order->created_at)) }}<br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-6 table-responsive">
                                    <strong>Service Name: </strong> {{ $order->orderDetails->service_name }}
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Question</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{dd(json_decode($order->orderDetails->answer_set))}} --}}
                                            @php $question = json_decode($order->orderDetails->question_set); @endphp

                                            @for ($i = 0; $i < count(json_decode($order->orderDetails->question_set)); $i++)
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td>{{ $question[$i] }}</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6 table-responsive">
                                    <p class="mt-4"></p>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{dd(json_decode($order->orderDetails->answer_set))}} --}}
                                            @php $ans = json_decode($order->orderDetails->answer_set); @endphp

                                            @for ($i = 0; $i < count(json_decode($order->orderDetails->answer_set)); $i++)
                                                <tr>
                                                    <td>
                                                        @for ($j = 0; $j < count($ans[$i]); $j++)
                                                            {{ $ans[$i][$j] }} ,
                                                        @endfor
                                                    </td>
                                                </tr>
                                            @endfor
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
                                            <tr>
                                                <th style="width:53%">Subtotal:</th>
                                                <td>{{ $order->grand_total }} TK</td>
                                            </tr>
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
                                    {{-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> --}}
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
@endpush
