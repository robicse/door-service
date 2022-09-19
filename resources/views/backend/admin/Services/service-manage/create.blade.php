@extends('backend.layouts.master')
@section("title","Service Create")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Service Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row"> Service Type
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left"></h3>
                        <div class="float-right">
                            <a href="{{route('admin.services-manage.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.services-manage.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="name">Service Name <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Service Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="service_type" id="service_type" required>
                                        <option value="Quotation" selected>Quotation Type</option>
                                        <option value="Fixed">Fixed Type</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="service_price">Service Price <span class="text-danger">*</span></label>
                                    <input type="number" id="service_price" name="service_price" class="form-control" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="name">Service Category <span class="text-danger">*</span></label>
                                    <select class="form-control" name="service_category" id="service_category" required>
                                        <option value="">select one</option>
                                        @foreach($service_category as $cate_data)
                                            <option value="{{$cate_data->id}}">{{$cate_data->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Service Sub Category <span class="text-danger">*</span></label>
                                    <select class="form-control" name="service_sub_category" id="service_sub_category">
                                        <option value="">select one</option>
{{--                                        --}}{{--@foreach($service_sub_category as $sub_cate_data)--}}
{{--                                            <option value="{{$sub_cate_data->id}}">{{$sub_cate_data->sub_category}}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="image">Service Image(560*400) <span class="text-danger">*</span></label>
                                    <input type="file" id="image" name="image" class="form-control-file" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="image">Service Icon (Optional)</label>
                                    <input type="file" id="icon_image" name="icon_image" class="form-control-file">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">Service Short Description (Maximum 12 Words) <span class="text-danger">*</span></label>
                                    <textarea id="description" rows="4" name="description" class="form-control" required></textarea>
                                </div>

                                <div class="form-group col-md-12 text-center">
                                    <hr class="bg-secondary">
                                    <label >Service Details</label>
                                    <hr class="bg-secondary">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="image">Service Details Images (this images will appear on service details page)</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="image">Image 1 (optional)</label>
                                    <input type="file" id="image_1" name="image_1" class="form-control-file">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="image">Image 2 (optional)</label>
                                    <input type="file" id="image_2" name="image_2" class="form-control-file">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="image">Image 3 (optional)</label>
                                    <input type="file" id="image_3" name="image_3" class="form-control-file">
                                </div>

                                <div class="form-group col-md-12 mt-3">
                                    <label for="find_point">FINE PRINT (Use Bulleted List with title)</label>
                                    <textarea id="find_point" name="find_point" rows="4" class="form-control"></textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="how_it_work">How it works/Includes (Use Bulleted List with title )</label>
                                    <textarea id="how_it_work" name="how_it_work" rows="4" class="form-control"></textarea>
                                </div>

                                {{--<div class="form-group col-md-12">
                                    <hr>
                                    <label for="image">Service Questions</label>
                                    <hr>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name">Question</label>
                                    <input type="text" id="question" name="question[]" class="form-control" placeholder="type question">
                                </div>
                                <div class="form-group col-md-6">
                                    &nbsp;
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name">Question Type</label>
                                    <select class="form-control type_questions" name="question_type[]" id="question_type">
                                        <option value="">select one</option>
                                        <option value="input">Input</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="radio">Radio</option>
                                        <option value="checkbox">Checkbox</option>
                                    </select>
                                </div>


                                <div id="hidden_div" class="field_wrapper" style="width: 50%; padding-bottom: 15px; margin-left: 7px; display: none">
                                    <div class="form-group">
                                        <label for="name">Option</label>
                                        <div style="display: flex">
                                        <input class="form-control col-md-9" type="text" name="option[]" value=""/>
                                        <a href="javascript:void(0);" class="add_button col-md-2" title="Add field">
                                             <i class="fa fa-plus-square"> </i>
                                        </a>
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="form-group col-md-4">
                                    <label for="name">Hot Deal? <span class="text-danger">*</span></label>
                                    <select class="form-control" name="hot_deal_status" id="" required>
                                        <option value="">select one</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Trending Service? <span class="text-danger">*</span></label>
                                    <select class="form-control" name="trending_service_status" id="" required>
                                        <option value="">select one</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Recommended Service? <span class="text-danger">*</span></label>
                                    <select class="form-control" name="recommended_service_status" id="" required>
                                        <option value="">select one</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
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


    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        /* CKEDITOR.replace( 'description' );*/
    </script>
    <script>
        CKEDITOR.replace( 'find_point' );
    </script>
    <script>
        CKEDITOR.replace( 'how_it_work' );
    </script>

    <script>
        $(document).ready(function(){
            $("#service_category").change(function () {
                var id = $("#service_category").val();
                $.ajax({
                    url: "{{URL('/admin/services-manage/ajax/')}}/"+id,
                    method: "get",
                    success: function(result){
                        console.log(result.response);
                        var option = "";
                        data = (result.response);
                        data.forEach(function (element) {
                            option += "<option value='"+element.id+"'>"+element.sub_category+"</option>";
                        });
                        $("#service_sub_category").html(option);
                    }
                });
            });

        });
    </script>
@endpush
