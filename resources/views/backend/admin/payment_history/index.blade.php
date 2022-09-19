@extends('backend.layouts.master')
@section("title","Payment History")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Payment History</li>
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
                    <div class="card-header">
                        <h3 class="card-title float-left">Payment History</h3>
                        <div class="float-right">
{{--                            <a href="">--}}
{{--                                <button class="btn btn-success">--}}
{{--                                    <i class="fa fa-plus-circle"></i>--}}
{{--                                    Add--}}
{{--                                </button>--}}
{{--                            </a>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Invoice Code</th>
                                <th>Date</th>
                                <th>Vendor Name</th>
                                <th>Service Name</th>
                                <th>Payment Process</th>
                                <th>Grand Total</th>
                                <th>Admin Commission</th>
                                <th>Vendor Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $order)
                                @if($order->vendor_id!=null && !empty(!empty($order->payment)))
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$order->invoice_code}}</td>
                                    <td>{{date('jS F Y H:i A',strtotime($order->created_at))}}</td>
                                    <td>{{$order->vendorUser->name}}</td>
                                    <td>{{$order->orderDetails->service_name}}</td>
                                    <td>{{$order->payment_process}}</td>
                                    <td>{{$order->grand_total}}</td>
                                    @if($order->payment_process=='authorized')
                                    <td>{{$order->payment->admin_amount}}</td>
                                    @else
                                        <td>0</td>
                                    @endif
                                        <td>{{$order->payment->vendor_amount}}</td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Invoice Code</th>
                                <th>Date</th>
                                <th>Vendor Name</th>
                                <th>Service Name</th>
                                <th>Payment Process</th>
                                <th>Grand Total</th>
                                <th>Admin Commission</th>
                                <th>Vendor Amount</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

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

        //sweet alert
        function deleteService(id) {
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
    </script>
@endpush
