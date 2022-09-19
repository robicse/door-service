@if (Auth::check() && Auth::user()->role_id == 1)
    <aside class="main-sidebar sidebar-dark-primary elevation-4"
        style="background: linear-gradient(0deg, #2f0307 0%, rgb(0, 0, 0) 100%);">
        <!-- Brand Logo -->
        <a href="#" class="brand-link text-center">
            {{-- <img src=" --}}{{-- {{asset('backend/dist/img/careforce.jpg')}} --}}{{-- " alt="Door-Enterprise" class="brand-image  elevation-3"
                 style="opacity: .8;width: 80%;background-color: whitesmoke"> --}}
            <h3 class="text-center -weight-bold"><a class="text-center" href="{{ route('admin.order.list') }}"
                    style="color: #c2c7d0;">DoorService</a></h3>

        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            @if (Auth::check())
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview {{ Request::is('admin/service*') ? 'menu-open' : '' }}"
                            style="">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa fa-rss-square"></i>
                                <p>
                                    Service Management
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.services-category.index') }}"
                                        class="nav-link {{ Request::is('admin/services-category*') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Service Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.services-sub-category.index') }}"
                                        class="nav-link {{ Request::is('admin/services-sub-category*') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Service Sub Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.services-manage.index') }}"
                                        class="nav-link {{ Request::is('admin/services-manage*') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Service Manage</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.services-question.index') }}" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Service Questions</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{ Request::is('admin/order*') ? 'menu-open' : '' }}"
                            style="">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-first-order"></i>
                                <p>
                                    Order Management
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.order.list.accepted') }}"
                                        class="nav-link {{ Request::is('admin/order/list/accepted') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Accepted Order</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.order.list.pending') }}"
                                        class="nav-link {{ Request::is('admin/order/list/pending') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Pending Order</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.order.list.onreview') }}"
                                        class="nav-link {{ Request::is('admin/order/list/onreview') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>On Review Order</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.order.list.complete') }}"
                                        class="nav-link {{ Request::is('admin/order/list/complete') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Complete Order</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.order.list.cancel') }}"
                                        class="nav-link {{ Request::is('admin/order/list/cancel') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Cancel Order</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item has-treeview {{((Request::is('admin/order*')) ? 'menu-open' : '')}}" style=""> --}}
                        {{-- <a href="{{route('admin.order.list')}}" class="nav-link"> --}}
                        {{-- <i class="nav-icon fa fa-first-order {{((Request::is('admin/order*')) ? 'text-warning' : '')}}"></i> --}}
                        {{-- <p> --}}
                        {{-- Order Management --}}
                        {{-- </p> --}}
                        {{-- </a> --}}
                        {{-- <ul class="nav nav-treeview"> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a  href="{{route('admin.order.list')}}" class="nav-link {{(Request::is('admin/order/list*') ? 'active' :'')}}"> --}}
                        {{-- <i class="fa fa-circle-o nav-icon"></i> --}}
                        {{-- <p> Quotation Orders</p> --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a  href="{{route('admin.order.list')}}" class="nav-link {{(Request::is('') ? 'active' :'')}}"> --}}
                        {{-- <i class="fa fa-circle-o nav-icon"></i> --}}
                        {{-- <p> Direct Orders</p> --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                        {{-- </ul> --}}
                        {{-- </li> --}}
                        <li class="nav-item has-treeview {{ Request::is('admin/vendor*') ? 'menu-open' : '' }}"
                            style="">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa fa-users"></i>
                                <p>
                                    Vendor
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.vendorList') }}"
                                        class="nav-link {{ Request::is('admin/vendorList*') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p> Vendor List</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                <a  href="{{ route('admin.vendorStatusActive') }}" class="nav-link {{ Request::is('admin/vendorStatusActive*') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Active Vendor List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.vendorStatusInActive') }}" class="nav-link {{ Request::is('admin/vendorStatusInActive*') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    @php
                                        $vendorUsers = \App\VendorDetails::where('status', 0)->get();
                                    @endphp
                                <p>Inactive Vendor</p>
                                <span class="badge ">({{ $vendorUsers->count() }})</span>
                                </a>
                            </li> -->
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.coupon.index') }}"
                                class="nav-link {{ Request::is('admin/coupon*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-shopping-bag"></i>
                                <p>Coupon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.commission') }}"
                                class="nav-link {{ Request::is('admin/commission*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-money"></i>
                                <p>Commission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.payment-history.index') }}"
                                class="nav-link {{ Request::is('admin/payment-history*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-bank"></i>
                                <p>Payment History</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.vendor.withdraw.request') }}"
                                class="nav-link {{ Request::is('admin/vendors/withdraw/request*') ? 'active' : '' }}">
                                <i
                                    class="fa fa-{{ Request::is('admin/vendors/withdraw/request*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                                <p>Vendor Withdraw Requests</p>
                            </a>
                        </li>
                        @php
                            $reviews = \App\Review::where('viewed', 0)->count();
                        @endphp
                        <li class="nav-item">
                            <a href="{{ route('admin.vendor-review.index') }}"
                                class="nav-link {{ Request::is('admin/vendor-review*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-bank"></i>
                                <p>
                                    Customer Review
                                    @if (!empty($reviews))
                                        <span class="badge badge-danger">{{ $reviews }} New</span>
                                    @endif
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.userList') }}"
                                class="nav-link {{ Request::is('admin/userList*') ? 'active' : '' }}">

                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    User List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.setting') }}"
                                class="nav-link {{ Request::is('admin/settings*') ? 'active' : '' }}">

                                <i class="nav-icon fa fa-gears"></i>
                                <p>
                                    Settings
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pages.index') }}"
                                class="nav-link {{ Request::is('admin/pages*') ? 'active' : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>
                                    Pages Settings
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.slider.index') }}"
                                class="nav-link {{ Request::is('admin/slider*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-building-o"></i>
                                <p>
                                    Sliders
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blog.index') }}"
                                class="nav-link {{ Request::is('admin/blog*') ? 'active' : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>
                                    Blog
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.career.index') }}"
                                class="nav-link {{ Request::is('admin/career*') ? 'active' : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>
                                    Career
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">

                            <a href="{{route('admin.dashboard')}}" class="nav-link">

                                <i class="nav-icon fa fa-map-marker"></i>
                                <p>
                                    Area
                                </p>
                            </a>
                        </li> --}}

                        {{-- <li class="nav-item has-treeview {{(Request::is('admin/blog*')) ? 'menu-open' : ''}}" style=""> --}}
                        {{-- <a href="#" class="nav-link"> --}}
                        {{-- <i class="nav-icon fa fa fa-rss-square"></i> --}}
                        {{-- <p> --}}
                        {{-- Blog Management --}}
                        {{-- <i class="right fa fa-angle-left"></i> --}}
                        {{-- </p> --}}
                        {{-- </a> --}}
                        {{-- <ul class="nav nav-treeview"> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a href="{{route('admin.blog-category.index')}}" class="nav-link {{Request::is('admin/blog-category*') ? 'active' :''}}"> --}}
                        {{-- <i class="fa fa-circle-o nav-icon"></i> --}}
                        {{-- <p>Categories</p> --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a href="{{route('admin.blog.index')}}" class="nav-link {{Request::is('admin/blog*') ? 'active' :''}}"> --}}
                        {{-- <i class="fa fa-circle-o nav-icon"></i> --}}
                        {{-- <p>Blog</p> --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                    </ul>
                    </li>


                    {{-- <ul class="nav nav-treeview"> --}}
                    {{-- <li class="nav-item"> --}}
                    {{-- <a href="{{route('admin.slider.index')}}" class="nav-link {{Request::is('admin/slider') ? 'active' :''}}"> --}}
                    {{-- <i class="fa fa-circle-o nav-icon"></i> --}}
                    {{-- <p>List</p> --}}
                    {{-- </a> --}}
                    {{-- </li> --}}
                    {{-- </ul> --}}

                    {{-- <li class="nav-item has-treeview {{(Request::is('admin/client*')) ? 'menu-open' : ''}}" style="">
                            <a href="{{route('admin.client.index')}}" class="nav-link">
                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                <p>
                                    Client
                                    <i class="right fas fa-blog"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview {{(Request::is('admin/staff*')) ? 'menu-open' : ''}}" style="">
                            <a href="{{route('admin.staff.index')}}" class="nav-link">
                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                <p>
                                    Staff
                                    <i class="right fas fa-blog"></i>
                                </p>
                            </a>
                        </li> --}}
                    {{-- <li class="nav-item has-treeview {{(Request::is('admin/certification*')) ? 'menu-open' : ''}}" style="">
                            <a href="{{route('admin.certification.index')}}" class="nav-link">
                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                <p>
                                    Certification
                                    <i class="right fas fa-blog"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview {{(Request::is('admin/training*')) ? 'menu-open' : ''}}" style="">
                            <a href="{{route('admin.training.index')}}" class="nav-link">
                                <i class="fa fa-train" aria-hidden="true"></i>
                                <p>
                                    Training
                                    <i class="right fas fa-blog"></i>
                                </p>
                            </a>
                        </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            @endif
        </div>
        <!-- /.sidebar -->
    </aside>
@else
    <h2 class="text-danger text-center m-5">Your don't have permission to access here.</h2>
@endif
