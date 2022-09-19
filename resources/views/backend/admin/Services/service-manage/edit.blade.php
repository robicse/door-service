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
                    <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.services-manage.update',$service->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @php
                            $service_details = \App\ServiceDetail::where('service_id',$service->id)->first();


                        @endphp

                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Service Name <span class="text-danger">*</span></label>
                                    <input type="text" id="service_name" name="service_name" value="{{$service->service_name}}" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Service Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="service_type" id="service_type" required>
                                        <option value="">select one</option>
                                        <option value="Quotation" {{$service->service_type == "Quotation" ? 'selected' : ''}}>Quotation Type</option>
                                        <option value="Fixed" {{$service->service_type == "Fixed" ? 'selected' : ''}}>Fixed Type</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="service_price">Service Price <span class="text-danger">*</span></label>
                                    <input type="number" id="service_price" name="service_price" class="form-control" value="{{$service->service_price}}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Service Category <span class="text-danger">*</span></label>
                                    <select class="form-control" name="service_category" id="service_category" required>
                                        @foreach($service_category as $cate_data)
                                            <option value="{{$cate_data->id}}" {{ $service->category_id == $cate_data->id ? 'selected' : '' }}>{{$cate_data->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Service Sub Category <span class="text-danger">*</span></label>
                                    <select class="form-control" name="service_sub_category" id="service_sub_category" required>
                                        @foreach($service_sub_category as $sub_cate_data)
                                            <option value="{{$sub_cate_data->id}}" {{ $service->sub_category == $sub_cate_data->id ? 'selected' : '' }}>{{$sub_cate_data->sub_category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="image">Image <span class="text-danger">*</span></label>
                                    <input type="file" id="image" name="image" class="form-control-file" value="{{$service->image}}">
                                    <img src="{{asset('uploads/service/'.$service->image)}}" alt="" width="100">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="image">Icon</label>
                                    <input type="file" id="icon_image" name="icon_image" class="form-control-file" value="$service->icon_image">
                                    <img src="{{asset('uploads/service/'.$service->icon_image)}}" alt="" width="100">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea id="description" rows="4" name="description" class="form-control" required>{{$service->description}}</textarea>
                                </div>


                                <div class="form-group col-md-12">
                                    <hr>
                                    <label for="image">Service Details</label>
                                    <hr>
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="image">Image 1</label>
                                    <input type="file" id="image_1" name="image_1" value="{{$service_details->image_1}}" class="form-control-file">
                                    <img class="mt-2" src="{{asset('uploads/service/'.$service_details->image_1)}}" alt="" width="100">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="image">Image 2</label>
                                    <input type="file" id="image_2" name="image_2" value="{{$service_details->image_2}}" class="form-control-file">
                                    <img class="mt-2" src="{{asset('uploads/service/'.$service_details->image_2)}}" alt="" width="100">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="image">Image 3</label>
                                    <input type="file" id="image_3" name="image_3" value="{{$service_details->image_3}}" class="form-control-file">
                                    <img class="mt-2" src="{{asset('uploads/service/'.$service_details->image_3)}}" alt="" width="100">
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="find_point">Find Point</label>
                                    <textarea id="find_point" rows="4" name="find_point" class="form-control">{{$service_details->find_point}}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="how_it_work">How it works/Includes</label>
                                    <textarea id="how_it_work" rows="4" name="how_it_work" class="form-control">{{$service_details->how_it_work}}</textarea>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="name">Hot Deal? <span class="text-danger">*</span></label>
                                    <select class="form-control" name="hot_deal_status" id="" required>
                                        <option value="">select one</option>
                                        <option value="0" {{$service_details->hot_deal_status == 0 ? 'selected' : ''}}>No</option>
                                        <option value="1" {{$service_details->hot_deal_status == 1 ? 'selected' : ''}}>Yes</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Trending Service? <span class="text-danger">*</span></label>
                                    <select class="form-control" name="trending_service_status" id="" required>
                                        <option value="">select one</option>
                                        <option value="0" {{$service_details->trending_service_status == 0 ? 'selected' : ''}}>No</option>
                                        <option value="1" {{$service_details->trending_service_status == 1 ? 'selected' : ''}}>Yes</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">Recommended Service? <span class="text-danger">*</span></label>
                                    <select class="form-control" name="recommended_service_status" id="" required>
                                        <option value="">select one</option>
                                        <option value="0" {{$service_details->recommended_service_status == 0 ? 'selected' : ''}}>No</option>
                                        <option value="1" {{$service_details->recommended_service_status == 1 ? 'selected' : ''}}>Yes</option>
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
        /*CKEDITOR.replace( 'description' );*/
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
