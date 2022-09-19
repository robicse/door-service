@extends('frontend.layouts.master')
@section('title', 'Vendor Register')
@section('content')
    <div class="c-layout-page">
        <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
        <div class="c-layout-breadcrumbs-1 c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
            <div class="container">
                <div class="c-page-title c-pull-left">
                    <h3 class="c-font-uppercase c-font-sbold">Vendor Register</h3>
                    <h4 class="">Any new Vendor can register from here</h4>
                </div>
                <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
                    <li><a href="{{'login'}}">Login</a></li>
                    <li>/</li>
                    <li class="c-state_active">Vendor Register</li>

                </ul>
            </div>
        </div><!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
        <!-- BEGIN: PAGE CONTENT -->
        <!-- BEGIN: CONTENT/SHOPS/SHOP-LOGIN-REGISTER-1 -->
        <div class="c-content-box c-size-md c-bg-white">
            <div class="container">
                <div class="c-shop-login-register-1">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="panel panel-default c-panel">
                                <div class="panel-body c-panel-body">
                                    <div class="c-content-title-1">
                                        <h3 class="c-left"><i class="icon-user"></i> Vendor Registration</h3>
                                    </div>

                                    <form class="c-form-register" action="{{route('user.reg.store')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label">Full Name</label>
                                                    <input type="text"  name="name" class="form-control c-square c-theme" placeholder="First Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="control-label">Email Address</label>
                                                <input type="email" name="email" class="form-control c-square c-theme" placeholder="Email Address">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="control-label">Phone</label>
                                                <input type="tel" name="mobile_number" class="form-control c-square c-theme" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Account Password</label>
                                            <input type="password" name="password" class="form-control c-square c-theme" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control c-square c-theme" placeholder="Password">
                                        </div>
                                        <div class="form-group c-margin-t-40">
                                            <button type="submit" class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: CONTENT/SHOPS/SHOP-LOGIN-REGISTER-1 -->

        <!-- END: PAGE CONTENT -->
    </div>
@endsection
