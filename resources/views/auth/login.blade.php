<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themesdesign.in/drixo/vertical/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Nov 2018 08:39:22 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>ISP</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="ThemeDesign" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="{{url('public/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('public/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('public/css/style.css')}}" rel="stylesheet" type="text/css">
</head>

<body class="fixed-left">
<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>
<!-- Begin page -->
<div class="accountbg">
    <div class="content-center">
        <div class="content-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                {{--<h3 class="text-center mt-0 m-b-15"><a href="index-2.html" class="logo logo-admin"><img src="{{url('public/images/logo-dark.png')}}" height="30" alt="logo"></a></h3>--}}
                                <h4 class="text-muted text-center font-18"><b>Sign In</b></h4>
                                <div class="p-2">
                                    <form class="form-horizontal m-t-20" action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
																<strong>{{ $errors->first('password') }}</strong>
															</span>
                                                    @endif
                                                    <label class="custom-control-label" for="customCheck1">Remember me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </div>
                                        <div class="form-group m-t-10 mb-0 row">
                                            <div class="col-sm-7 m-t-20"><a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a></div>
                                            <div class="col-sm-5 m-t-20"><a href="pages-register.html" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div>
<!-- jQuery  -->
<script src="{{url('public/js/jquery.min.js')}}"></script>
<script src="{{url('public/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('public/js/modernizr.min.js')}}"></script>
<script src="{{url('public/js/detect.js')}}"></script>
<script src="{{url('public/js/fastclick.js')}}"></script>
<script src="{{url('public/js/jquery.slimscroll.js')}}"></script>
<script src="{{url('public/js/jquery.blockUI.js')}}"></script>
<script src="{{url('public/js/waves.js')}}"></script>
<script src="{{url('public/js/jquery.nicescroll.js')}}"></script>
<script src="{{url('public/js/jquery.scrollTo.min.js')}}"></script>
<!-- App js -->
<script src="{{url('public/js/app.js')}}"></script>
</body>
<!-- Mirrored from themesdesign.in/drixo/vertical/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Nov 2018 08:39:22 GMT -->

</html>