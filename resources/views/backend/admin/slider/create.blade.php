@extends('backend.layouts.master')
@section("title","Slider Create")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Slider</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Create Slider</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content" style="padding-top: 20px;">
        <div class="row">
            <div class="col-8 offset-2">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Add Sliders</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.slider.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
{{--                            <div class="form-group">--}}
{{--                                <label for="title">Title</label>--}}
{{--                                <input type="text" class="form-control" name="title" id="title"--}}
{{--                                       placeholder="Enter Title">--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="image">Slider Image <small>(size: 1920 * 1170 pixel)</small></label>
                                <input type="file" class="form-control" name="image" id="image" >
                            </div>
                            <div class="form-group">
                                <label for="url">Url</label>
                                <input type="text" class="form-control" name="url" id="url"
                                       placeholder="Enter link">
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

@endpush
