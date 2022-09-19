@extends('backend.layouts.master')
@section("title","Invoice")
@push('css')
    <div id="printArea">
        <style>

            .table {
                border:  solid 3px black;

            }
            .custom-control{
                font-size: 1rem;
                font-weight: 400!important;
                line-height: 1.5;
                color: #212529;
                margin-left: -30px;

            }
            .customCheck
            {
                font-weight: 400!important;

            }
            .rcorners2 {
                border-radius: 25px;
                background-color: white;
                border: 2px solid #ffffff;
                padding: 2px;

            }
            .address {
                border-radius: 25px;
                background-color: white;
                border: 2px solid #ffffff;
                padding: 2px;
                /*margin: 10px;*/

            }
            table {
                border-radius: 15px;
                border-collapse: collapse;

            }

            table, td, th {

                border: 2px solid orangered;
                border-color: orangered;
            }
            table, td {

                background-color: white;
            }
            @media print {
                .second-page {page-break-before: always;}
            }

        </style>
    @endpush
    @section('content')
        <!-- Content Header (Page header) -->

            <section class="content" style="background-color:paleturquoise">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{asset('frontend/img/inv-logo.png')}}" style="height: 160px;width: 160px;background-color: lightpink" alt="">
                            </div>
                            <div class="col-md-4" style="text-align: center;color: orangered">
                                <h2>Service Hero</h2>
                                <h2>REGISTRATION FORM</h2>
                                <i class="{{$vendorData->account_category == 'company'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="color: black">Company</label>
                                <i class="{{$vendorData->account_category == 'individual'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="color: black">Individual</label>
                                <i class="{{$vendorData->account_category == 'freelancer'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="color: black">Freelancer</label>
                            </div>
                            <div class="col-md-4" style="">
                                <div class="row" style="background-color: lightpink;height: 160px;width: 475px ">
                                    <div class="attachphoto col-md-5" >
                                        <p style="text-align: center;margin-top: 50px">hero No: {{$vendorData->id}} </p>
                                    </div>
                                    <div class="attachphoto col-md-5" style="border: 2px solid deeppink;height: 160px;width: 250px;background-color: white" >
                                        {{--<p  style="text-align: center;margin-top: 50px;">Attach Passport size photo</p>--}}
                                        <img src="{{asset('uploads/profile/'.$vendorUserData->image)}}" alt="" style="width: 100%;">
                                    </div>
                                    <div class="attachphoto col-md-2" >
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6" ><p>Reg:No: {{$vendorData->id}}</p></div>
                                <div class="col-md-4" style="margin-left: 67px">Joining Date: {{date('jS F Y ',strtotime($vendorData->created_at))}}</div>
                            </div>
                        </div>

                        <div class="col-md-12" style="width: 1150px">
                            <p class="rcorners2"> <span>Full Name: {{$vendorUserData->name}}</span></p>
                            <p class="rcorners2"> <span>E-mail: {{$vendorUserData->email}}</span> <span style="margin-left: 450px">Mobile No: {{$vendorUserData->mobile_number}}</span></p>
                            <p class="rcorners2"> <span>Trade License No: {{$vendorData->trade_license_number}}</span> <span style="margin-left: 370px">Validity Till: {{$vendorData->validity_of_license}}</span></p>
                            <p class="rcorners2"> <span>NId No: 00000000000</span></p>
                            <div class="round2" style="  border: 3px solid orangered;border-radius: 8px;">
                                <div class="row">
                                    <div class="col-5" style="margin-left: 25px;">
                                        <p style="text-align: center"> <b>Present Address</b></p>
                                        <p class="address" style="min-height: 100px; padding: 10px;">{{$vendorData->address}} </p>
                                        {{--<p class="address"> <span>Block/Sector: </span> <span style="margin-left: 145px">Thana:</span></p>
                                        <p class="address"> <span>District: </span> <span style="margin-left: 191px">Post Code:</span></p>--}}
                                    </div>
                                    <div class="col-1" style="border-left: 3px solid orangered; margin-left: 50px;"></div>
                                    <div class="col-5" style="margin-left: -35px;">
                                        <p style="text-align: center"><b>Permanent Address</b></p>
                                        <p class="address" style="min-height: 100px; padding: 10px;">{{$vendorData->address}} </p>
                                    </div>
                                </div>

                            </div>
                            <div class="round2" style="  border: 3px solid orangered;border-radius: 8px;margin-top: 10px">
                                <div class="row">
                                    <div class="col-12" style="padding: 0 30px;">
                                        <p style="text-align: center"><b>Business Address</b> </p>
                                        <p class="address"> <span>House/Holding No: </span> <span style="margin-left: 295px">Road/Word No:</span> <span style="margin-left: 200px">Block/Sector:</span></p>
                                        <p class="address"><span >Post Code:</span> <span style="margin-left: 361px">District: </span> <span style="margin-left: 263px">Post Code:</span></p>
                                    </div>
                                </div>

                            </div>
                            <div class="round2" style="  border: 3px solid orangered;border-radius: 8px;margin-top: 10px">

                                <div class="col-12" >
                                    <h5 style="text-align: center;color: orangered">What Type Of Service You Like To Provide:(Please Put A Tick Mark) </h5>
                                    <div class="row">
                                        @foreach($vendorService as $vsData)
                                        <div class="text-center" style="margin: 5px;">
                                            <i class="fa fa-check-square"></i> <label class="customCheck" style="background-color: white;color: black;border-radius: 15px;border:2px solid orangered;padding: 0px 5px">{{$vsData->service->service_name}}</label>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>
                            <i class="fa fa-check-square"></i> <span>Service you can provide:(Select Service  the category you have selected.You can Choose maximum 10 Service at a time)</span>

                            <table class="table col-12">
                                <tr>
                                    <th scope="col" style="background-color: orangered">Service Name</th>
                                    <th scope="col" style="background-color: orangered">Service Charge</th>
                                    <th scope="col" style="background-color: orangered">Reservice Guarantee</th>
                                    <th scope="col" style="background-color: orangered"> Remark</th>
                                </tr>
                                @foreach($vendorService as $vsData)
                                <tr>
                                    <td width="25%">{{$vsData->service->service_name}}</td>
                                    <td>{{$vsData->service->service_price}}</td>
                                    <td>Yes</td>
                                    <td>N/A</td>
                                </tr>
                                @endforeach
                            </table>
                            <div class="round2" style="  border: 3px solid orangered;border-radius: 8px;margin-top: 10px">
                                <p style="text-align: center"><b>Write Your Service Area</b> </p>
                                <div class="row">
                                    <div class="col-4" style="padding: 0 30px;">
                                        <p class="address" style="text-align: center"> <span >Area 1: {{$vendorData->services_area}}</span></p>

                                    </div>
                                    <div class="col-4">
                                        <p class="address" style="text-align: center"> <span>Area 2: None</span></p>
                                    </div>
                                    <div class="col-4" style="padding: 0 30px 0;">
                                        <p class="address" style="text-align: center"> <span>Area 3: None</span></p>

                                    </div>
                                    <div class="col-6" style="padding: 0 30px;">
                                        <p class="address" style="text-align: center"> <span >Area 4: None</span></p>

                                    </div>
                                    <div class="col-6" style="padding: 0 30px 0;">
                                        <p class="address" style="text-align: center"> <span>Area 5: None</span></p>
                                    </div>

                                </div>

                            </div>
                            <div class="col-12" >
                                <div class="row">
                                    <div class="col-7" style="margin: 5px;">
                                        <label class="customCheck" style="background-color: orangered;    width: 589px;color: #ffffff;border-radius: 15px;border:2px solid orangered;padding: 2px 5px">How long you have practical experience in this field</label>
                                    </div>
                                    <div  class="col-4" style="margin: 5px">
                                        <label class="customCheck" style="background-color: white;color: black;border-radius: 15px;border:2px solid orangered;padding: 2px 5px;width: 204px;text-align: right">{{$vendorData->practical_experiences}} Year(s)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="" style="margin: 5px 12px;">
                                        <label class="customCheck" style="background-color: orangered;color: #ffffff;border-radius: 15px;border:2px solid orangered;padding: 2px 5px">When you are available to provide this service</label>
                                    </div>
                                    <div style="margin: 5px 20px">
                                        <i class="{{$vendorData->ven_service_provide_schedule == 'anytime'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="width:120px;background-color: white;color: black;border-radius: 15px;border:2px solid orangered;padding: 0px 5px;text-align: center">Anytime</label>
                                    </div>
                                    <div style="margin: 5px">
                                        <i class="{{$vendorData->ven_service_provide_schedule == 'monthly'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="width:120px;background-color: white;color: black;border-radius: 15px;border:2px solid orangered;padding: 0px 5px;text-align: center">Monthly</label>
                                    </div>
                                    <div style="margin: 5px">
                                        <i class="{{$vendorData->ven_service_provide_schedule == 'weekly'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="width:120px;background-color: white;color: black;border-radius: 15px;border:2px solid orangered;padding: 0px 5px;text-align: center">Weekly</label>
                                    </div>
                                    <div style="margin: 5px">
                                        <i class="{{$vendorData->ven_service_provide_schedule == 'others'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="background-color: white;width:200px;color: black;border-radius: 15px;border:2px solid orangered;padding: 0px 5px;text-align: center">Others</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="" style="margin: 5px 12px;">
                                        <label class="customCheck" style="background-color: orangered;color: #ffffff;border-radius: 15px;border:2px solid orangered;padding: 2px 5px">What time you are available to provide this service</label>
                                    </div>
                                    <div style="margin: 5px 20px">
                                        <i class="{{$vendorData->ven_service_provide_time == 'anytime'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="background-color: white;color: black;border-radius: 15px;border:2px solid orangered;padding: 0px 5px;text-align: center">anytime</label>
                                    </div>
                                    <div style="margin: 5px">
                                        <i class="{{$vendorData->ven_service_provide_time == 'morning'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="width:100px;background-color: white;color: black;border-radius: 15px;border:2px solid orangered;padding: 0px 5px;text-align: center">morning</label>
                                    </div>
                                    <div style="margin: 5px">
                                        <i class="{{$vendorData->ven_service_provide_time == 'afternoon'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="width:100px;background-color: white;color: black;border-radius: 15px;border:2px solid orangered;padding: 0px 5px;text-align: center">afternoon</label>
                                    </div>
                                    <div style="margin: 5px">
                                        <i class="{{$vendorData->ven_service_provide_time == 'holidays'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="background-color: white;width:100px;color: black;border-radius: 15px;border:2px solid orangered;padding: 0px 5px;text-align: center">holidays</label>
                                    </div>
                                    <div style="margin: 5px">
                                        <i class="{{$vendorData->ven_service_provide_time == 'only night'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="background-color: white;width:110px;color: black;border-radius: 15px;border:2px solid orangered;padding: 0px 5px;text-align: center">only night</label>
                                    </div>
                                </div>

                            </div>
                            <div class="round2 second-page" style="  border: 3px solid orangered;border-radius: 8px;margin-top: 10px">
                                <div class="row">
                                    <div class="col-12" style="padding: 0 30px;">
                                        <h5 style="text-align: center"><b>Please Provide Your Bank Account</b> </h5>
                                        <p style="text-align: center">If Company provide Must Provide Company Account </p>
                                        <p class="address"> <span>Account Name: </span> <span style="margin-left: 340px">Bank Name: xxxxxxxxx xxxxxxx</span> </p>
                                        <p class="address"><span >Account No: {{$vendorData->bank_account_number}}</span>  <span style="margin-left: 363px">Branch Name: xxxxxxxxxxx</span></p>
                                    </div>
                                </div>

                            </div>

                            <div class="round2" style="  border: 3px solid orangered;border-radius: 8px; margin-top: 20px;">
                                <div class="row">
                                    <div class="col-5" style="margin-left: 25px;">
                                        <p style="text-align: center"> <b>Reference 1</b></p>
                                        <p class="address"> <span>Name: {{$vendorData->professional_ref_name}}</span> </p>
                                        <p class="address"> <span>Address: xxxxxxxxxxx</span></p>
                                        <p class="address"> <span>Mobile: {{$vendorData->professional_ref_number}}</span> </p>
                                    </div>
                                    <div class="col-1" style="border-left: 3px solid orangered; margin-left: 50px;"></div>
                                    <div class="col-5" style="margin-left: -35px;">
                                        <p style="text-align: center"><b>Reference 2</b></p>
                                        <p class="address" style="width: 100%"> <span>Name: {{$vendorData->personal_ref_name}}</span> </p>
                                        <p class="address" style="width: 100%"> <span>Address: xxxxxxxxxx</span> </p>
                                        <p class="address" style="width: 100%"> <span>Mobile: {{$vendorData->personal_ref_mobile}}</span> </p>
                                    </div>
                                </div>

                            </div>
                            <div class="round2" >
                                <div class="row">
                                    <div class="col-12" >
                                        <p class="address" style="width: 100%;height: 100px;text-align: center;margin-top: 20px"> <strong>Write a short note about you </strong><br>
                                            {{$vendorData->short_bio}}
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <p> Please Attached</p>
                                <i class="fa fa-square" style="color: orangered"></i><span>Two Copies of your passport size photo</span>  <i class="fa fa-square" style="color: orangered"></i><span>Company Profile</span>
                                <i class="fa fa-square" style="color: orangered"></i><span>A copy of your trade license</span>  <i class="fa fa-square" style="color: orangered"></i><span>A copy of National ID card</span> <i class="fa fa-square" style="color: orangered"></i><span>A copy of complete resume</span> <i class="fa fa-square" style="color: orangered"></i><span>Do you like to show us anything else that we should know</span> <i class="fa fa-square" style="color: orangered"></i><span>Please mention two of your reference by whome we can varified your information.1.Professional Reference.2. Personal Reference</span>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px">
                                <div class="row">
                                    <div class="col-md-6">
                                        <hr style=" width: 137px;margin-left: -20px;">
                                        <p style="color: orangered"> Signature</p>
                                    </div>
                                    <div class="col-md-6">
                                        <hr style=" width: 137px;margin-left: 375px">
                                        <p style="color: orangered;margin-left: 400px"> Signature</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3" style="margin-left: -30px">
                                        <img src="{{asset('frontend/img/inv-logo.png')}}" style="width: 116px;background-color: lightpink" alt="">
                                    </div>
                                    <div class="col-md-4" style="text-align: center;color: orangered">
                                        <h5>Service Hero</h5>
                                        <h5>REGISTRATION FORM</h5>
                                        <i class="{{$vendorData->account_category == 'company'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="color: black">Company</label>
                                        <i class="{{$vendorData->account_category == 'individual'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="color: black">Individul</label>
                                        <i class="{{$vendorData->account_category == 'freelancer'? 'fa fa-check-square' : 'fa fa-square-o' }}"></i> <label class="customCheck" style="color: black">Freelancer</label>
                                    </div>
                                    <div class="col-md-4" style="margin-left: 18px; ">
                                        <div class="row" style="background-color: lightpink;height: 110px;width: 475px ">
                                            <div class="attachphoto col-md-5" >
                                                <p style="text-align: center;margin-top: 50px">hero No {{$vendorData->id}}</p>
                                            </div>
                                            <div class="attachphoto col-md-3" style="background-color: white" >
                                                <img src="{{asset('uploads/profile/'.$vendorUserData->image)}}" style="width: 107px; height: 108px; background-color: lightpink" alt="">
                                            </div>
                                            <div class="attachphoto col-md-2" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="round2" >
                                <div class="row">
                                    <div class="col-12" >
                                        <p style="text-align: left">hero no: {{$vendorData->id}}</p>
                                        <p class="address"> <span>Name: {{$vendorUserData->name}}</span> </p>
                                        <p class="address"> <span>Present Address: {{$vendorData->address}}</span></p>
                                        <p class="address"> <span>Service Type: {{$vendorData->account_category}}</span> <span style="margin-left: 400px">Joining Date: {{date('jS F Y ',strtotime($vendorData->created_at))}}</span></p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12" style="margin-top: 20px">
                                <div class="row">
                                    <div class="col-md-6">
                                        <hr style=" width: 137px;margin-left: -20px;">
                                        <p style="color: orangered"> Signature</p>
                                    </div>
                                    <div class="col-md-6">
                                        <hr style=" width: 137px;margin-left: 375px">
                                        <p style="color: orangered;margin-left: 400px"> Signature</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <div class="text-center" id="print" style="margin: 20px">
                            <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/>
                        </div>

                    </div>
                </div>
                <!-- /.invoice -->


            </section>
            <!-- /.content -->
        @stop
        @push('js')
            <script type="text/javascript">
                function printDiv() {
                    var divName = "printArea";
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    // document.body.style.marginTop="-45px";
                    window.print();
                    document.body.innerHTML = originalContents;
                }
            </script>
@endpush
