@extends('backend.layouts.master')
@section("title","Service Sub Category Edit")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service Sub Category Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Service Sub Category Edit</li>
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
                        <h3 class="card-title float-left">Edit Service Sub Category</h3>
                        <div class="float-right">
                            <a href="{{route('admin.services-sub-category.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.services-sub-category.update',$service_sub_cate_data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="sub_category" id="sub_category" value="{{$service_sub_cate_data->sub_category}}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="category_id">Category</label>
                                    <select name="service_category_id" id="service_category_id" class="form-control" required>
                                        @foreach($service_category as $category)
                                            <option value="{{$category->id}}" {{($service_sub_cate_data->category_id == $category->id)  ? 'selected' : ''}}>{{$category->category}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name">Banner Image (1920*500)</label>
                                    <input type="file" class="form-control" name="banner" id="banner">
                                    <img class="mt-3" src="{{asset('uploads/sub-category/'.$service_sub_cate_data->banner)}}" width="280" height="50" alt="">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name">Icon for Subcategory (200*200)</label>
                                    <input type="file" class="form-control" name="icon" id="icon">
                                    <img class="mt-3" src="{{asset('uploads/sub-category/'.$service_sub_cate_data->icon)}}" width="50" height="50" alt="">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="5" required>
                                {{$service_sub_cate_data->description}}
                            </textarea>
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

    {{--    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>--}}
    {{--    <script>--}}
    {{--        CKEDITOR.replace( 'description' );--}}
    {{--    </script>--}}

@endpush
