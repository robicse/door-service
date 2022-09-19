@extends('backend.layouts.master')
@section("title","Order history of service")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Service History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Order Service History</li>
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
                                <th>Order Date & Time</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Grand Total</th>
                                <th>Payment Type</th>
                                <th>Payment Status</th>
                                <th>Assign to</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders_service as $key=>$order)

                                @php $shippingInfo = json_decode($order->shipping_address) @endphp
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{date('jS F Y' , strtotime($order->created_at))}}</td>
                                    <td>{{$shippingInfo->patient_name}}</td>
                                    <td>{{$shippingInfo->phone}}</td>
                                    <td>{{$order->grand_total}}৳</td>
                                    <td>{{$order->payment_type}}</td>
                                    <td>{{$order->payment_status == 0 ? "NOT-PAID" : "PAID"}}</td>
                                    <td>{{$order->serviceOrder->user->name}}</td>
                                    <td>
                                        <form action="{{route('admin.order-service.status',$order->id)}}">
                                            <select name="delivery_status" id="" onchange="this.form.submit()">
                                                <option value="Pending" {{$order->delivery_status == 'Pending'? 'selected' : ''}}>Pending</option>
                                                <option value="On review" {{$order->delivery_status == 'On review'? 'selected' : ''}}>On review</option>
                                                <option value="On delivered" {{$order->delivery_status == 'On delivered'? 'selected' : ''}}>On delivered</option>
                                                <option value="Delivered" {{$order->delivery_status == 'Delivered'? 'selected' : ''}}>Delivered</option>
                                                <option value="Cancel" {{$order->delivery_status == 'Cancel'? 'selected' : ''}}>Cancel</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{route('service.order.details',$order->id)}}" class="btn btn-success waves-effect" type="button">
                                            <i class="fa fa-cart-plus text-light" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" type="button">
                                            <i class="fa fa-user text-light" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('admin.order-service.assign_to',$order->id)}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="">Caregivers List</label>
                                                        <select name="assign_to" id="" class="form-control">
                                                            @foreach($caregivers as $caregiver)
                                                                <option value="{{$caregiver->id}}">{{$caregiver->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="assign_amount">Amount</label>
                                                        <input type="text" name="assign_amount" class="form-control">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Order Date & Time</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Grand Total</th>
                                <th>Payment Type</th>
                                <th>Payment Status</th>
                                <th>Assign to</th>
                                <th>Status</th>
                                <th>Action</th>
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
    </script>
@endpush
