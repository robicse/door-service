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
                    <h1>Services Wise Question List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Services Wise Question</li>
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
                        <h3 class="card-title float-left"><strong>{{$service->service_name}}</strong> Service Question List</h3>
                        <div class="float-right">
                            <a href="{{route('admin.services-question.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
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
                                <th>Question</th>
                                <th>Question Type</th>
{{--                                <th>Is Optional</th>--}}
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($serviceData as $key => $data)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$data->question}}</td>
                                        <td>{{$data->question_type}}</td>
{{--                                        <td>--}}
{{--                                            @if($data->is_optional == 0)--}}
{{--                                                False--}}
{{--                                            @else--}}
{{--                                                True--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
                                        <td>
                                            @if($data->question_type == 'radio' || $data->question_type == 'checkbox')
                                                <button type="button" class="btn btn-success"  onclick="optModalShow({{$data->id}},'{{$data->question}}')" >
                                                    Option <i class="fa fa-plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#option-edit-{{$data->id}}"  >
                                                    Option <i class="fa fa-edit"></i>
                                                </button>
                                            @endif
                                            <a type="button" class="btn btn-danger" href="{{route('admin.services-wise-question.delete',$data->id)}}"   >
                                                    <i class="fa fa-cut mr-1"></i>Delete
                                                </a>
                                        </td>
                                    </tr>
                                    {{--@if($data->question_type == 'radio' || $data->question_type == 'checkbox')--}}
                                        {{--option edit modal start--}}
                                        <div class="modal fade" id="option-edit-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="option-edit-{{$data->id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-center" id="option-edit">{{$data->question}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.question-option-update')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="service_question_id" id="" value="{{$data->id}}">
                                                            <div class="">
                                                                <div class="" id="">
                                                                   @php
                                                                    $questionOptionsData = \App\ServiceQuestionOption::where('service_question_id', $data->id)->get();
                                                                   @endphp
                                                                    {{--{{dd($questionOptionsData)}}--}}
                                                                    @forelse($questionOptionsData as $qData)
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-5">
                                                                            <label for="">Option Title </label>
                                                                            <input type="text" name="option_title[]" placeholder="Enter option title" class="form-control name_list" value="{{$qData->option_title}}" required/>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <label for="">Option Price </label>
                                                                            <input type="number" name="option_price[]" placeholder="Enter price" class="form-control price_list" value="{{$qData->option_price}}"/>
                                                                        </div>
                                                                    </div>
                                                                    @empty
                                                                        <div class="text-center"><h2 class="text-danger">Question Option Not yet Created!!</h2></div>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                            @if($questionOptionsData->count() > 0)
                                                            <button type="submit" class="btn btn-primary mt-4">Update</button>
                                                            @endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--option edit modal end--}}
                                    {{--@endif--}}
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Question</th>
                                <th>Question Type</th>
                                <th>Is Optional</th>
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
    <div class="modal fade" id="option" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="question_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.question-wise-option.store')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="service_question_id" id="service_question_id">
                        <div class="">
                            <div class="dynamic_field" id="dynamic_field">
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <label for="">Option Title </label>
                                        <input type="text" name="option_title[]" placeholder="Enter option title" class="form-control name_list" required/>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="">Option Price </label>
                                        <input type="number" name="option_price[]" placeholder="Enter price" class="form-control price_list" />
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <div class="mt-3"></div>
                                        <button type="button" name="add"   class="add btn btn-success">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Save</button>
                    </form>
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
        function optModalShow(id, title){

            $('#option').modal('show');
            $("#service_question_id").val(id);
            $("#question_title").text('Question Title: '+title);
        }

        $(document).ready(function(){

            var i=1;
            $('.add').on('click',function(){
                var fId = $(this).data("id")

                i++;
                $('.dynamic_field').append('<div class="row mb-3" id="row'+i+'">' +
                    '<div class="col-md-5 text-center"><input type="text"  name="option_title[]" placeholder="Enter your question" class="form-control" /></div>' +
                    '<div class="col-md-5 text-center"><input type="number" name="option_price[]" placeholder="Enter price" class="form-control " /></div>' +
                    '<div class="col-md-2 text-center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button></div></div>');
            });

            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

        });

    </script>
@endpush
