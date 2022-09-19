@extends('backend.layouts.master')
@section("title","Dashboard")
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{strtoupper('Welcome To Dashboard' )}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                @php
                                $notification = \App\Notification::where('from', Auth::id())->get();
                                @endphp
                                {{count($notification)}}
                            </h3>

                            <p>Notification</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                {{$acceptedOrders}}
                            </h3>

                            <p>Accepted Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <a href="{{route('vendor.request_order_list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$pendingOrders}}</h3>

                            <p>Pending Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-refresh"></i>
                        </div>
                        <a href="{{route('vendor.request_order_list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-dark-gradient">
                        <div class="inner">
                            <h3>{{$onReviewOrders}}</h3>

                            <p>On Review Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <a href="{{route('vendor.request_order_list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-primary-gradient">
                        <div class="inner">
                            <h3>{{$completedOrders}}</h3>

                            <p>Completed Order</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <a href="{{route('vendor.request_order_list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$canceledOrders}}</h3>

                            <p>Canceled Order</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <a href="{{route('vendor.request_order_list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
{{--                <div class="col-md-4">--}}
                    <!-- Info Boxes Style 2 -->
{{--                    <div class="info-box mb-3 bg-warning">--}}
{{--                        <span class="info-box-icon"><i class="fa fa-tag"></i></span>--}}

{{--                        <div class="info-box-content">--}}
{{--                            <span class="info-box-text">Inventory</span>--}}
{{--                            <span class="info-box-number">000</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.info-box-content -->--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box -->--}}
{{--                    <div class="info-box mb-3 bg-success">--}}
{{--                        <span class="info-box-icon"><i class="fa fa-heart-o"></i></span>--}}

{{--                        <div class="info-box-content">--}}
{{--                            <span class="info-box-text">Mentions</span>--}}
{{--                            <span class="info-box-number">000</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.info-box-content -->--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box -->--}}
{{--                    <div class="info-box mb-3 bg-danger">--}}
{{--                        <span class="info-box-icon"><i class="fa fa-cloud-download"></i></span>--}}

{{--                        <div class="info-box-content">--}}
{{--                            <span class="info-box-text">Downloads</span>--}}
{{--                            <span class="info-box-number">000</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.info-box-content -->--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box -->--}}
{{--                    <div class="info-box mb-3 bg-info">--}}
{{--                        <span class="info-box-icon"><i class="fa fa-comment-o"></i></span>--}}

{{--                        <div class="info-box-content">--}}
{{--                            <span class="info-box-text">Direct Messages</span>--}}
{{--                            <span class="info-box-number">000</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.info-box-content -->--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- Left col -->
                <div class="col-md-8">
                    <!-- MAP & BOX PANE -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Latest Orders</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Service</th>
                                        <th>Grand Total</th>
                                        <th>Payment Status</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vendorOrders as $key=>$vendorOrder)
                                        @php $shippingInfo = json_decode($vendorOrder->order->shipping_address) @endphp
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{date('Y-m-d' , strtotime($vendorOrder->order->created_at))}}</td>
                                        <td>{{$vendorOrder->order->orderDetails->service_name}}</td>
                                        <td>{{$vendorOrder->order->grand_total}}৳</td>
                                        <td><span class="badge badge-{{$vendorOrder->order->payment_status == 0 ? 'danger': 'success'}}">{{$vendorOrder->order->payment_status == 0 ? "NOT-PAID" : "PAID"}}</span></td>
                                        <td>{{$vendorOrder->order->status->name}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
{{--                            <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>--}}
                            <a href="{{route('vendor.request_order_list')}}" class="btn btn-sm btn-secondary float-right">View All
                                Orders</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@stop

