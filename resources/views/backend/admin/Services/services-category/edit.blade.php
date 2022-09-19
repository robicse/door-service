@extends('backend.layouts.master')
@section("title","Services Category Edit")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Category Edit</li>
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
                        <h3 class="card-title float-left">Edit Category</h3>
                        <div class="float-right">
                            <a href="{{route('admin.services-category.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.services-category.update',$service_cate_data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="category">Service Category Name</label>
                                    <input type="text" class="form-control" name="category" value="{{$service_cate_data->category}}"  id="category">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image">Title(Maximum 10 Words)</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="short title" value="{{$service_cate_data->short_description}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image">Short Description(Maximum 30 Words)</label>
{{--                                    <input type="text" class="form-control" name="description" id="description" placeholder="short description" value="{{$service_cate_data->description}}">--}}
                                    <textarea class="form-control" name = "description" id = "description" rows = "5" required>{{$service_cate_data->description}}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="icon">Service Category Icon(50*50)</label>
                                    <input type="file" class="form-control" name="icon" id="icon" value="{{$service_cate_data->icon}}">
                                    <img src="{{asset('uploads/category/icon/'.$service_cate_data->icon)}}" width="150" alt="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image">Service Category Image(560*400)</label>
                                    <input type="file" class="form-control" name="banner" id="banner" value="{{$service_cate_data->banner}}">
                                    <img src="{{asset('uploads/category/'.$service_cate_data->image)}}" width="150" alt="">
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2').select2();
        $('.textarea').wysihtml5({
            toolbar: { fa: true }
        })
    </script>
@endpush
