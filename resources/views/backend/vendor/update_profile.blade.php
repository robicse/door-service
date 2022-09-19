@extends('backend.layouts.master')
@section("title","Update Profile")
@push('css')
    {{--<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
            crossorigin=""></script>

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
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Vendor profile update</h3>
                        {{--<div class="float-right">
                            <a href="{{route('admin.client.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>--}}
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-selected="true">Vendor profile Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#image" role="tab" aria-controls="profile" aria-selected="false">Manage Image</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#reference" role="tab" aria-controls="contact" aria-selected="false">Professional Reference </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="home-tab">hello</div>
                        <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="profile-tab">hiiii</div>
                        <div class="tab-pane fade" id="reference" role="tabpanel" aria-labelledby="contact-tab">byeee</div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('vendor.update.profile.ac')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Vendor Name </label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$vendor->name}}">
                                    <input type="hidden" name="vendor_id" id="vendor_id" value="{{$vendor_details->id}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Vendor Email </label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{$vendor->email}}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Vendor Mobile </label>
                                    <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{$vendor->mobile_number}}" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name">Choose the account category </label>
                                    <select class="form-control" name="account_category" id="account_category" disabled>
                                        <option value="{{$vendor_details->account_category}}">{{$vendor_details->account_category}}</option>
                                        <option value="individual">Individual</option>
                                        <option value="company">Company</option>
                                    </select>
                                </div>

    @if ($vendor_details->account_category=='individual')
                                    <div class="form-group col-md-6">
                                        <label for="name">Service Category </label>
                                        <select class="form-control" name="service_category" id="service_category" required>
                                            <option value="">select one</option>
                                            @foreach($service_category as $sercatedata)
                                                <option value="{{$sercatedata->id}}" {{ $vendor_details->service_category == $sercatedata->id ? 'selected' : '' }}>{{$sercatedata->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{--<div class="form-group col-md-6">
                                        <label for="name">Sub Service Category </label>
                                        <select class="form-control" name="sub_service_category" id="sub_service_category" required>
                                            <option value="">select one</option>
                                            <option value="1" {{ $vendor_details->sub_service_category == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ $vendor_details->sub_service_category == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ $vendor_details->sub_service_category == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ $vendor_details->sub_service_category == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ $vendor_details->sub_service_category == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ $vendor_details->sub_service_category == '6' ? 'selected' : '' }}>6</option>
                                            <option value="7" {{ $vendor_details->sub_service_category == '7' ? 'selected' : '' }}>7</option>
                                            <option value="8" {{ $vendor_details->sub_service_category == '8' ? 'selected' : '' }}>8</option>
                                        </select>
                                    </div>--}}

                                    <div class="form-group col-md-6">
                                        <label for="name">Practical Experiences </label>
                                        <input type="text" class="form-control" name="practical_experiences" id="practical_experiences" value="{{ $vendor_details->practical_experiences}}" placeholder="How long you have practical experiences in this field?">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">When you are available to provide this service? </label>
                                        <select class="form-control" name="ven_service_provide_schedule" id="ven_service_provide_schedule" required>
                                            <option value="">select one</option>
                                            <option value="anytime" {{ $vendor_details->ven_service_provide_schedule == 'anytime' ? 'selected' : '' }}>Anytime</option>
                                            <option value="monthly" {{ $vendor_details->ven_service_provide_schedule == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                            <option value="weekly" {{ $vendor_details->ven_service_provide_schedule == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                            <option value="others" {{ $vendor_details->ven_service_provide_schedule == 'others' ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">What time you are available to provide this service? </label>
                                        <select class="form-control" name="ven_service_provide_time" id="ven_service_provide_time" required>
                                            <option value="">select one</option>

                                            <option value="anytime" {{ $vendor_details->ven_service_provide_time == 'anytime' ? 'selected' : '' }}>Anytime</option>
                                            <option value="morning" {{ $vendor_details->ven_service_provide_time == 'morning' ? 'selected' : '' }}>Morning</option>
                                            <option value="afternoon" {{ $vendor_details->ven_service_provide_time == 'afternoon' ? 'selected' : '' }}>Afternoon</option>
                                            <option value="holidays" {{ $vendor_details->ven_service_provide_time == 'holidays' ? 'selected' : '' }}>Holidays</option>
                                            <option value="only-night" {{ $vendor_details->ven_service_provide_time == 'only-night' ? 'selected' : '' }}>Only night</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Area </label>
                                        <input type="text" class="bksearch" name="bksearch" value="{{$vendor_details->address}}">
                                        <div class="bklist">
                                        </div>
                                        <input type="hidden" name="city">
                                        <input type="hidden" name="area">
                                        <input type="hidden" name="latitude">
                                        <input type="hidden" name="longitude">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="name">Address </label>
                                        <textarea class="form-control" name="address" id="address" rows="2">
                                            {{ $vendor_details->address}}
                                        </textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="image">Upload your Photo </label>
                                        <input type="file" class="form-control-file" name="vendor_image" id="vendor_image" value="{{$vendor_details->vendor_image}}">
                                        <img src="{{asset('uploads/'.$vendor_details->vendor_image)}}" width="120">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="image">Upload your national ID card </label>
                                        <input type="file" class="form-control-file" name="vendor_nid" id="vendor_nid" value="{{$vendor_details->vendor_nid}}">
                                        <img src="{{asset('uploads/'.$vendor_details->vendor_nid)}}" width="120">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="name">Write a short note about you maximum 300 </label>
                                        <textarea class="form-control" name="short_bio" id="short_bio" rows="4">
                                             {{ $vendor_details->short_bio}}
                                        </textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="image">Upload the photo of your completed job </label>
                                        <input type="file" class="form-control-file" name="comple_service_photo[]" id="comple_service_photo" multiple value="{{$vendor_details->comple_service_photo}}">
                                        @if ($vendor_details->comple_service_photo !='')
                                            @php
                                                $arr = json_decode($vendor_details->comple_service_photo);
                                               /* echo "<pre>";
                                                print_r($arr);
                                                echo "</pre>";*/
                                            @endphp
                                            @foreach($arr as $data)
                                                <img src="{{asset('uploads/'.$data)}}" alt="" width="100">
                                            @endforeach
                                        @else
                                        <span>You have to upload minimum 5 photos.</span>
                                        @endif

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Do you like to show us anything else that we should know? </label>
                                        <input type="text" class="form-control" name="vendor_feedback" id="vendor_feedback" value="{{ $vendor_details->vendor_feedback}}" placeholder="This field will help us to know about you more clearly">
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="name">Professional Reference Name </label>
                                        <input type="text" class="form-control" name="professional_ref_name" id="professional_ref_name" value="{{ $vendor_details->professional_ref_name}}" placeholder="Professional Reference Name">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Professional Reference Mobile </label>
                                        <input type="text" class="form-control" name="professional_ref_number" id="professional_ref_number" value="{{ $vendor_details->professional_ref_number}}" placeholder="Professional Reference Mobile">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Personal Reference Name </label>
                                        <input type="text" class="form-control" name="personal_ref_name" id="personal_ref_name" value="{{ $vendor_details->personal_ref_name}}" placeholder="Personal Reference Name">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Personal Reference Mobile </label>
                                        <input type="text" class="form-control" name="personal_ref_mobile" id="personal_ref_mobile" value="{{ $vendor_details->personal_ref_mobile}}" placeholder="Personal Reference Mobile">
                                    </div>

    @else

                                    <div class="form-group col-md-6">
                                        <label for="name">Service Category </label>
                                        <select class="form-control" name="service_category" id="service_category" required>
                                            <option value="">select one</option>
                                            @foreach($service_category as $sercatedata)
                                            <option value="{{$sercatedata->id}}" {{ $vendor_details->service_category == $sercatedata->id ? 'selected' : '' }}>{{$sercatedata->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                   {{-- <div class="form-group col-md-6">
                                        <label for="name">Sub Service Category </label>
                                        <select class="form-control" name="sub_service_category" id="sub_service_category" required>
                                            <option value="">select one</option>
                                            <option value="1" {{ $vendor_details->sub_service_category == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ $vendor_details->sub_service_category == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ $vendor_details->sub_service_category == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ $vendor_details->sub_service_category == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ $vendor_details->sub_service_category == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ $vendor_details->sub_service_category == '6' ? 'selected' : '' }}>6</option>
                                            <option value="7" {{ $vendor_details->sub_service_category == '7' ? 'selected' : '' }}>7</option>
                                            <option value="8" {{ $vendor_details->sub_service_category == '8' ? 'selected' : '' }}>8</option>
                                        </select>
                                    </div>--}}

                                    <div class="form-group col-md-6">
                                        <label for="name">Company Name </label>
                                        <input type="text" class="form-control" name="vendor_company_name" id="vendor_company_name" value="{{ $vendor_details->vendor_company_name}}" placeholder="type company name">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Trade License no</label>
                                        <input type="text" class="form-control" name="trade_license_number" id="trade_license_number" value="{{ $vendor_details->trade_license_number}}" placeholder="type trade license no">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Validity</label>
                                        <input type="text" class="form-control" name="validity_of_license" id="validity_of_license" value="{{ $vendor_details->validity_of_license}}" placeholder="type trade license no validity">
                                        <span style="color:red;">(remind your account will be closed with the validity date of your trade license until you
will submit the new issue copy)</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Practical Experiences </label>
                                        <br><br>
                                        <input type="text" class="form-control" name="practical_experiences" id="practical_experiences" value="{{ $vendor_details->practical_experiences}}" placeholder="How long you have practical experiences in this field?">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">When you are available to provide this service? </label>
                                        <select class="form-control" name="ven_service_provide_schedule" id="ven_service_provide_schedule" required>
                                            <option value="">select one</option>
                                            <option value="anytime" {{ $vendor_details->ven_service_provide_schedule == 'anytime' ? 'selected' : '' }}>Anytime</option>
                                            <option value="monthly" {{ $vendor_details->ven_service_provide_schedule == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                            <option value="weekly" {{ $vendor_details->ven_service_provide_schedule == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                            <option value="others" {{ $vendor_details->ven_service_provide_schedule == 'others' ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">What time you are available to provide this service? </label>
                                        <select class="form-control" name="ven_service_provide_time" id="ven_service_provide_time" required>
                                            <option value="">select one</option>
                                            <option value="anytime" {{ $vendor_details->ven_service_provide_time == 'anytime' ? 'selected' : '' }}>Anytime</option>
                                            <option value="morning" {{ $vendor_details->ven_service_provide_time == 'morning' ? 'selected' : '' }}>Morning</option>
                                            <option value="afternoon" {{ $vendor_details->ven_service_provide_time == 'afternoon' ? 'selected' : '' }}>Afternoon</option>
                                            <option value="holidays" {{ $vendor_details->ven_service_provide_time == 'holidays' ? 'selected' : '' }}>Holidays</option>
                                            <option value="only-night" {{ $vendor_details->ven_service_provide_time == 'only-night' ? 'selected' : '' }}>Only night</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Area </label>
                                        <input type="text" class="bksearch" name="bksearch" value="{{ $vendor_details->services_area}}">
                                        <div class="bklist">
                                        </div>
                                        <input type="hidden" name="city">
                                        <input type="hidden" name="area">
                                        <input type="hidden" name="latitude">
                                        <input type="hidden" name="longitude">

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Address </label>
                                        <textarea class="form-control" name="address" id="address" rows="2">
                                            {{ $vendor_details->address}}
                                        </textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Bank Account Number</label>
                                        <input type="text" class="form-control" name="bank_account_number" id="bank_account_number" value="{{ $vendor_details->bank_account_number}}" placeholder="type bank account number">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="name">Write a short note about you maximum 300 </label>
                                        <textarea class="form-control" name="short_bio" id="short_bio" rows="4">
                                        {{ $vendor_details->short_bio}}
                                        </textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="image">Upload your Photo </label>
                                        <input type="file" class="form-control-file" name="vendor_image" id="vendor_image" value="{{$vendor_details->vendor_image}}">
                                        <img src="{{asset('uploads/'.$vendor_details->vendor_image)}}" width="120">
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="image">Upload your national ID card </label>
                                        <input type="file" class="form-control-file" name="vendor_nid" id="vendor_nid" value="{{$vendor_details->vendor_nid}}">
                                        <img src="{{asset('uploads/'.$vendor_details->vendor_nid)}}"  width="120" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="image">Upload trade license copy and incorporation copy </label>
                                        <input type="file" class="form-control-file" name="trade_lic_incorporation_copy[]" multiple id="trade_lic_incorporation_copy"  value="{{$vendor_details->trade_lic_incorporation_copy}}">
                                        @if ($vendor_details->trade_lic_incorporation_copy!='')
                                            @php
                                                $license_copy = json_decode($vendor_details->trade_lic_incorporation_copy);
                                                    //dd($license_copy);
                                            @endphp
                                            @foreach($license_copy as $license_data)
                                                <img src="{{asset('uploads/'.$license_data)}}" alt="" width="100">
                                            @endforeach
                                        @else
                                            <span style="color:red;">(if company is limited company)</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="image">Upload a clear photo</label>
                                        <input type="file" class="form-control-file" name="upload_clear_photo_showroom" id="upload_clear_photo_showroom" value="{{$vendor_details->upload_clear_photo_showroom}}">
                                        <span style="color:red;">You have to upload of your company/showroom/shop/office photo</span>
                                        <img src="{{asset('uploads/'.$vendor_details->upload_clear_photo_showroom)}}" width="120" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="image">Upload the photo of your completed job </label>
                                        <input type="file" class="form-control-file" name="comple_service_photo[]" id="comple_service_photo" multiple value="{{$vendor_details->comple_service_photo}}">
                                        @if ($vendor_details->comple_service_photo !='')
                                            @php
                                                $arr = json_decode($vendor_details->comple_service_photo);
                                            @endphp
                                            @foreach($arr as $data)
                                                <img src="{{asset('uploads/'.$data)}}" alt="" width="100">
                                            @endforeach
                                        @else
                                            <span>You have to upload minimum 5 photos.</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Do you like to show us anything else that we should know? </label>
                                        <input type="text" class="form-control" name="vendor_feedback" id="vendor_feedback" value="{{ $vendor_details->vendor_feedback}}" placeholder="This field will help us to know about you more clearly">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Professional Reference Name </label>
                                        <input type="text" class="form-control" name="professional_ref_name" id="professional_ref_name" value="{{ $vendor_details->professional_ref_name}}" placeholder="Professional Reference Name">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Professional Reference Mobile </label>
                                        <input type="text" class="form-control" name="professional_ref_number" id="professional_ref_number" value="{{ $vendor_details->professional_ref_number}}" placeholder="Professional Reference Mobile">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Personal Reference Name </label>
                                        <input type="text" class="form-control" name="personal_ref_name" id="personal_ref_name" value="{{ $vendor_details->personal_ref_name}}" placeholder="Personal Reference Name">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Personal Reference Mobile </label>
                                        <input type="text" class="form-control" name="personal_ref_mobile" id="personal_ref_mobile" value="{{ $vendor_details->personal_ref_mobile}}" placeholder="Personal Reference Mobile">
                                    </div>

    @endif

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
        <div id="map" style="height: 0px;"></div>
    </section>

@stop
@push('js')
    <script src="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.js?key:MTg3NzpCRE5DQ01JSkgw"></script>
    <script>
        const defaultMarker = [23.7104, 90.40744]
        let map = L.map('map')
        map.setView(defaultMarker, 13)
        // Set up the OSM layer
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18
            }).addTo(map)
        L.marker(defaultMarker).addTo(map)
        Bkoi.onSelect(function () {
            // get selected data from dropdown list
            let selectedPlace = Bkoi.getSelectedData()
            console.log(Bkoi.getSelectedData());
            document.getElementsByName("address")[0].value = selectedPlace.address;
            document.getElementsByName("city")[0].value = selectedPlace.city;
            document.getElementsByName("area")[0].value = selectedPlace.area;
            document.getElementsByName("latitude")[0].value = selectedPlace.latitude;
            document.getElementsByName("longitude")[0].value = selectedPlace.longitude;
            //console.log(selectedPlace.latitude);
            // center of the map
            let center = [selectedPlace.latitude, selectedPlace.longitude]
            // Add marker to the map & bind popup
            map.setView(center, 19)
            L.marker(center).addTo(map).bindPopup(selectedPlace.address)
        })
    </script>

{{--    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>--}}
{{--    <!-- Bootstrap WYSIHTML5 -->--}}
{{--    --}}{{--<script src="{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>--}}
{{--    <script>--}}
{{--        //Initialize Select2 Elements--}}
{{--        $('.select2').select2();--}}
{{--        $('.textarea').wysihtml5({--}}
{{--            toolbar: { fa: true }--}}
{{--        })--}}
{{--    </script>--}}
@endpush
