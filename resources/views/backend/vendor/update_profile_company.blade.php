@extends('backend.layouts.master')
@section("title","Update Profile")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
    {{--<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">--}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
            integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
            crossorigin=""></script>
    <style>

        .timeline:before {
            background: none;
        }
        .service-image{
            border: 1px solid #ddd;
            margin: 0 auto;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .bksearch {
            padding: 6px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #000000!important;
        }
        .tooltip > .tooltip-inner {background-color: #f00;}

        .warningColor {
            color: red;
        }
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vendor profile update</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('vendor.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Vendor profile update</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{asset('uploads/profile/'.Auth::user()->image)}}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                            {{--<p class="text-muted text-center">{{Auth::user()->email}}</p>--}}
                            <p class="text-muted text-center"><span
                                        class="badge badge-info text-white">Account Type: {{$vendor_details->account_category}}</span>
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email: </b> <a class="float-right">{{Auth::user()->email}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Mobile</b> <a class="float-right">{{Auth::user()->mobile_number}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Balance</b> <a class="float-right">0.00tk</a>
                                </li>
                            </ul>

                            {{--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>--}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fa fa-info-circle mr-1"></i>Short Bio</strong>

                            <p class="text-muted">
                                {{$vendor_details->short_bio}}
                            </p>

                            <hr>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                        <div style="background: #f0a1a1; padding:13px 10px;border-radius:10px" class="mb-3">
                        @if(count($vendorService) == 0 && $vendor_details->services_area == '')
                            <span class="warningColor">Note: To provide service, Please complete your Area field from Business info and Service info</span>
                            @elseif(count($vendorService) == 0)
                                <span class="warningColor">Note: To provide service, Please complete your Service info</span>
                            @elseif($vendor_details->services_area == '')
                                <span class="warningColor">Note: To provide service, Please complete your Area field from Business info</span>
                            @else

                            @endif
                        </div>
                            
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link" href="#personal_info" data-toggle="tab">Personal Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#reference" data-toggle="tab">Business info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#service_info" data-toggle="tab">Service Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#change_pass" data-toggle="tab">Change Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#gallery" data-toggle="tab">Document</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="personal_info">
                                    <form class="form-horizontal" action="{{route('vendor.profile.update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" name="name"
                                                       value="{{Auth::user()->name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                       value="{{Auth::user()->email}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Mobile</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                       value="{{Auth::user()->mobile_number}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="image" class="col-sm-2 col-form-label">Profile Image</label>
                                            <div class="col-sm-10">
                                                <small class="text-info">(upload your profile image 300*300 pixel and size max 100kb)</small>
                                                <input type="file" name="image" class="form-control-file" id="image">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane " id="gallery">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <span class="float-left">NID</span>
                                                <span class="float-right">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#image_gallery">
                                                        Add Image
                                                    </button>

                                                </span> <br>
                                            </h3>
                                            <div class="timeline-body">
                                                <div class="row">
                                                    @forelse($nidImages as $nidImage)
                                                        <div class=" col-md-3">
                                                            <div class="card text-center">
                                                                <img src="{{asset('uploads/vendor/nid/'.$nidImage->image)}}"
                                                                     width="150" height="100" alt="..."
                                                                     class="service-image">
                                                                <div class="mb-2">
                                                                        <span class="">
                                                                             <a onclick="deleteImage({{$nidImage->id}})" class="btn btn-danger">
                                                                                <i class="fa fa-trash text-white"></i>
                                                                            </a>
                                                                            <a href="{{asset('uploads/vendor/nid/'.$nidImage->image)}}" class="btn btn-primary" download="">
                                                                                <i class="fa fa-download"></i>
                                                                            </a>
                                                                        </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @empty
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>

                                        <div class="timeline-item mt-3">
                                            <h3 class="timeline-header">Trade License Image</h3>
                                            <div class="timeline-body">
                                                <div class="row">
                                                    @forelse($TLImages as $tlImage)
                                                        <div class=" col-md-3">
                                                            <div class="card text-center">
                                                                <img src="{{asset('uploads/vendor/trade_license/'.$tlImage->image)}}"
                                                                     width="150" height="100" alt="..."
                                                                     class="service-image">
                                                                <div class="mb-2">
                                                                    <span class="w-100">
                                                                        <a onclick="deleteImage({{$tlImage->id}})" class="btn btn-danger">
                                                                            <i class="fa fa-trash text-white"></i>
                                                                        </a>
                                                                        <a href="{{asset('uploads/vendor/trade_license/'.$tlImage->image)}}" class="btn btn-primary" download="">
                                                                            <i class="fa fa-download"></i>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @empty
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item mt-3">
                                            <h3 class="timeline-header">Document for Verification</h3>
                                            <div class="timeline-body">
                                                <div class="row">
                                                    @forelse($jobImages as $jobImage)
                                                        <div class=" col-md-3">
                                                            <div class="card text-center">
                                                                <img src="{{asset('uploads/vendor/jobs/'.$jobImage->image)}}"
                                                                     width="150" height="100" alt="..."
                                                                     class="service-image">
                                                                <div class="mb-2">
                                                                    <span class="w-100">
                                                                        <a onclick="deleteImage({{$jobImage->id}})" class="btn btn-danger">
                                                                            <i class="fa fa-trash text-white"></i>
                                                                        </a>
                                                                        <a href="{{asset('uploads/vendor/jobs/'.$jobImage->image)}}" class="btn btn-primary" download="">
                                                                            <i class="fa fa-download"></i>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item mt-3">
                                            <h3 class="timeline-header">Company/Showroom/Shop/Office Image</h3>
                                            <div class="timeline-body">
                                                <div class="row">
                                                    @forelse($shopImages as $shopImage)
                                                        <div class=" col-md-3">
                                                            <div class="card text-center">
                                                                <img src="{{asset('uploads/vendor/shop/'.$shopImage->image)}}"
                                                                     width="150" height="100" alt="..."
                                                                     class="service-image">
                                                                <div class="mb-2">
                                                                    <span class="w-100">
                                                                        <a onclick="deleteImage({{$shopImage->id}})" class="btn btn-danger">
                                                                            <i class="fa fa-trash text-white"></i>
                                                                        </a>
                                                                        <a href="{{asset('uploads/vendor/shop/'.$shopImage->image)}}" class="btn btn-primary" download="">
                                                                            <i class="fa fa-download"></i>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @empty
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                        <img class="m-2" src="http://placehold.it/150x100" alt="...">
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <!-- END timeline item -->
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="reference">
                                    <form role="form" action="{{route('vendor.update.profile.ac')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="vendor_company_name" class="col-form-label">Vendor Organization Name</label>
                                                <input type="text" class="form-control" name="vendor_company_name" id="vendor_company_name" value="{{$vendor_details->vendor_company_name}}">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="trade_license_number" class="col-form-label">Trade License Number</label>
                                                <input type="text" name="trade_license_number" class="form-control" id="trade_license_number" value="{{$vendor_details->trade_license_number}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="validity_of_license" class="col-form-label">Trade License Validity Till.<span><i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="remind your account will be closed with the validity date of your trade license until you will submit the new issue copy"></i></span></label>
                                                <input type="date" name="validity_of_license" class="form-control" id="validity_of_license" value="{{$vendor_details->validity_of_license}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">Bank Account Number</label>
                                                <input type="text" class="form-control" name="bank_account_number"
                                                       id="bank_account_number"
                                                       value="{{ $vendor_details->bank_account_number}}"
                                                       placeholder="type bank account number">
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="name">When you are available to provide this service? </label>
                                                <select class="form-control" name="ven_service_provide_schedule"
                                                        id="ven_service_provide_schedule" required>
                                                    <option value="">select one</option>
                                                    <option value="anytime" {{ $vendor_details->ven_service_provide_schedule == 'anytime' ? 'selected' : '' }}>
                                                        Anytime
                                                    </option>
                                                    <option value="monthly" {{ $vendor_details->ven_service_provide_schedule == 'monthly' ? 'selected' : '' }}>
                                                        Monthly
                                                    </option>
                                                    <option value="weekly" {{ $vendor_details->ven_service_provide_schedule == 'weekly' ? 'selected' : '' }}>
                                                        Weekly
                                                    </option>
                                                    <option value="others" {{ $vendor_details->ven_service_provide_schedule == 'others' ? 'selected' : '' }}>
                                                        Others
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">What time you are available to provide this service? </label>
                                                <select class="form-control" name="ven_service_provide_time"
                                                        id="ven_service_provide_time" required>
                                                    <option value="">select one</option>

                                                    <option value="anytime" {{ $vendor_details->ven_service_provide_time == 'anytime' ? 'selected' : '' }}>
                                                        Anytime
                                                    </option>
                                                    <option value="morning" {{ $vendor_details->ven_service_provide_time == 'morning' ? 'selected' : '' }}>
                                                        Morning
                                                    </option>
                                                    <option value="afternoon" {{ $vendor_details->ven_service_provide_time == 'afternoon' ? 'selected' : '' }}>
                                                        Afternoon
                                                    </option>
                                                    <option value="holidays" {{ $vendor_details->ven_service_provide_time == 'holidays' ? 'selected' : '' }}>
                                                        Holidays
                                                    </option>
                                                    <option value="only-night" {{ $vendor_details->ven_service_provide_time == 'only-night' ? 'selected' : '' }}>
                                                        Only night
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Practical Experiences </label>
                                                <select class="form-control" name="practical_experiences"
                                                        id="practical_experiences">
                                                    <option value="">select one</option>
                                                    <option value="No" {{ $vendor_details->practical_experiences == 'No' ? 'selected' : '' }}>
                                                        No
                                                    </option>
                                                    <option value="Yes" {{ $vendor_details->practical_experiences == 'Yes' ? 'selected' : '' }}>
                                                        Yes
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">Area </label>
                                                {{--<input type="text" class="bksearch form-control" name="bksearch"
                                                       value="{{$vendor_details->services_area}}">
                                                <div class="bklist">--}}
                                                <input type="text" value="{{$vendor_details->services_area}}" onkeyup="getAddress2()" placeholder="Search Your Area"
                                                       class="form-control form_height form-control-sm address2" autocomplete="off" style="position: relative;" required>
                                                <ul class="list-group addList2" style="padding: 0; position: absolute; z-index: 999; overflow-y: scroll; display: none; height: 300px;">

                                                </ul>

                                                <input type="hidden" name="city">
                                                <input type="hidden" name="area">
                                                <input type="hidden" name="latitude">
                                                <input type="hidden" name="longitude">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6" id="month_area">
                                                <label for="month">Month(Practical Experiences) </label>
                                                <input type="text" class="form-control" name="month"
                                                       id="month"
                                                       value="{{ $vendor_details->month}}"
                                                       placeholder="experience month">
                                            </div>
                                            <div class="form-group col-md-6" id="year_area">
                                                <label for="year">Year(Practical Experiences) </label>
                                                <input type="text" class="form-control" name="year"
                                                       id="year"
                                                       value="{{ $vendor_details->year}}"
                                                       placeholder="experience year">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Professional Reference Name </label>
                                                <input type="text" class="form-control" name="professional_ref_name"
                                                       id="professional_ref_name"
                                                       value="{{ $vendor_details->professional_ref_name}}"
                                                       placeholder="Professional Reference Name">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="name">Professional Reference Mobile </label>
                                                <input type="text" class="form-control" name="professional_ref_number"
                                                       id="professional_ref_number"
                                                       value="{{ $vendor_details->professional_ref_number}}"
                                                       placeholder="Professional Reference Mobile">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Personal Reference Name </label>
                                                <input type="text" class="form-control" name="personal_ref_name"
                                                       id="personal_ref_name" value="{{ $vendor_details->personal_ref_name}}"
                                                       placeholder="Personal Reference Name">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="name">Personal Reference Mobile </label>
                                                <input type="text" class="form-control" name="personal_ref_mobile"
                                                       id="personal_ref_mobile"
                                                       value="{{ $vendor_details->personal_ref_mobile}}"
                                                       placeholder="Personal Reference Mobile">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Address </label>
                                                <textarea class="form-control" name="address" id="address" rows="2">
                                                    {{ $vendor_details->address}}
                                                </textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">Write a short note about you maximum 300 </label>
                                                <textarea class="form-control" name="short_bio"  id="short_bio" rows="4">
                                                   {{$vendor_details->short_bio}}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="name">Do you like to show us anything else that we should
                                                    know? </label>
                                                <textarea type="text" class="form-control" name="vendor_feedback"
                                                       id="vendor_feedback" placeholder="This field will help us to know about you more clearly"> {{ $vendor_details->vendor_feedback}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <div class="">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="tab-pane" id="change_pass">
                                    <form class="form-horizontal" action="{{route('vendor.change.password')}}"
                                          method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="old_password" class="col-sm-2 col-form-label">Old
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="old_password"
                                                       id="old_password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password"
                                                       id="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">Confirm
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password_confirmation"
                                                       id="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane active" id="service_info">
                                    <button class="btn btn-success float-right m-2" data-toggle="modal" data-target="#vs_modal">Add</button>
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#Id</th>
                                                <th>Category</th>
                                                <th>Subcategory</th>
                                                <th>Services</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($vendorService as $key => $vendorServiceData)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$vendorServiceData->category->category}}</td>
                                                    <td>{{$vendorServiceData->subcategory->sub_category}}</td>
                                                    <td>{{$vendorServiceData->service->service_name}}</td>

                                                    <td>

                                                        <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#vs_modal_edit-{{$vendorServiceData->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger waves-effect" type="button"
                                                                onclick="deleteVendorService({{$vendorServiceData->id}})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                                {{--vendor service edit modal start--}}
                                                <div class="modal fade" id="vs_modal_edit-{{$vendorServiceData->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{{$vendorServiceData->service->service_name}} Edit</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @php
                                                                    $catWiseService = \App\ServiceManage::where('sub_category',$vendorServiceData->subcategory_id )->get();
                                                                @endphp
                                                                <form action="{{route('vendor.service-updated-by-vendor',$vendorServiceData->id)}}" method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="form-group col-md-3">
                                                                            <label for="name">Service Category</label>
                                                                            <input type="text" class="form-control"  value="{{$vendorServiceData->category->category}}" readonly>
                                                                        </div>

                                                                        <div class="form-group col-md-3">
                                                                            <label for="name">Service Sub Category </label>
                                                                            <input type="text" class="form-control"  value="{{$vendorServiceData->subcategory->sub_category}}" readonly>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="name">Services</label>
                                                                            <select class="form-control" id="service_sub_category_service"  name="service_id"  >
                                                                                @foreach($catWiseService as $csData)
                                                                                    <option value="{{$csData->id}}" {{$csData->id == $vendorServiceData->service_id ? 'selected' : ''}}>{{$csData->service_name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-3">
                                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{--vendor service edit modal end--}}
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>#Id</th>
                                                <th>Category</th>
                                                <th>Subcategory</th>
                                                <th>Services</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <!-- Modal iamge gallery-->
        <div class="modal fade" id="image_gallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Images</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="{{route('vendor.gallery.image.store')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Please Select Type</option>
                                        <option value="nid">NID</option>
                                        <option value="jobs">Document for Verification</option>
                                        @if($vendor_details->account_category == 'company')
                                        <option value="trade_license">Trade License Copy</option>
                                        <option value="shop">company/showroom/shop/office</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <small class="text-info">(You can upload multiple image at a time.)</small>
                                    <input type="file" class="form-control-fle" name="image[]" id="image" multiple>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--vendor service add modal start--}}
        <div class="modal fade" id="vs_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add your services</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('vendor.service-selected-by-vendor')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="name">Service Category</label>
                                    <select class="form-control" name="category_id" id="service_category">
                                        <option value="">Select one</option>
                                        @foreach($service_category as $sercatedata)
                                            <option value="{{$sercatedata->id}}" {{ $vendor_details->service_category == $sercatedata->id ? 'selected' : '' }}>{{$sercatedata->category}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="name">Service Sub Category </label>
                                    <select class="form-control" name="subcategory_id"
                                            id="service_sub_category">
                                        {{--                                            <option value="{{$sub_category->id}}">{{$sub_category->sub_category}}</option>--}}
                                        {{--@foreach($service_sub_category as $sub_cate_data)
                                            <option value="{{$sub_cate_data->id}}">{{$sub_cate_data->sub_category}}</option>
                                        @endforeach--}}
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Services</label>
                                    <select class="form-control select3" id="service_sub_category_service_2"  name="service_id[]" multiple="multiple"  style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        {{--vendor service add modal end--}}




    </section>
@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.js?key:MTg3NzpCRE5DQ01JSkgw"></script>
    {{--<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>--}}
    <!-- Select2 -->
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <script>
       /* Bkoi.onSelect(function () {
            // get selected data from dropdown list
            let selectedPlace = Bkoi.getSelectedData()
            console.log(selectedPlace)
            // center of the map
            document.getElementsByName("address")[0].value = selectedPlace.address;
            document.getElementsByName("city")[0].value = selectedPlace.city;
            document.getElementsByName("area")[0].value = selectedPlace.area;
            document.getElementsByName("latitude")[0].value = selectedPlace.latitude;
            document.getElementsByName("longitude")[0].value = selectedPlace.longitude;

        })*/

        function getAddress2() {
            let places=[];
            let location=null;
            let add=$('.address2').val();
            console.log(add)
            $('.addList2').empty();
            fetch("https://barikoi.xyz/v1/api/search/autocomplete/MTg5ODpJUTVHV0RWVFZP/place?q="+add)
                .then(response => response.json())
                .catch(error => console.error('Error:', error))
                .then(response => {
                    response.places.forEach(result2)
                })
        }
        function result2(item, index){
            $('.addList2').show();
            var $li = $("<li class='list-group-item'><a href='#' class='list-group-item bg-light'>" + item.address + "</a></li>");
            $(".addList2").append($li);
            $li.on('click', getPlacesDetails2.bind(this, item));
        }
        function getPlacesDetails2(mapData)
        {
            $('.addList2').hide();
            $(".addList2").empty();
            $( ".address2" ).val(mapData.address)
            $( "input[name='city']" ).val(mapData.city)
            $( "input[name='area']" ).val(mapData.area)
            $( "input[name='latitude']" ).val(mapData.latitude)
            $( "input[name='longitude']" ).val(mapData.longitude)
            $( "input[name='postal_code']" ).val(mapData.postCode)
            console.log(mapData)
        }

        $(document).ready(function () {
            $("#service_category").change(function () {
                var id = $("#service_category").val();
                //console.log(id);
                $.ajax({
                    url: "{{URL('/vendor/services-manage/ajax/')}}/" + id,
                    method: "get",
                    success: function (result) {
                        console.log(result.response);
                        var option = "<option value=''>" +'Please Select One' + "</option>";
                        data = (result.response);
                        data.forEach(function (element) {
                            option += "<option value='" + element.id + "'>" + element.sub_category + "</option>";
                        });
                        $("#service_sub_category").html(option);
                    }
                });
            });



            $("#service_sub_category").change(function () {
                var id = $("#service_sub_category").val();
                //console.log(id);
                $.ajax({
                    url: "{{URL('/vendor/subcategory-wise-service/ajax/')}}/" + id,
                    method: "get",
                    success: function (result) {
                        console.log(result.response);
                        var option = "";
                        data = (result.response);
                        data.forEach(function (element) {
                            option += "<option value='" + element.id + "'>" + element.service_name + "</option>";
                        });
                        $("#service_sub_category_service_2").html(option);
                    }
                });
            });

        });

        //sweet alert for delete image
        function deleteImage(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    window.location.href='/vendor/gallery/image/delete/'+id
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }

        //sweet alert for delete vendor service
        function deleteVendorService(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    window.location.href='/vendor/service-delete-by-vendor/'+id
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }

        $(function () {
            /*$("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });*/

            $('.select3').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        function vseditmodal(id) {
            document.getElementById('vs_id').val = id;
            $('#vs_modal_edit').modal('show');

        }
        //Initialize Select2 Elements

    </script>

    <script>
        $(document).ready(function(){
            <?php if($vendor_details->practical_experiences == 'No'):?>
            $('#month_area').hide();
            $('#year_area').hide();
            <?php endif;?>
            $("#practical_experiences").change(function () {
                var practical_experiences = $("#practical_experiences").val();

                if(practical_experiences == 'Yes'){
                    $('#month_area').show()
                    $('#year_area').show()
                }else{
                    $('#month_area').hide()
                    $('#year_area').hide()
                }

            });

        });
    </script>

@endpush
