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
        <div class="row">
            <div class="col-12">
            <!-- general form elements -->
                <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title float-left"></h3>
                    <div class="float-right">
                        <a href="{{route('admin.services.index')}}">
                            <button class="btn btn-success">
                                <i class="fa fa-backward"> </i>
                                Back
                            </button>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                    <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.services.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="name">Service Name <small class="text-danger">(requried*)</small></label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="slug">Slug (SEO Url) <small class="text-danger">(requried* and unique)</small></label>
                                    <input type="text" id="slug" name="slug" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="slug">Hotline <small class="text-danger">(mobile number)</small></label>
                                    <input type="text" id="hotline" name="hotline" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="image">Image <small class="text-danger">(requried*)</small></label>
                                    <input type="file" id="image" name="image" class="form-control-file">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="image_alt">Image Alt</label>
                                    <input type="text" id="image_alt" name="image_alt" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="meta_title">Pdf</label>
                                    <input type="file" id="pdf" name="pdf" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="description">Product Description For Home <small class="text-danger">(requried*)</small></label>
                                    <textarea  rows="5" id="home_description" name="home_description" class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_description">Meta Description</label>
                                    <input id="meta_description" rows="3" name="meta_description" class="form-control"></input>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="description">Product Description <small class="text-danger">(requried*)</small></label>
                                    <textarea id="description" name="description" class="form-control"></textarea>
                                </div>

                            </div>
                            <hr>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Save">
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
        CKEDITOR.replace( 'description' );
    </script>
    <script>
        $(document).ready(function(){
            $("#service_category_id").change(function () {
                var id = $("#service_category_id").val();
                $.ajax({
                    url: "{{URL('/admin/services/ajax/')}}/"+id,
                    method: "get",
                    success: function(result){
                        console.log(result.response);
                        var option = "";
                        data = (result.response);
                        data.forEach(function (element) {
                            option += "<option value='"+element.id+"'>"+element.name+"</option>";
                        });
                        $("#service_subcategory_id").html(option);
                    }
                });
            });

        });
    </script>
@endpush
