@extends('backend.layouts.master')
@section("title","Career Create")
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
                    <h1>Career Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Career Create</li>
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
                    <h3 class="card-title float-left">Create Career</h3>
                    <div class="float-right">
                        <a href="{{route('admin.career.index')}}">
                            <button class="btn btn-success">
                                <i class="fa fa-backward"> </i>
                                Back
                            </button>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('admin.career.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group  col-md-6">
                                <label for="title">Career Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Post Title">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="education">Career Education</label>
                                <input type="text" class="form-control" name="education" id="education" placeholder="Enter Post Education">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="experience">Career Experience</label>
                                <input type="text" class="form-control" name="experience" id="experience" placeholder="Enter Post Experience">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="deadline">Career Deadline</label>
                                <input type="text" class="form-control" name="deadline" id="deadline" placeholder="Enter Post Deadline">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">Career Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Enter Post Email">
                            </div>
                        </div>
                        <br>
                        <div class="form-group ">
                            <label for="description">Career Description</label>
                            <textarea type="text" class="form-control textarea" name="description" id="description" placeholder="Enter Post Description"></textarea>
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
