<nav class="main-header navbar navbar-expand bg-warning navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
{{--        <li class="nav-item d-none d-sm-inline-block">--}}
{{--            <a href="{{route('admin.dashboard')}}" class="nav-link">Dashboard</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item d-none d-sm-inline-block">--}}
{{--            <a href="#" class="nav-link">Profile</a>--}}
{{--        </li>--}}
    </ul>

    <!-- SEARCH FORM -->
{{--    <form class="form-inline ml-3">--}}
{{--        <div class="input-group input-group-sm">--}}
{{--            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
{{--            <div class="input-group-append">--}}
{{--                <button class="btn btn-navbar" type="submit">--}}
{{--                    <i class="fa fa-search"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{asset('backend/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{asset('backend/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{asset('backend/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        @if(Auth::user()->role_id == 2)
            @php
                $notification = \App\Notification::where('from', Auth::id())->latest()->get();
                $notificationUnread = \App\Notification::where('from', Auth::id())->where('is_read',0)->latest()->get();
            @endphp
        <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell-o" style="font-size: 29px;"></i>
                    <span class="badge badge-danger navbar-badge" id="unread_count" style="font-size: 12px;">{{count($notificationUnread)}}</span>
                </a>
                <div id="add_row" class="dropdown-menu dropdown-menu-lg dropdown-menu-right overflow-auto" style="height: 400px; overflow-y: scroll; width: 900px; margin-right: -203%;">
                    <div class="p-2 float-left">All Notifications</div>
                    @if(count($notificationUnread) > 0)
                    <div class="p-2 float-right">
                        <a class="btn btn-default btn-sm"
                           href="{{route('vendor.clearAll.notification', Auth::id())}}">
                            <i class="fa fa-trash"></i> Clear All
                        </a>
                    </div>
                    @endif
                    <div class="dropdown-divider" ></div>
                    <p></p>
                    @forelse($notification as $data)
                        <a href="{{route('vendor.read.notification', $data->id)}}" class="dropdown-item ">
                            <i class="fa  mr-2 {{$data->is_read == 0 ?'text-success fa-bell' : ' fa-bell-o'}}"></i>
                            {{Str::limit($data->message, 15)}}
                            <span class="float-right text-muted text-sm">{{$data->created_at->diffForHumans()}}</span>
                        </a>
                    <div class="dropdown-divider"></div>
                    @empty
                        <h5 id="d-none"  class="text-danger dropdown-item"><i class="fa fa-bell"></i> Notification Not created yet!</h5>
                    @endforelse
                </div>
            </li>
        @endif
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <span style="color:#000;"><b>{{Auth::user()->name}}</b></span>
                    <i class="fa fa-user-circle-o"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">
                    <strong>{{Auth::user()->name}}</strong><br>
                    {{--<small>10,August,2019</small>--}}
                </span>
                @if (Auth::user()->role_id =='2')

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('vendor.update.profile',Auth::user()->id)}}">
                        <i class="fa fa-edit"></i> Update Profile
                    </a>
                    <a href="{{route('vendor.switch.to.user')}}" class="dropdown-item" >
                        <i class="fa fa-key mr-2"></i> Switch to user
                    </a>


                @endif


                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out mr-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i--}}
{{--                    class="fa fa-th-large"></i></a>--}}
{{--        </li>--}}
    </ul>
</nav>
