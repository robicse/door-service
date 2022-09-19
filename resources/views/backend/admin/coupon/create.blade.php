@extends('backend.layouts.master')
@section("title","Coupon Create")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Coupon Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Coupon Create</li>
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
                        <h3 class="card-title float-left">Add Coupon</h3>
                        <div class="float-right">
                            <a href="{{route('admin.coupon.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.coupon.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-4">
                                <label for="name">Coupon Code</label>
                                <input type="name" class="form-control" name="code" id="name" placeholder="Enter Coupon Code" required>
                            </div>

                            <div class="form-group ">
                                <label for="image">Coupon Value</label>
                                <input type="number" class="form-control" name="value" id="image" required>
                            </div>
                            <div class="form-group ">
                                <label for="image">Minimum Spent</label>
                                <input type="number" class="form-control" name="min" id="min" required>
                            </div>
                            <div class="form-check">
                                <label for="image">Coupon Type</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="exampleRadios1" value="fixed" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Flat rate on full cart
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="type" id="exampleRadios2" value="percent">
                                <label class="form-check-label" for="exampleRadios2">
                                    Precentage on full cart
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <label class="" for="file">
                                    Upload Coupon Image
                                </label>
                                <input class="form-group" type="file" name="image" id="file"
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
