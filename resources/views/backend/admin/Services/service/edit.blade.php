@extends('backend.layouts.master')
@section("title","Service Edit")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Service Edit</li>
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
                        <h3 class="card-title float-left">Edit Service</h3>
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
                    <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.services.update',$service->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="name">Service Name <small class="text-danger">(requried*)</small></label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{$service->name}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="slug">Slug (SEO Url) <small class="text-danger">Change slug
                                            <a href="#" data-toggle="modal" data-target="#exampleModal">Click Here</a></small>
                                    </label>
                                    <input type="text" id="slug" name="slug" class="form-control" value="{{$service->slug}}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Hotline<small class="text-danger">(requried*)</small></label>
                                    <input type="text" id="hotline" name="hotline" class="form-control" value="{{$service->hotline}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <img src="{{asset('uploads/service/'.$service->image)}}" alt="" width="100px;">
                                    <label for="image">Image <small class="text-danger">(requried*)</small></label>
                                    <input type="file" id="image" name="image" class="form-control-file">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="image_alt">Image Alt</label>
                                    <input type="text" id="image_alt" name="image_alt" class="form-control" value="{{$service->image_alt}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{$service->meta_title}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="meta_title"></label>
{{--                                    <a download href="{{ URL::to('/') }}/uploads/service/pdf/{{ $service->pdf }}"/>Pdf--}}
                                    <td><a download href="{{ asset('/uploads/service/pdf/'. $service->pdf )}}"/>Pdf</td>
{{--                                    <img src="{{ asset('/uploads/service/pdf/'. $service->pdf )}}" alt="" width="100px;">--}}
                                    <input type="file" id="pdf" name="pdf" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="description">Product Description For Home <small class="text-danger">(requried*)</small></label>
                                    <textarea  rows="5" id="home_description" name="home_description" class="form-control">{{$service->home_description}}</textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea id="meta_description" rows="3" name="meta_description" class="form-control">{{$service->meta_description}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="description">Product Description <small class="text-danger">(requried*)</small></label>
                                    <textarea id="description" name="description" class="form-control">{{$service->description}}</textarea>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SEO URL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Please Change it very carefully.</p>
                    <form action="{{route('admin.services.slug-change')}}" method="post">
                        @csrf
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <div class="form-gorup">
                            <label for="slug">Slug Eidt</label>
                            <input type="text" name="slug" class="form-control" value="{{$service->slug}}">
                        </div>
                        <br>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
