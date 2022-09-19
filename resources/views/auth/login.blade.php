
@section('title', 'Login Register')
@section('content')

    <div class="page-area">
        <div class="breadcumb-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcrumb text-center">
                        <div class="section-headline white-headline text-center">
                            <h3>Login</h3>
                        </div>
                        <ul>
                            <li class="home-bread">Home</li>
                            <li>Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="login-area area-padding">
            <div class="container">
                <div class="row" style="margin-right:15%">
                    <div class="col-md-10 col-md-offset-2 col-sm-12 col-xs-12">

                                <h4 class="login-title text-center">LOG IN</h4>
                                <div class="row" >
                                    <form class="c-form-login" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group has-feedback">
                                            <input type="text" name="email" class="form-control c-square c-theme input-lg" placeholder="Enter your Email">
                                            <span class="glyphicon glyphicon-user form-control-feedback c-font-grey"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <input type="password" name="password" class="form-control c-square c-theme input-lg" placeholder="Password">
                                            <span class="glyphicon glyphicon-lock form-control-feedback c-font-grey"></span>
                                        </div>
                                        <div class="row c-margin-t-40">
                                            <div class="col-xs-8">
                                                <div class="c-checkbox">
                                                    <input type="checkbox" id="checkbox1-77" class="c-check">
                                                    <label for="checkbox1-77"> <span class="inc"></span>
                                                        <span class="check"></span> <span class="box"></span> Remember me
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <button type="submit" class="slide-btn login-btn">Login</button>
                                            </div>
                                        </div>
                                        <div>
{{--                                            <p>Don't Have An Account Yet ? <a class="text-info" href="{{route('user.reg.form')}}">Register</a></p>--}}
                                        </div>
                                    </form>
                                </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
