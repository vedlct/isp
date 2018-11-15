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
    <div class="left side-menu">
        <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect"><i class="ion-close"></i></button>
        <div class="left-side-logo d-block d-lg-none">
            <div>ISP</h2>
                {{--<a href="{{route('index')}}" class="logo"><img src="{{url('public/images/logo-dark.png')}}" height="20" alt="logo"></a>--}}
            </div>
        </div>
        <div class="sidebar-inner slimscrollleft">
            <div id="sidebar-menu">
                <ul>
                    <li class="menu-title">Main</li>
                    <li>
                        <a href="{{route('index')}}" class="waves-effect">
                            <i class="dripicons-blog"></i> <span>Dashboard </span>
                        </a>
                    </li>
                    <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-meter"></i> <span>Package </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{route('package.show')}}" class="waves-effect">Internet Package</a></li>
                            <li><a href="{{route('package.cable.show')}}" class="waves-effect">Cable Package</a></li>

                        </ul>
                    </li>




                    <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span>Employee </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{route('employee.show')}}" class="waves-effect">
                                    <i class="fa fa-empire"></i> <span>Employee List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('employee.getSalary')}}" class="waves-effect">
                                    <i class="fa fa-empire"></i> <span>Employee Salary</span>
                                </a>
                            </li>
                            {{--<li><a href="{{route('report.showSummary')}}" class="waves-effect">Summary</a></li>--}}
                        </ul>

                    </li>


                    <li>
                        <a href="{{route('client.show')}}" class="waves-effect">
                            <i class="fa fa-user"></i> <span>Client</span>
                        </a>
                    </li>

                    {{--<li>--}}
                        {{--<a href="{{route('bill.show')}}" class="waves-effect">--}}
                            {{--<i class="fa fa-money"></i> <span>Bill</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span>Bill</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{route('bill.show')}}" class="waves-effect">Monthly Bill</a></li>
                            <li><a href="{{route('bill.showPastDue')}}" class="waves-effect">Past Due</a></li>
                            {{--<li><a href="{{route('report.showSummary')}}" class="waves-effect">Summary</a></li>--}}
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('expense.show')}}" class="waves-effect">
                            <i class="fa fa-shopping-basket"></i> <span>Expense</span>
                        </a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="#" class="waves-effect">--}}
                            {{--<i class="fa fa-bar-chart"></i> <span>Report</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span>Report </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{route('report.showDebit')}}" class="waves-effect">Debit</a></li>
                            <li><a href="{{route('report.showCredit')}}" class="waves-effect">Credit</a></li>
                            {{--<li><a href="{{route('report.showSummary')}}" class="waves-effect">Summary</a></li>--}}
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('company')}}" class="waves-effect">
                            <i class="fa fa-bar-chart"></i> <span>Company Info</span>
                        </a>
                    </li>

                    {{--<li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span>Report </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="ui-alerts.html">Alerts</a></li>--}}
                            {{--<li><a href="ui-buttons.html">Buttons</a></li>--}}
                            {{--<li><a href="ui-badge.html">Badge</a></li>--}}
                            {{--<li><a href="ui-cards.html">Cards</a></li>--}}
                            {{--<li><a href="ui-dropdowns.html">Dropdowns</a></li>--}}
                            {{--<li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a></li>--}}
                            {{--<li><a href="ui-modals.html">Modals</a></li>--}}
                            {{--<li><a href="ui-images.html">Images</a></li>--}}
                            {{--<li><a href="ui-progressbars.html">Progress Bars</a></li>--}}
                            {{--<li><a href="ui-navs.html">Navs</a></li>--}}
                            {{--<li><a href="ui-pagination.html">Pagination</a></li>--}}
                            {{--<li><a href="ui-popover-tooltips.html">Popover & Tooltips</a></li>--}}
                            {{--<li><a href="ui-carousel.html">Carousel</a></li>--}}
                            {{--<li><a href="ui-video.html">Video</a></li>--}}
                            {{--<li><a href="ui-typography.html">Typography</a></li>--}}
                            {{--<li><a href="ui-grid.html">Grid</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-broadcast"></i> <span>Advanced UI </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="advanced-alertify.html">Alertify</a></li>--}}
                            {{--<li><a href="advanced-rating.html">Rating</a></li>--}}
                            {{--<li><a href="advanced-nestable.html">Nestable</a></li>--}}
                            {{--<li><a href="advanced-rangeslider.html">Range Slider</a></li>--}}
                            {{--<li><a href="advanced-sweet-alert.html">Sweet-Alert</a></li>--}}
                            {{--<li><a href="advanced-lightbox.html">Lightbox</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-document"></i><span> Forms </span><span class="badge badge-warning badge-pill float-right">8</span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="form-elements.html">Form Elements</a></li>--}}
                            {{--<li><a href="form-validation.html">Form Validation</a></li>--}}
                            {{--<li><a href="form-advanced.html">Form Advanced</a></li>--}}
                            {{--<li><a href="form-editors.html">Form Editors</a></li>--}}
                            {{--<li><a href="form-uploads.html">Form File Upload</a></li>--}}
                            {{--<li><a href="form-mask.html">Form Mask</a></li>--}}
                            {{--<li><a href="form-summernote.html">Summernote</a></li>--}}
                            {{--<li><a href="form-xeditable.html">Form Xeditable</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-graph-pie"></i><span> Charts </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="charts-morris.html">Morris Chart</a></li>--}}
                            {{--<li><a href="charts-chartist.html">Chartist Chart</a></li>--}}
                            {{--<li><a href="charts-chartjs.html">Chartjs Chart</a></li>--}}
                            {{--<li><a href="charts-flot.html">Flot Chart</a></li>--}}
                            {{--<li><a href="charts-c3.html">C3 Chart</a></li>--}}
                            {{--<li><a href="charts-other.html">Jquery Knob Chart</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-list"></i><span> Tables </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="tables-basic.html">Basic Tables</a></li>--}}
                            {{--<li><a href="tables-datatable.html">Data Table</a></li>--}}
                            {{--<li><a href="tables-responsive.html">Responsive Table</a></li>--}}
                            {{--<li><a href="tables-editable.html">Editable Table</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="menu-title">Extra</li>--}}
                    {{--<li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-location"></i><span> Maps </span><span class="badge badge-danger badge-pill float-right">2</span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="maps-google.html">Google Map</a></li>--}}
                            {{--<li><a href="maps-vector.html">Vector Map</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-brightness-max"></i> <span>Icons </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="icons-material.html">Material Design</a></li>--}}
                            {{--<li><a href="icons-ion.html">Ion Icons</a></li>--}}
                            {{--<li><a href="icons-fontawesome.html">Font Awesome</a></li>--}}
                            {{--<li><a href="icons-themify.html">Themify Icons</a></li>--}}
                            {{--<li><a href="icons-dripicons.html">Dripicons</a></li>--}}
                            {{--<li><a href="icons-typicons.html">Typicons Icons</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li><a href="calendar.html" class="waves-effect"><i class="dripicons-calendar"></i><span> Calendar</span></a></li>--}}
                    {{--<li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-copy"></i><span> Pages </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="pages-blank.html">Blank Page</a></li>--}}
                            {{--<li><a href="pages-login.html">Login</a></li>--}}
                            {{--<li><a href="pages-register.html">Register</a></li>--}}
                            {{--<li><a href="pages-recoverpw.html">Recover Password</a></li>--}}
                            {{--<li><a href="pages-lock-screen.html">Lock Screen</a></li>--}}
                            {{--<li><a href="pages-404.html">Error 404</a></li>--}}
                            {{--<li><a href="pages-500.html">Error 500</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-jewel"></i><span> Extras </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="extras-pricing.html">Pricing</a></li>--}}
                            {{--<li><a href="extras-invoice.html">Invoice</a></li>--}}
                            {{--<li><a href="extras-timeline.html">Timeline</a></li>--}}
                            {{--<li><a href="extras-faqs.html">FAQs</a></li>--}}
                            {{--<li><a href="extras-maintenance.html">Maintenance</a></li>--}}
                            {{--<li><a href="extras-comingsoon.html">Coming Soon</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- end sidebarinner -->
    </div>
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