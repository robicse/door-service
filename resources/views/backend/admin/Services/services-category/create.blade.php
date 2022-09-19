@extends('backend.layouts.master')
@section("title","Service Category Create")
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
                    <h1>Category Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.services-category.index')}}">Category List</a></li>
                        <li class="breadcrumb-item active">Category Create</li>
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
                        <h3 class="card-title float-left">Service Category</h3>
                        {{--<div class="float-right">
                            <a href="{{route('admin.services-category.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>--}}
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.services-category.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="image">Services Category Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="category" id="category" placeholder="type service category name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image">Title(Maximum 10 Words)<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="short title" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image">Short Description(Maximum 30 Words)<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name = "description" id = "description" rows = "3" required></textarea>
{{--                                    <input type="text" class="form-control" name="description" id="description" placeholder="short description">--}}
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="icon">Services Category Icon(50*50)<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="icon" id="icon" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image">Services Category Image(560*400)<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="banner" id="banner" required>
                                </div>
                            </div>


                            <!-- /.card-body -->
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
