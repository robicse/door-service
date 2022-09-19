@extends('backend.layouts.master')
@section("title","Request Order List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Request Order List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('vendor.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Request Order List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-12">
                <div class="card card-info card-outline">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Order Date</th>
                                <th>Service</th>
                                <th>Address</th>
                                <th>Grand Total</th>
                                <th>Payment Status</th>
                                <th>Accept/Deny Status</th>
                                <th>Booked Status</th>
                                <th>Delivery Status</th>
                                <th>Order Communications</th>
                                <th>Pay</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orderReqToVendor as $key=>$reqOrder)

                                @php $shippingInfo = json_decode($reqOrder->order->shipping_address) @endphp

                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{date('Y-m-d H:i a' , strtotime($reqOrder->order->created_at))}}</td>
                                    <td>{{$reqOrder->order->orderDetails->service_name}}</td>
                                    <td>{{$shippingInfo->address}}</td>
                                    <td>{{$reqOrder->order->grand_total}}৳</td>
                                    <td> <span class="badge badge-{{$reqOrder->order->payment_status == 0 ? 'danger': 'success'}}">{{$reqOrder->order->payment_status == 0 ? "NOT-PAID" : "PAID"}}</span></td>
                                    <td>
{{--                                        @if($reqOrder->order->vendor_id!=null)--}}
                                        @if($reqOrder->user_id != null)
{{--                                            @if($reqOrder->order->vendor_id == Auth::id())--}}
                                            @if($reqOrder->vendor_id == Auth::id())
                                                <span class="badge badge-success">Accepted</span>
                                            @elseif($reqOrder->order->vendor_id == Auth::id())
                                                <span class="badge badge-success">Booked</span>
                                            @else
                                                <span class="badge badge-success">Assigned</span>
                                            @endif
                                        @else
                                            {{--                                            @if($reqOrder->order->orderDetails->service_type=="Fixed")--}}
                                            {{--                                                <form action="{{route('vendor.request_order_accept')}}" method="post">--}}
                                            {{--                                                    @csrf--}}
                                            {{--                                                    <input type="hidden" name="order_id" value="{{$reqOrder->order_id}}">--}}
                                            {{--                                                    <select  name="status" id="" onchange="this.form.submit()">--}}
                                            {{--                                                        <option value="">Please Select One</option>--}}
                                            {{--                                                        <option value="receive">Accept</option>--}}
                                            {{--                                                        <option value="not_now">Deny</option>--}}
                                            {{--                                                    </select>--}}
                                            {{--                                                </form>--}}
                                            {{--                                            @else--}}
                                            {{--                                                send quotation--}}
                                            {{--                                            @endif--}}
                                            <form action="{{route('vendor.request_order_accept')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{$reqOrder->order_id}}">
                                                <select  name="status" id="" onchange="this.form.submit()" style="width: 100%" required>
                                                    <option value="">Select</option>
                                                    <option value="receive">Accept</option>
                                                    <option value="not_now">Deny</option>
                                                </select>
                                            </form>
                                            <small>By Accepting this order you <br>can start chat with User</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($reqOrder->book_status == 0)
                                            <p><span class="badge badge-danger">NOT Booked</span></p>
                                        @else
                                            <p><span class="badge badge-success">Booked</span></p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($reqOrder->order->vendor_id == null)
                                            <p><span class="badge badge-danger">Pending</span></p>
                                        @elseif($reqOrder->order->vendor_id != null)
                                            <form id="status-form-{{$reqOrder->order_id}}" action="{{route('vendor.request_order__status_change',$reqOrder->order_id)}}" method="post">
                                                @csrf
                                                <select  name="status_id" id="" onchange="this.form.submit()" @if($reqOrder->order->status_id == 4) disabled @endif>
                                                    <option value="">Please Select One</option>
                                                    @foreach($orderStatus as $status)
                                                    <option value="{{$status->id}}" {{$reqOrder->order->status_id == $status->id ? 'selected' : ''}}>{{$status->name}}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @else
                                            <p>Accept First</p>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $orderDetailCommunication = \App\OrderVendor::where('order_id',$reqOrder->order->id)->where('vendor_id',Auth::id())->first();
                                        @endphp
                                        @if(!empty($orderDetailCommunication->order_detail_communication))
                                            {{$orderDetailCommunication->order_detail_communication}}
                                            <form action="{{route('vendor.order_detail_communication_accept')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="order_vendor_id" value="{{$orderDetailCommunication->id}}">
                                                <select  name="vendor_approve_status" id="" onchange="this.form.submit()" style="width: 100%" required @if($orderDetailCommunication->vendor_approve_status == 1) disabled @endif>
                                                    <option value="">Select</option>
                                                    <option value="1" {{$orderDetailCommunication->vendor_approve_status == 1 ? 'selected' : ''}}>Accept</option>
                                                    <option value="0" {{$orderDetailCommunication->vendor_approve_status == 0 ? 'selected' : ''}}>Deny</option>
                                                </select>
                                            </form>
                                        @else
                                            No Data Found!
                                        @endif
                                    </td>
                                    <td>
                                        @if($reqOrder->order->vendor_id == null)
                                            <p><span class="badge badge-danger">Pending</span></p>

                                        @elseif($reqOrder->order->payment_process == 'unauthorized' && $reqOrder->order->payment_status == 0)
                                            <a target="_blank" href="{{route('vendor.order.payment',$reqOrder->order->id)}}" class="btn btn-sm btn-info waves-effect" type="button" title="Show Details">
                                                Receive
                                            </a>
                                       @else
                                            <p> <span class="badge badge-success">Paid</span></p>
                                        @endif
                                    </td>
                                    <td style="display: grid">
                                        <a target="_blank" href="{{route('vendor.request_order_details',$reqOrder->order->id)}}" class="btn btn-sm btn-success waves-effect" type="button" title="Show Details">
                                           <p class="m-0"><i class="fa fa-eye text-light mr-1" aria-hidden="true"></i>Details </p>
                                        </a>
                                        @if($reqOrder->chat_id!=null)
                                            <a target="_blank" href="{{route('vendor.request.quotation',$reqOrder->order->id)}}" class="btn btn-sm btn-secondary waves-effect mt-1" type="button" title="Send Quotation">
                                              <p class="m-0"><i class="fa fa-comments text-light mr-1" aria-hidden="true"></i>Start Chat </p>
                                            </a>
                                        @endif
                                        @php
                                        $review = \App\Review::where('order_id',$reqOrder->order->id)->where('user_id',$reqOrder->order->user_id)->where('vendor_user_id',$reqOrder->order->vendor_id)->first();
                                        @endphp
                                        @if($reqOrder->order->vendor_id != null && !empty($review))
                                            <a type="button" class="btn btn-sm btn-warning waves-effect mt-1" data-toggle="modal" data-target="#{{$reqOrder->order->id}}" >
                                                <i class="fa fa-star text-light" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>

                                </tr>
                                <div class="modal fade" id="{{$reqOrder->order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title" id="exampleModalLabel">Order Review</p>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    <p>Order Invoice: {{$reqOrder->order->invoice_code}}</p>
                                                    <p>User Id: {{$shippingInfo->name}}</p>
                                                    <p>Rating: {{$reqOrder->order->review ? $reqOrder->order->review['rating'] : ''}}</p>
                                                    <p>Comment: {{$reqOrder->order->review ? $reqOrder->order->review['comment'] : ''}}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
{{--                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                                <button type="button" class="btn btn-primary">Save changes</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
    </section>
    <!-- Modal -->


@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    {{--<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>--}}
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@endpush
