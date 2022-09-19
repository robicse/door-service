@extends('backend.layouts.master')
@section("title","Services Question")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Services Question</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Services Question</li>
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
                        <h3 class="card-title float-left">Services Question Lists</h3>
                        <div class="float-right">
                            {{--<a href="{{route('admin.services-question.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Service Name</th>
                                <th>Questions</th>
                                <th>Questions Type</th>
                                <th>Options</th>
                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services_question as $key => $service)
                                @php
                                    $service_name = \App\ServiceManage::find($service->service_id);
                                @endphp
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$service_name->service_name}}</td>
                                    <td>{{$service->question}}</td>
                                    <td>{{$service->question_type}}</td>
                                    <td>
                                        @php
                                            $que_option = json_decode($service->option);
                                                //dd($license_copy);
                                        @endphp
                                        @foreach($que_option as $que_data)
                                            {{$que_data. ','.' '.''}}
                                        @endforeach
                                    </td>
                                    {{--<td>
                                        --}}{{--<a class="btn btn-success waves-effect" href="{{route('admin.services-question.add',$service->id)}}" title="Add Question">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a class="btn btn-info waves-effect" href="{{route('admin.services-question.list',$service->id)}}" title="Question List">
                                            <i class="fa fa-th-list"></i>
                                        </a>--}}{{--
                                        --}}{{--<a class="btn btn-info waves-effect" href="{{route('admin.services-manage.edit',$service->id)}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>--}}{{--
                                        --}}{{--<button class="btn btn-danger waves-effect" type="button"
                                                onclick="deleteService({{$service->id}})" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{$service->id}}" action="{{route('admin.services-manage.destroy',$service->id)}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>--}}{{--
                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Service Name</th>
                                <th>Questions</th>
                                <th>Questions Type</th>
                                <th>Options</th>
                                {{--<th>Action</th>--}}
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
