<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.designbudy.com/rayan/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Nov 2018 10:44:35 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Page | ISP</title>
    <link rel="shortcut icon" href="img/favicon.ico">
    <!--STYLESHEET-->
    <!--=================================================-->
    <!--Roboto Slab Font [ OPTIONAL ] -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:300,400,700" rel="stylesheet">
    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{url('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--Jasmine Stylesheet [ REQUIRED ]-->
    <link href="{{url('public/css/style.css')}}" rel="stylesheet">
    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{url('public/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!--Switchery [ OPTIONAL ]-->
    <link href="{{url('public/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="{{url('public/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{url('public/css/demo/jasmine.css')}}" rel="stylesheet">
    <!--SCRIPT-->
    <!--=================================================-->
    <!--Page Load Progress Bar [ OPTIONAL ]-->
    <link href="{{url('public/plugins/pace/pace.min.css')}}" rel="stylesheet">
    <script src="{{url('public/plugins/pace/pace.min.js')}}"></script>
</head>
<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
<div id="container" class="cls-container">
    <!-- LOGIN FORM -->
    <!--===================================================-->
    <div class="lock-wrapper">
        <div class="panel lock-box">
            <div class="center"> <img alt="" src="{{url('public/img/user.png')}}" class="img-circle"/> </div>
            <h4> Hello User !</h4>
            <p class="text-center">Please login to Access your Account</p>
            <div class="row">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="text-left">
                            <label class="text-muted">Email ID</label>
                            <input id="email signupInputEmail1" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="text-left">
                            <label for="signupInputPassword" class="text-muted">Password</label>
                            <input id="password signupInputPassword" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="pull-left pad-btm">
                            <label class="form-checkbox form-icon form-text">
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="registration"> Don't have an account ! <a href="#/pages/signup"> <span class="text-primary"> Sign Up </span> </a> </div>
    </div>
</div>
<!--===================================================-->
<!-- END OF CONTAINER -->
<!--JAVASCRIPT-->
<!--=================================================-->
<!--jQuery [ REQUIRED ]-->
<script src="{{url('public/js/jquery-2.1.1.min.js')}}"></script>
<!--BootstrapJS [ RECOMMENDED ]-->
<script src="{{url('public/js/bootstrap.min.js')}}"></script>
<!--Fast Click [ OPTIONAL ]-->
<script src="{{url('public/plugins/fast-click/fastclick.min.js')}}"></script>
<!--Jasmine Admin [ RECOMMENDED ]-->
<script src="{{url('public/js/scripts.js')}}"></script>
<!--Switchery [ OPTIONAL ]-->
<script src="{{url('public/plugins/switchery/switchery.min.js')}}"></script>
<!--Bootstrap Select [ OPTIONAL ]-->
<script src="{{url('public/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
</body>

<!-- Mirrored from www.designbudy.com/rayan/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Nov 2018 10:44:35 GMT -->
</html>