<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vendor Registration</title>
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
                <h1 class="header" style="text-align: center;margin-top: 3%">Vendor Registration</h1>
                <h6 class="header text-white">here you can signup for free</h6>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 20px 30px 16px;">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="text-center">
                    <img src="{{ asset('frontend/img/venor-regis.png') }}" alt=""
                        style="width: 95px; margin-bottom: 5px;">
                </div>
                <div class="log-form">
                    <form class="form-horizontal" role="form" action="{{ route('vendor.registration.store') }}"
                        method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">Choose the account category </label>
                                <select class="form-control" name="account_category" id="account_category" required>
                                    <option value="">select one</option>
                                    <option value="individual">Individual</option>
                                    <option value="company">Company</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="validationServer01">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Your name" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationServerUsername">Mobile</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend3">+88</span>
                                    </div>
                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number"
                                        placeholder="Enter Your mobile number" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationServer02">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter Your email" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="validationServer02">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Enter Your password" required>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1"><a href="#">Terms and
                                        conditions</a></label>
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-primary" type="submit"
                            style="background-color: #FF5F3F;width: 100%;border:0px ">Sign up</button>
                    </form>
                    <div class="text-center pt-3">
                        <p class="">Go back to login page <a class="text-decoration-none"
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
                    Copyright © 2020 <a href="#" style="color: white">Door Enterprise.</a> All right reserved</p>
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
