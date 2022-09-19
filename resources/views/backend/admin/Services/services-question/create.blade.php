@extends('backend.layouts.master')
@section("title","Service Create")
@push('css')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.js"></script>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Question Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Question Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h1 class="card-title float-left">Question Answer For: <strong class="text-danger">{{$service_name->service_name}}</strong></h1>
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
                    <!-- form start -->



                    <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.services-question.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" id="service_id" name="service_id" class="form-control" value="{{$service_name->id}}">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dynamic_field">
                                        <tr>
                                            <td>
                                                <label for="">Question <span class="text-danger">*</span></label>
                                                <input type="text" name="question[]" placeholder="Enter your question" class="form-control name_list" required /></td>
                                            <td>
                                                <label for="">Question Type <span class="text-danger">*</span></label>
                                                <select name="question_type[]" id="" class="form-control" required>
{{--                                                    <option value="text">Input</option>--}}
                                                    <option value="textarea">Textarea</option>
                                                    <option value="radio">Radio</option>
                                                    <option value="checkbox">Checkbox</option>
{{--                                                    <option value="quantity">Quantity</option>--}}
                                                </select>
                                            </td>
                                            <td>
                                                <label for="">Is Optional <span class="text-danger">*</span></label>
                                                <select name="is_optional[]" id="" class="form-control" required>
                                                    <option value="0">False</option>
                                                    <option value="1">True</option>
                                                </select>
                                            </td>
                                            <td class="text-center"><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script>
        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="question[]" placeholder="Enter your question" class="form-control name_list" required /></td>' +
                    '<td class="text-center"> <select class="form-control question_type" name="question_type[]" id="question_type" required>\n' +
                    '<option value="textarea">Textarea</option>\n' +
                    '<option value="radio">Radio</option>\n' +
                    '<option value="checkbox">Checkbox</option>\n' +
                    '</select>' +
                    '</td>' +
                    '<td class="text-center"> <select class="form-control is_optional" name="is_optional[]" id="is_optional" required>\n' +
                    '<option value="0">False</option>\n' +
                    '<option value="1">True</option>\n' +
                    '</select>' +
                    '</td>' +
                    '<td class="text-center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i> </button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });
        });
    </script>
@endpush



