@if (Auth::check() && Auth::user()->role_id == 2)
    <aside class="main-sidebar sidebar-dark-primary elevation-4"
        style=" background: rgb(0,0,0);
background: linear-gradient(135deg, rgba(0,0,0,1) 0%, rgba(68,23,2,1) 100%); ">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            {{-- <img src=" --}}{{-- {{asset('backend/dist/img/careforce.jpg')}} --}}{{-- " alt="Door-Enterprise" class="brand-image  elevation-3"
                 style="opacity: .8;width: 80%;background-color: whitesmoke"> --}}
            <h3 class="text-center font-weight-bold"><a class="text-center" href="{{ route('vendor.request_order_list') }}"
                    style="color: #c2c7d0;">Door Service</a></h3>
            {{-- <h3 class="brand-text font-weight-light" style="font-size: 30px ;margin-left: 10%">Door-Enterprise</h3> --}}
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('uploads/profile/' . Auth::user()->image) }}" class="img-circle elevation-2"
                        alt="img">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ strtoupper(Auth::user()->name) }}</a>
                </div>
            </div>

            @if (Auth::check())
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('vendor.dashboard') }}"
                                class="nav-link {{ Request::is('vendor/dashboard*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vendor.update.profile', Auth::id()) }}"
                                class="nav-link {{ Request::is('vendor/update-profile/*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-user-plus"></i>
                                <p>
                                    Profile & Service
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview {{ Request::is('vendor/request/order*') ? 'menu-open' : '' }}"
                            style="background: rgba(0, 0, 0, 0.4);">

                            <a href="#" class="nav-link">
                                <i
                                    class="nav-icon fa fa fa-bell-o {{ Request::is('vendor/request/order*') ? 'text-warning' : '' }}"></i>
                                <p>
                                    Requests
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('vendor.request_order_list') }}"
                                        class="nav-link {{ Request::is('vendor/request/order*') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>New</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item"> --}}
                                {{-- <a href="" class="nav-link {{Request::is('admin/services_image*') ? 'active' :''}}"> --}}
                                {{-- <i class="fa fa-circle-o nav-icon"></i> --}}
                                {{-- <p>Quoted</p> --}}
                                {{-- </a> --}}
                                {{-- </li> --}}
                            </ul>
                        </li>
                        {{-- <li class="nav-item has-treeview {{(Request::is('admin/service*')) ? 'menu-open' : ''}}" style="background: rgba(0, 0, 0, 0.4);"> --}}
                        {{-- <a href="#" class="nav-link"> --}}
                        {{-- <i class="nav-icon fa fa fa-user"></i> --}}
                        {{-- <p> --}}
                        {{-- Individual Profile --}}
                        {{-- <i class="right fa fa-angle-left"></i> --}}
                        {{-- </p> --}}
                        {{-- </a> --}}
                        {{-- <ul class="nav nav-treeview"> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a  href="" class="nav-link {{Request::is('admin/services*') ? 'active' :''}}"> --}}
                        {{-- <i class="fa fa-circle-o nav-icon"></i> --}}
                        {{-- <p>Jobs Done</p> --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a href="" class="nav-link {{Request::is('admin/services_image*') ? 'active' :''}}"> --}}
                        {{-- <i class="fa fa-circle-o nav-icon"></i> --}}
                        {{-- <p>Ratings</p> --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                        @php
                            $new_review = \App\Review::where('vendor_user_id', \Illuminate\Support\Facades\Auth::user()->id)
                                ->where('viewed', 0)
                                ->count();
                        @endphp
                        <li class="nav-item">
                            <a href="{{ route('vendor.customer.review') }}"
                                class="nav-link {{ Request::is('vendor/customer/review') ? 'active' : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>
                                    Customer Reviews
                                    @if (!empty($new_review))
                                        <span class="badge badge-danger">{{ $new_review }} New</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item"> --}}
                        {{-- <a href="{{ route('vendor.money.withdraw') }}" class="nav-link {{Request::is('vendor/money*') ? 'active' : ''}}"> --}}
                        {{-- <i class="fa fa-circle-o nav-icon"></i> --}}
                        {{-- <p> --}}
                        {{-- Money Withdraw --}}
                        {{-- </p> --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('vendor.withdraw.request') }}"
                                class="nav-link {{ Request::is('vendor/withdraw/request*') ? 'active' : '' }}">
                                <i
                                    class="fa fa-{{ Request::is('admin/vendors/withdraw/request*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                                <p>Money Withdraw Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vendor.payment.history') }}"
                                class="nav-link {{ Request::is('vendor/payment/history') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-bank"></i>
                                <p>Payment History</p>
                            </a>
                        </li>

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
