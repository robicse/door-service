@extends('backend.layouts.master')
@section("title","Order List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Complete Order List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Order List</li>
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
                                <th>Invoice Code</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Old Total</th>
                                <th>Grand Total</th>
                                <th>Payment Process</th>
                                <th>Payment Status</th>
                                <th>Accept/Deny Status</th>
                                <th>Booked Status</th>
                                <th>Delivery Status</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($completeOrders as $key=>$order)

                                @php $shippingInfo = json_decode($order->shipping_address) @endphp

                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{date('jS F Y H:i A',strtotime($order->created_at))}}</td>
                                    <td>{{$order->invoice_code}}</td>
                                    <td>{{$shippingInfo->name}}</td>
                                    <td>{{$shippingInfo->phone}}</td>
                                    {{--<td>{{$shippingInfo->email}}</td>--}}
                                    <td>{{$order->old_total}}৳</td>
                                    <td>{{$order->grand_total}}৳</td>
                                    <td>{{$order->payment_process}}</td>
                                    <td> <span class="badge badge-{{$order->payment_status == 0 ? 'danger': 'success'}}">{{$order->payment_status == 0 ? "NOT-PAID" : "PAID"}}</span></td>
                                    @php
                                        $check_accept_deny = \App\OrderVendor::where('order_id',$order->id)->where('user_id','!=',NULL)->first();
                                    @endphp
                                    <td> <span class="badge badge-{{empty($check_accept_deny) ? 'danger': 'success'}}">{{empty($check_accept_deny) ? "NOT Accepted" : "Accepted"}}</span></td>
                                    <td> <span class="badge badge-{{$order->vendor_id == NULL ? 'danger': 'success'}}">{{$order->vendor_id == NULL ? "NOT-Booked" : "Booked"}}</span></td>
                                    <td>
                                        {{$order->status->name}}
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{route('admin.order.details',$order->id)}}" class="btn btn-sm btn-success waves-effect" type="button" title="Show Details">
                                            <i class="fa fa-eye text-light" aria-hidden="true"></i>
                                        </a>
                                        @if($order->orderDetails->service_type=="Quotation")
                                            <a onclick="openModal({{$order->id}})" class="btn btn-sm btn-warning waves-effect" type="button" title="Map Show to Vendor">
                                                <i class="fa fa-map text-light" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Order Date</th>
                                <th>Invoice Code</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Old Total</th>
                                <th>Grand Total</th>
                                <th>Payment Process</th>
                                <th>Payment Status</th>
                                <th>Accept/Deny Status</th>
                                <th>Booked Status</th>
                                <th>Delivery Status</th>
                                <th>Details</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
    </section>
    <!--Map modal Modal -->
    <div class="modal fade" id="map-modal" tabindex="-1" role="dialog" aria-labelledby="map-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="map-modal">Nearest Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="vendor_data">


                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
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

        //modal show
        function openModal(id){
            $('#map-modal').modal('show');

            $.ajax({
                url: "{{URL('/admin/order/assign-to-vendor/')}}/" + id,
                method: "get",
                success: function (result) {
                    console.log(result.response.length);
                    var tr = " <tr>\n" +
                        "                           <th>Name</th>\n" +
                        "                           <th>Type</th>\n" +
                        "                           <th>Service Area</th>\n" +
                        // "                           <th>Action</th>\n" +
                        "                       </tr>";
                    data = (result.response);
                    if (result.response.length > 0) {
                        data.forEach(function (element) {
                            tr += " <tr>\n" +
                                "<td>"+element.vendor_company_name+"</td>\n" +
                                "<td>"+element.account_category+"</td>\n" +
                                "<td>"+element.services_area+"</td>\n" +
                                // "<td>\n" +
                                // "<a onclick='addvendor("+element.user_id+", "+id+")' class=\"btn btn-sm btn-success\">\n" +
                                // "<i class=\"text-white fa fa-handshake-o\"></i>\n" +
                                // "</a>\n" +
                                // "</td>\n" +
                                "</tr>";
                        });
                    }else {
                        tr = "<h2 class=\"text-danger\">Don't have any vendor here...</h2>"
                    }

                    $("#vendor_data").html(tr);
                }
            });



        }


        //sweet alert
        function deletePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }
        function addvendor(vendor_id, order_id){
            swal({
                title: 'Are you sure to notify this vendor?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, I want to Assign an Vendor',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{URL('/admin/order/assign-to-vendor-store/')}}/" + vendor_id + "/" +order_id,
                        method: "get",
                        success: function (result) {
                            console.log(result.response)
                            if (result.response === 0){
                                toastr.warning('This order already assign to this vendor', 'Warning')
                            }else {
                                toastr.success('Successfully order pass to vendor', 'Success')
                            }
                        }
                    });


                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
