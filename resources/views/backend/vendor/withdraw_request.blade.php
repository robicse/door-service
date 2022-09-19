@extends('backend.layouts.master')
@section("title","Vendor Withdraw Request List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vendor Withdraw Request List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Vendor Withdraw Request List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner text-center">
                        @if($vendor->admin_to_pay>0)
                            <h4>{{$vendor->admin_to_pay}}</h4>
                        @else
                            <h4>Insufficient Amount</h4>
                        @endif

                        <p>Pending Balance</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <a href="" class="small-box-footer" data-toggle="modal" data-target="#exampleModal">
                    <div class="small-box bg-success" style="min-height: 125px; ">
                        <div class="inner text-center">
                            <h4>Send Withdraw Request</h4>
                            <h1>
                                <i class="fa fa-plus-circle"></i>
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
            <!-- ./col -->
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Vendor Withdraw Request List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Date</th>
                                <th>Vendor Name</th>
                                <th>Total Amount to Pay</th>
                                <th>Requested Amount</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($withdrawRequests as $key => $withdraReq)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>2020-11-30 05:42:00</td>
                                <td>Mr. Vendor ({{$withdraReq->user->name}})</td>
                                <td>৳{{$withdraReq->amount}}</td>
                                <td>৳{{$withdraReq->amount}}</td>
                                <td>{{$withdraReq->message}}</td>
                                <td>
                                    <span class="badge badge-{{$withdraReq->status == 1 ? 'success' : 'danger'}}">{{$withdraReq->status == 1 ? 'Paid' : 'Not paid'}}</span>
                                </td>
                                <td>
                                    <a class="bg-info dropdown-item" href="{{route('vendor.payment.history')}}">
                                        <i class="fa fa-history"></i> Payment History
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Date</th>
                                <th>Vendor Name</th>
                                <th>Total Amount to Pay</th>
                                <th>Requested Amount</th>
                                <th>Message</th>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send A Withdraw Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('vendor.withdraw-request.store')}}" method="post">
                    <div class="row" style="padding: 10px 0px 0px 150px;">
                        <div class="col-lg-8 col-6">
                            <div class="small-box bg-info">
                                <div class="inner text-center">
                                    @if($vendor->admin_to_pay>0)
                                        <h4>{{$vendor->admin_to_pay}}</h4>
                                    @else
                                        <h4>Insufficient Amount</h4>
                                    @endif
                                    <p>Pending Balance</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 control-label" for="amount">Amount</label>
                            <div class="col-sm-8">
                                <input type="number" name="amount" id="amount" class="form-control" max="{{$vendor->admin_to_pay}}" id="exampleFormControlInput1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 control-label" for="payment_method">Payment Method</label>
                            <div class="col-sm-8">
                                <select name="payment_method" id="payment_option" class="form-control demo-select2-placeholder" required>
                                    <option value="">Select Payment Method</option>
                                    @if($vendor->cash_on_delivery_status == 1)
                                        <option value="cash">Cash</option>
                                        <option value="bkash">Bkash</option>
                                        <option value="rocket">Rocket</option>
                                    @endif
                                    @if($vendor->bank_payment_status == 1)
                                        <option value="bank_payment">Bank Payment</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="phone_field">
                            <label class="col-sm-4 control-label" for="amount">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="number" name="phone" id="phone" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Message</label>
                            <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Send</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
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
        //sweet alert
        function payNow(id) {
            swal({
                title: 'Are you sure to Pay?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#30a90c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes,Pay Now!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: true,
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
        function show_seller_withdraw_payment_modal(id){
            $.post('{{ route('admin.vendors.withdraw_payment_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#payment_modal #modal-content').html(data);
                $('#payment_modal').modal('show', {backdrop: 'static'});

            });
        }

        $(document).ready(function(){
            $('#phone_field').hide();
            $('#payment_option').on('change', function() {
                if ( this.value == 'bank_payment')
                {
                    $("#txn_div").show();
                }
                else
                {
                    $("#txn_div").hide();
                }
            });
            $("#txn_div").hide();
        });

        $('#payment_option').on('change', function () {
            var payment = $('#payment_option').val();
            // alert(payment);
            if(payment != 'cash'){
                $('#phone_field').show();
            }else {
                $('#phone_field').hide();
            }

        });
    </script>
@endpush
