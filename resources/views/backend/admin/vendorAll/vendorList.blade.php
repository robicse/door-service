@extends('backend.layouts.master')
@section("title","Vendor List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />--}}
{{--    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">--}}
{{--    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>--}}
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Client List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Vendor List </li>
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
                        <h3 class="card-title float-left">Vendor List</h3>
                        <div class="float-right">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Name</th>
                                <th>Account category</th>
                                <th>Vendor Company Name</th>
                                <th>Experience</th>
                                <th>Schedule</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vendorUsers as $key => $vendor)
                                <tr>
                                    <td width="5%">{{$key + 1}}</td>
                                    <td width="20%">{{$vendor->user->name}}</td>
                                    <td width="20%">{{$vendor->account_category}}</td>
                                    @if($vendor->vendor_company_name!=null)
                                    <td width="20%">{{$vendor->vendor_company_name}}</td>
                                    @else
                                        <td width="20%"><span class="bg-warning-gradient">Undefined</span></td>
                                    @endif
                                    @if($vendor->practical_experiences!=null)
                                        <td width="20%">{{$vendor->practical_experiences}}</td>
                                    @else
                                        <td width="20%"><span class="bg-warning-gradient">Undefined</span></td>
                                    @endif
                                    @if($vendor->ven_service_provide_schedule!=null)
                                        <td width="20%">{{$vendor->ven_service_provide_schedule}}</td>
                                    @else
                                        <td width="20%"><span class="bg-warning-gradient">Undefined</span></td>
                                    @endif
                                    <td width="5%" class="bg-{{$vendor->status == 1  ? 'success' : 'warning'}}">{{$vendor->status == 1  ? 'Approved' : 'Pending'}}</td>
                                    <td width="20%">
                                        <a href="{{route('admin.vendor.details',$vendor->id)}}">
                                            <button title="Vendor Details" class="btn btn-primary btn-sm" type="button">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                        <a onclick="pending({{$vendor->id}})" >
                                            <button title="Status Pending" class="btn btn-warning btn-sm" type="button">
                                                <i class="fa fa-ban"></i>
                                            </button>
                                        </a>
                                        <a onclick="approved({{$vendor->id}})" >
                                            <button title="Status Approved" class="btn btn-success btn-sm" type="button">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </a>
                                        @if($vendor->status != 1)
                                            <a onclick="deleteVendor({{$vendor->id}})" >
                                                <button title="Delete" class="btn btn-danger btn-sm" type="button">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </a>
                                        @endif
{{--
                                            <a href="{{route('admin.vendorchangeStatus',$vendor->id)}}">
                                                <button class="btn btn-danger waves-effect" type="button">
                                                    Suspended
                                                </button>
                                            </a>--}}
                                        {{--<a href="{{route('vendorchangeStatus',$vendor->id)}}"><button class="btn btn-danger waves-effect" type="button">
                                            <i class="fa fa-toggle-off"></i>
                                        </button></a>--}}
{{--                                        <form id="delete-form-{{$vendor->id}}" action="{{route('vendorchangeStatus',$vendor->id)}}" method="POST" style="display: none;">--}}
{{--                                            @csrf--}}
{{--                                            @method('$vendor')--}}
{{--                                        </form>--}}
{{--                                    <a class="btn btn-info waves-effect" href="{{route('vendorchangeStatus',$vendor->id)}}">--}}
{{--                                        <i class="fa fa-toggle-off"></i>--}}
{{--                                    </a>--}}
{{--                                        <input data-id="{{$vendor->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $vendor->status ? 'checked' : '' }}>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Name</th>
                                <th>Account category</th>
                                <th>Vendor Company Name</th>
                                <th>Experience</th>
                                <th>Schedule</th>
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
    <script>function approved() {

        }

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

        //sweet alert for pending status
        function pending(id) {
            swal({
                title: 'Are you sure to change status?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Pending it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    window.location.href=  '/admin/vendor-status-change-pending/'+id
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

        //sweet alert for pending status
        function approved(id) {
            swal({
                title: 'Are you sure to change status?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    window.location.href=  '/admin/vendor-status-change-approved/'+id
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
        function deleteVendor(id) {
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
                    window.location.href=  '/admin/vendor-delete/'+id
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




        // $(function() {
        //     $('.toggle-class').change(function() {
        //         var status = $(this).prop('checked') == true ? 1 : 0;
        //         var user_id = $(this).data('id');
        //
        //         $.ajax({
        //             type: "GET",
        //             dataType: "json",
        //             url: '/changeStatus',
        //             data: {'status': status, 'vendor_details_id': vendor_details_id},
        //             success: function(data){
        //                 console.log(data.success)
        //             }
        //         });
        //     })
        // })
    </script>
@endpush
