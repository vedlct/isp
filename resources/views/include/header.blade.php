<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themesdesign.in/drixo/vertical/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Nov 2018 08:38:06 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>ISP</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="ThemeDesign" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{url('public/plugins/morris/morris.css')}}">
    <link href="{{url('public/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('public/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('public/css/style.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css" />

    @yield('css')
</head>

<body class="fixed-left">
<!-- Loader -->
{{--<div id="preloader">--}}
    {{--<div id="status">--}}
        {{--<div class="spinner"></div>--}}
    {{--</div>--}}
{{--</div>--}}
<!-- Begin page -->
<div id="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    @include('include.navbar')

    <!-- Left Sidebar End -->
    <!-- Start right Content here -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <!-- Top Bar Start -->
            <div class="topbar">
                <div class="topbar-left	d-none d-lg-block">
                    <div class="text-center">
                       <h2 style="color: white">ISP</h2>
                        {{--<a href="index-2.html" class="logo"><img src="{{url('public/images/logo.png')}}" height="20" alt="logo"></a>--}}
                    </div>
                </div>
                <nav class="navbar-custom">
                    <ul class="list-inline float-right mb-0">
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img src="{{url('public/images/users/user-1.jpg')}}" alt="user" class="rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-inline menu-left mb-0">
                        <li class="list-inline-item">
                            <button type="button" class="button-menu-mobile open-left waves-effect"><i class="ion-navicon"></i></button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </nav>
            </div>
            <!-- Top Bar End -->

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="float-right page-breadcrumb">

                            </div>
                            <h5 class="page-title"></h5></div>
                    </div>
                </div>
            </div>
             <!-- end row -->

            @if(Session::has('message'))
                <p class="alert alert-info">{{ Session::get('message') }}</p>
            @endif
@yield('content')