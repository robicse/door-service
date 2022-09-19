@extends('backend.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">{{ strtoupper('DoorService ' . Auth::user()->role->name . ' Dashboard') }}</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    {{-- <!-- Main content --> --}}
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                @php
                                    $vendors = \App\User::where('role_id', 2)->get();
                                @endphp
                                {{ count($vendors) }}
                            </h3>

                            <p>Total Vendor</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list"></i>
                        </div>
                        <a href="{{ route('admin.vendorList') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>
                                @php
                                    $users = \App\User::where('role_id', 3)->get();
                                @endphp
                                {{ count($users) }}
                            </h3>

                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('admin.userList') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>

                                {{ $acceptedOrders }}
                            </h3>

                            <p>Accepted Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <a href="{{ route('admin.order.list') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $pendingOrders }}</h3>

                            <p>Pending Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-refresh"></i>
                        </div>
                        <a href="{{ route('admin.order.list') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>{{ $onReviewOrders }}</h3>

                            <p>On Review Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <a href="{{ route('admin.order.list') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $completedOrders }}</h3>

                            <p>Completed Order</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <a href="{{ route('admin.order.list') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $canceledOrders }}</h3>

                            <p>Canceled Order</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <a href="{{ route('admin.order.list') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
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
                                            <th> ID</th>
                                            <th>Order Date</th>
                                            <th>Name</th>
                                            <th>Grand Total</th>
                                            <th>Payment Type</th>
                                            <th>Payment Status</th>
                                            <th>Delivery Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($orders_all as $key => $order) --}}

                                        {{-- <tr> --}}
                                        {{-- <td>{{$key + 1}}</td> --}}
                                        {{-- <td>{{$order->invoice_code}}</td> --}}
                                        {{-- <td>{{$order->grand_total}} ৳</td> --}}
                                        {{-- <td>{{$order->delivery_status}}</td> --}}
                                        {{-- <td>{{date('JS F Y' , strtotime($order->created_at))}}</td> --}}

                                        {{-- </tr> --}}
                                        {{-- @endforeach --}}
                                        @foreach ($orders as $key => $order)
                                            @php $shippingInfo = json_decode($order->shipping_address) @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ date('jS F Y H:i A', strtotime($order->created_at)) }}</td>
                                                <td>{{ $shippingInfo->name }}</td>
                                                <td>{{ $order->grand_total }}৳</td>
                                                <td>{{ $order->payment_type }}</td>
                                                <td> <span
                                                        class="badge badge-{{ $order->payment_status == 0 ? 'danger' : 'success' }}">{{ $order->payment_status == 0 ? 'NOT-PAID' : 'PAID' }}</span>
                                                </td>
                                                <td> {{ $order->status->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="{{ route('admin.order.list') }}" class="btn btn-sm btn-secondary float-right">View All
                                Orders</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    {{-- <!-- /.content --> --}}
@stop
