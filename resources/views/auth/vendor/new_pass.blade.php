<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Password</title>
    <style>
        .header {
            color: #444;
            text-align: center;
        }

        .left-bar {
            border-left: 2px solid #ccc;
        }

        .log-form {
            padding: 20px;
            box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.2);
            background: #ffffff;
        }
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    {{-- toastr js --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"
                style="background: url({{ asset('frontend/img/reg.jpg') }}) no-repeat ;height: 153px;width: 100%">
                <h1 class="header" style="text-align: center;margin-top: 3%">New Password</h1>
                <h6 class="header text-white">Update your Password</h6>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 0px 30px 41px;">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div>
                    <div class="text-center">
                        <img src="{{ asset('frontend/img/forget-pass.png') }}" alt="" style="width: 160px;">
                    </div>
                </div>
                <div class="log-form">
                    <form class="form-horizontal" method="post" role="form"
                        action="{{ route('vendor.new.pass.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="phone_number">New Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                aria-describedby="password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" aria-describedby="password">
                        </div>

                        {{-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div> --}}
                        <br>
                        <button type="submit" class="btn btn-primary"
                            style="background-color: #FF5F3F;width: 100%;border:0px ">Forget Password</button>
                    </form>
                    <div class="text-center pt-5">
                        <p class=" ">Go Back Login page <a class="text-decoration-none"
                                href="{{ route('vendor.login.form') }}">Login</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <footer class="main-footer">

        <!--Footer Bottom-->
        <div class="footer-bottom">
            <div class="inner-container clearfix">
                <p
                    style="background-color: #cdcbcb;padding-top: 2%;padding-bottom: 2%;font-size: 20px;margin: 0px;text-align: center">
                    Copyright © 2020 <a href="#" style="color: white">Door Service.</a> All right reserved</p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error', {
                    closeButton: true,
                    progressBar: true
                });
            @endforeach
        @endif
    </script>
</body>

</html>
