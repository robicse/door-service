@extends('backend.layouts.master')
@section("title","Coupon")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Coupon</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Coupon</li>
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

                        <div class="float-right">
                            <a href="{{route('admin.coupon.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Coupon Code</th>
                                <th>Coupon Type</th>
                                <th>Coupon Value</th>
                                <th>Minimum Spent</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupon as $key => $coup)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$coup->code}}</td>
                                    <td>
                                        {{$coup->type}}
                                    </td>
                                    <td>
                                        @if($coup->type=="fixed")
                                            {{$coup->value}}tk
                                        @else
                                            {{$coup->percent_off}}%
                                        @endif
                                    </td>
                                    <td>
                                        {{$coup->min_spent}}tk
                                    </td>
                                    <td><a href = "{{asset('uploads/coupon/'.$coup->image)}}"><img src = "{{asset('uploads/coupon/'.$coup->image)}}" alt = "" width="50px" hieght="40px"></a></td>

                                    @if($coup->status==1)
                                        <td class="bg-success text-center">
                                            Active
                                        </td>
                                    @else
                                        <td class="bg-danger text-center">
                                            Deactive
                                        </td>
                                    @endif

                                    <td >
                                        <a class="btn btn-info waves-effect" href="{{route('admin.coupon.status',$coup->id)}}">
                                             <p class="mb-0"><i class="fa fa-edit mr-1"></i>Change Status</p>
                                        </a>
                                        <button class="btn btn-danger waves-effect" type="button"
                                                onclick="deleteCat({{$coup->id}})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{$coup->id}}" action="{{route('admin.coupon.destroy',$coup->id)}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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
        function deleteCat(id) {
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
