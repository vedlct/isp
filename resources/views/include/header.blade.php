<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ISP Management</title>
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
    <!--Bootstrap Validator [ OPTIONAL ]-->
    <link href="{{url('public/plugins/bootstrap-validator/bootstrapValidator.min.css')}}" rel="stylesheet">
    <!--ricksaw.js [ OPTIONAL ]-->
    {{--<link href="{{url('public/plugins/jquery-ricksaw-chart/css/rickshaw.css')}}" rel="stylesheet">--}}
    <!--jVector Map [ OPTIONAL ]-->
    <link href="{{url('public/plugins/jvectormap/jquery-jvectormap.css')}}" rel="stylesheet">
    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{url('public/css/demo/jquery-steps.min.css')}}" rel="stylesheet">
    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{url('public/css/demo/jasmine.css')}}" rel="stylesheet">

    @yield('css')
    <!--SCRIPT-->
    <!--=================================================-->
    <!--Page Load Progress Bar [ OPTIONAL ]-->
    <link href="{{url('public/plugins/pace/pace.min.css')}}" rel="stylesheet">
    <script src="{{url('public/plugins/pace/pace.min.js')}}"></script>
</head>
<body>
<div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
<header id="navbar">
    <div id="navbar-container" class="boxed">
        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="{{route('index')}}" class="navbar-brand">
                <i class="fa fa-cube brand-icon"></i>
                <div class="brand-title">
                    <span class="brand-text">ISP</span>
                </div>
            </a>
        </div>
        <!--================================-->
        <!--End brand logo & name-->
        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content clearfix">
            <ul class="nav navbar-top-links pull-left">
                <!--Navigation toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#"> <i class="fa fa-navicon fa-lg"></i> </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toogle button-->
                <!--Profile toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li id="profilebtn" class="hidden-xs">
                    <a href="JavaScript:void(0);"> <i class="fa fa-user fa-lg"></i> </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Profile toogle button-->
                <!--Messages Dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> <i class="fa fa-envelope fa-lg"></i> <span class="badge badge-header badge-warning">9</span>
                    </a>
                    <!--Message dropdown menu-->
                    <div class="dropdown-menu dropdown-menu-md with-arrow">
                        <div class="pad-all bord-btm">
                            <div class="h4 text-muted text-thin mar-no">You have 3 messages.</div>
                        </div>
                        <div class="nano scrollable">
                            <div class="nano-content">
                                <ul class="head-list">
                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left"> <img src="img/av2.png" alt="Profile Picture" class="img-circle img-sm"> </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Andy sent you a message</div>
                                                <small class="text-muted">15 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left"> <img src="img/av4.png" alt="Profile Picture" class="img-circle img-sm"> </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Lucy sent you a message</div>
                                                <small class="text-muted">30 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left"> <img src="img/av3.png" alt="Profile Picture" class="img-circle img-sm"> </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Jackson sent you a message</div>
                                                <small class="text-muted">40 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left"> <img src="img/av6.png" alt="Profile Picture" class="img-circle img-sm"> </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Donna sent you a message</div>
                                                <small class="text-muted">5 hours ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left"> <img src="img/av4.png" alt="Profile Picture" class="img-circle img-sm"> </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Lucy sent you a message</div>
                                                <small class="text-muted">Yesterday</small>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left"> <img src="img/av3.png" alt="Profile Picture" class="img-circle img-sm"> </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Jackson sent you a message</div>
                                                <small class="text-muted">Yesterday</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--Dropdown footer-->
                        <div class="pad-all bord-top">
                            <a href="#" class="btn-link text-dark box-block"> <i class="fa fa-angle-right fa-lg pull-right"></i>Show All Messages </a>
                        </div>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End message dropdown-->
                <!--Notification dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> <i class="fa fa-bell fa-lg"></i> <span class="badge badge-header badge-danger">5</span> </a>
                    <!--Notification dropdown menu-->
                    <div class="dropdown-menu dropdown-menu-md with-arrow">
                        <div class="pad-all bord-btm">
                            <div class="h4 text-muted text-thin mar-no"> Notification </div>
                        </div>
                        <div class="nano scrollable">
                            <div class="nano-content">
                                <ul class="head-list">
                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left"> <span class="icon-wrap icon-circle bg-primary"> <i class="fa fa-comment fa-lg"></i> </span> </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">New comments waiting approval</div>
                                                <small class="text-muted">15 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <span class="badge badge-success pull-right">90%</span>
                                            <div class="media-left"> <span class="icon-wrap icon-circle bg-danger"> <i class="fa fa-hdd-o fa-lg"></i> </span> </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">HDD is full</div>
                                                <small class="text-muted">50 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left"> <span class="icon-wrap icon-circle bg-info"> <i class="fa fa-file-word-o fa-lg"></i> </span> </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Write a news article</div>
                                                <small class="text-muted">Last Update 8 hours ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <span class="label label-danger pull-right">New</span>
                                            <div class="media-left"> <span class="icon-wrap icon-circle bg-purple"> <i class="fa fa-comment fa-lg"></i> </span> </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Comment Sorting</div>
                                                <small class="text-muted">Last Update 8 hours ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left"> <span class="icon-wrap icon-circle bg-success"> <i class="fa fa-user fa-lg"></i> </span> </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">New User Registered</div>
                                                <small class="text-muted">4 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--Dropdown footer-->
                        <div class="pad-all bord-top">
                            <a href="#" class="btn-link text-dark box-block"> <i class="fa fa-angle-right fa-lg pull-right"></i>Show All Notifications </a>
                        </div>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End notifications dropdown-->
            </ul>
            <ul class="nav navbar-top-links pull-right">
                <!--Fullscreen toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="hidden-xs" id="toggleFullscreen">
                    <a class="fa fa-expand" data-toggle="fullscreen" href="#" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Fullscreen toogle button-->
                <!--User dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li id="dropdown-user" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                        <span class="pull-right"> <img class="img-circle img-user media-object" src="img/av1.png" alt="Profile Picture"> </span>
                        <div class="username hidden-xs">{{Auth::user()->name}}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right with-arrow">
                        <!-- User dropdown menu -->
                        <ul class="head-list">
                            <li>
                                <a href="#"> <i class="fa fa-user fa-fw"></i> Profile </a>
                            </li>
                            <li>
                                <a href="#">  <i class="fa fa-envelope fa-fw"></i> Messages </a>
                            </li>
                            <li>
                                <a href="#">  <i class="fa fa-gear fa-fw"></i> Settings </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out fa-fw"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </li>
                        </ul>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End user dropdown-->
                <!--Navigation toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                {{--<li class="hidden-xs">--}}
                    {{--<a id="demo-toggle-aside" href="#">--}}
                        {{--<i class="fa fa-navicon fa-lg"></i>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toogle button-->
            </ul>
        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->
    </div>
</header>
    <div id="content-container">
        <div id="profilebody">
            <div class="pad-all animated fadeInDown">
                <div class="row">
                    <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                        <div class="panel panel-default mar-no">
                            <div class="panel-body">
                                <a href="JavaScript:void(0);">
                                    <div class="pull-left">
                                        <p class="profile-title text-bricky">Users</p>
                                    </div>
                                    <div class="pull-right text-bricky"> <i class="fa fa-users fa-4x"></i> </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                        <div class="panel panel-default mar-no">
                            <div class="panel-body">
                                <a href="JavaScript:void(0);">
                                    <div class="pull-left">
                                        <p class="profile-title text-bricky">Inbox</p>
                                    </div>
                                    <div class="pull-right text-bricky"> <i class="fa fa-envelope fa-4x"></i> </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                        <div class="panel panel-default mar-no">
                            <div class="panel-body">
                                <a href="JavaScript:void(0);">
                                    <div class="pull-left">
                                        <p class="profile-title text-bricky">FAQ</p>
                                    </div>
                                    <div class="pull-right text-bricky"> <i class="fa fa-headphones fa-4x"></i> </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                        <div class="panel panel-default mar-no">
                            <div class="panel-body">
                                <a href="JavaScript:void(0);">
                                    <div class="pull-left">
                                        <p class="profile-title text-bricky">Settings</p>
                                    </div>
                                    <div class="pull-right text-bricky"> <i class="fa fa-cogs fa-4x"></i> </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                        <div class="panel panel-default mar-no">
                            <div class="panel-body">
                                <a href="JavaScript:void(0);">
                                    <div class="pull-left">
                                        <p class="profile-title text-bricky">Calender</p>
                                    </div>
                                    <div class="pull-right text-bricky"> <i class="fa fa-calendar fa-4x"></i> </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                        <div class="panel panel-default mar-no">
                            <div class="panel-body">
                                <a href="JavaScript:void(0);">
                                    <div class="pull-left">
                                        <p class="profile-title text-bricky">Pictures</p>
                                    </div>
                                    <div class="pull-right text-bricky"> <i class="fa fa-picture-o fa-4x"></i> </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        {{--<div class="pageheader">--}}
            {{--<h3><i class="fa fa-home"></i> Dashboard </h3>--}}
            {{--<div class="breadcrumb-wrapper">--}}
                {{--<span class="label">You are here:</span>--}}
                {{--<ol class="breadcrumb">--}}
                    {{--<li> <a href="#"> Home </a> </li>--}}
                    {{--<li class="active"> Dashboard </li>--}}
                {{--</ol>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <!--Widget-4 -->

            @yield('content')
            

        </div>
        <!--===================================================-->
        <!--End page content-->
    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
    <!--MAIN NAVIGATION-->
    <!--===================================================-->
    <nav id="mainnav-container">
        <div id="mainnav">
            <!--Menu-->
            <!--================================-->
            <div id="mainnav-menu-wrap">
                <div class="nano">
                    <div class="nano-content">
                        <ul id="mainnav-menu" class="list-group">
                            <!--Category name-->
                            {{--<li class="list-header">Navigation</li>--}}
                            <!--Menu list item-->
                            {{--<li>--}}
                                {{--<a href="javascript:void(0)">--}}
                                    {{--<i class="fa fa-home"></i>--}}
                                    {{--<span class="menu-title">Dashboard</span>--}}
                                    {{--<i class="arrow"></i>--}}
                                {{--</a>--}}
                                {{--<!--Submenu-->--}}
                                {{--<ul class="collapse">--}}
                                    {{--<li><a href="index-2.html"><i class="fa fa-caret-right"></i> Homepage V1</a></li>--}}
                                    {{--<li><a href="dashboard-v2.html"><i class="fa fa-caret-right"></i> Homepage V2</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            <!--Category name-->
                            {{--<li class="list-header">Components</li>--}}
                            <!--Menu list item-->
                            <li>
                                <a href="#">
                                    <i class="fa fa-home"></i>
                                    <span class="menu-title">
                                               Dashboard
                                            </span>

                                </a>
                                <!--Submenu-->
                            </li>
                            <li>
                                <a href="{{route('employee.show')}}">
                                    <i class="fa fa-th"></i>
                                    <span class="menu-title">
                                               Employee
                                            </span>

                                </a>
                                <!--Submenu-->
                            </li>
                            <!--Menu list item-->
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-briefcase"></i>--}}
                                    {{--<span class="menu-title">UI Elements</span>--}}
                                    {{--<i class="arrow"></i>--}}
                                {{--</a>--}}
                                {{--<!--Submenu-->--}}
                                {{--<ul class="collapse">--}}
                                    {{--<li><a href="ui-animation.html"><i class="fa fa-caret-right"></i> CSS3 Animation </a></li>--}}
                                    {{--<li><a href="ui-panel.html"><i class="fa fa-caret-right"></i> Panel </a></li>--}}
                                    {{--<li><a href="ui-xeditable.html"><i class="fa fa-caret-right"></i> Xeditable </a></li>--}}
                                    {{--<li><a href="ui-button.html"><i class="fa fa-caret-right"></i> Buttons </a></li>--}}
                                    {{--<li><a href="ui-fontawesome.html"><i class="fa fa-caret-right"></i> Fontawesome </a></li>--}}
                                    {{--<li><a href="ui-icons.html"><i class="fa fa-caret-right"></i> Icons </a></li>--}}
                                    {{--<li><a href="ui-components.html"><i class="fa fa-caret-right"></i> Components </a></li>--}}
                                    {{--<li><a href="ui-timeline.html"><i class="fa fa-caret-right"></i> Timeline </a></li>--}}
                                    {{--<li><a href="ui-nested-lists.html"><i class="fa fa-caret-right"></i> Nested Lists </a></li>--}}
                                    {{--<li><a href="ui-grids.html"><i class="fa fa-caret-right"></i> Grids </a></li>--}}
                                    {{--<li><a href="ui-tab.html"><i class="fa fa-caret-right"></i> Tab </a></li>--}}
                                    {{--<li><a href="ui-accordions.html"><i class="fa fa-caret-right"></i> Accordions </a></li>--}}
                                    {{--<li><a href="ui-dragdrop.html"><i class="fa fa-caret-right"></i> Draggable Panel</a></li>--}}
                                    {{--<li><a href="ui-typography.html"><i class="fa fa-caret-right"></i> Typography </a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<!--Menu list item-->--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-file"></i>--}}
                                    {{--<span class="menu-title">Pages</span>--}}
                                    {{--<i class="arrow"></i>--}}
                                {{--</a>--}}
                                {{--<!--Submenu-->--}}
                                {{--<ul class="collapse">--}}
                                    {{--<li><a href="pages-faq.html"><i class="fa fa-caret-right"></i> FAQ </a></li>--}}
                                    {{--<li><a href="pages-gallery.html"><i class="fa fa-caret-right"></i> Gallery </a></li>--}}
                                    {{--<li><a href="pages-directory.html"><i class="fa fa-caret-right"></i> Directory </a></li>--}}
                                    {{--<li><a href="pages-profile.html"><i class="fa fa-caret-right"></i> User Profile </a></li>--}}
                                    {{--<li><a href="pages-invoice.html"><i class="fa fa-caret-right"></i> Invoice </a></li>--}}
                                    {{--<li><a href="pages-login.html"><i class="fa fa-caret-right"></i> Login </a></li>--}}
                                    {{--<li><a href="pages-register.html"><i class="fa fa-caret-right"></i> Register </a></li>--}}
                                    {{--<li><a href="pages-password-reminder.html"><i class="fa fa-caret-right"></i> Password Reminder </a></li>--}}
                                    {{--<li><a href="pages-lock-screen.html"><i class="fa fa-caret-right"></i> Lock Screen </a></li>--}}
                                    {{--<li><a href="pages-404.html"><i class="fa fa-caret-right"></i> 404 Error </a></li>--}}
                                    {{--<li><a href="pages-500.html"><i class="fa fa-caret-right"></i> 500 Error </a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<!--Menu list item-->--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-table"></i>--}}
                                    {{--<span class="menu-title">Tables</span>--}}
                                    {{--<i class="arrow"></i>--}}
                                {{--</a>--}}
                                {{--<!--Submenu-->--}}
                                {{--<ul class="collapse">--}}
                                    {{--<li><a href="table-static.html"><i class="fa fa-caret-right"></i> Static Table <span class="label label-info pull-right">New</span></a></li>--}}
                                    {{--<li><a href="table-datatable.html"><i class="fa fa-caret-right"></i> Datatable Table </a></li>--}}
                                    {{--<li><a href="table-footable.html"><i class="fa fa-caret-right"></i> Footable Table </a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<!--Menu list item-->--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-edit"></i>--}}
                                    {{--<span class="menu-title">Forms</span>--}}
                                    {{--<i class="arrow"></i>--}}
                                {{--</a>--}}
                                {{--<!--Submenu-->--}}
                                {{--<ul class="collapse">--}}
                                    {{--<li><a href="forms-layout.html"><i class="fa fa-caret-right"></i> Form Layout </a></li>--}}
                                    {{--<li><a href="forms-switchery.html"><i class="fa fa-caret-right"></i> Form Switchery </a></li>--}}
                                    {{--<li><a href="forms-components.html"><i class="fa fa-caret-right"></i> Form Components </a></li>--}}
                                    {{--<li><a href="forms-validation.html"><i class="fa fa-caret-right"></i> Form Validation </a></li>--}}
                                    {{--<li><a href="forms-wizard.html"><i class="fa fa-caret-right"></i> Form Wizard </a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<!--Menu list item-->--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-line-chart"></i>--}}
                                    {{--<span class="menu-title">Charts</span>--}}
                                    {{--<i class="arrow"></i>--}}
                                {{--</a>--}}
                                {{--<!--Submenu-->--}}
                                {{--<ul class="collapse">--}}
                                    {{--<li><a href="charts-flot.html"><i class="fa fa-caret-right"></i> Flot Chart </a></li>--}}
                                    {{--<li><a href="charts-morris.html"><i class="fa fa-caret-right"></i> Morris Chart </a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li class="list-divider"></li>--}}
                            {{--<!--Category name-->--}}
                            {{--<li class="list-header">Extra</li>--}}
                            {{--<!--Menu list item-->--}}
                            {{--<li>--}}
                                {{--<a href="calendar.html">--}}
                                    {{--<i class="fa fa-calendar"></i>--}}
                                    {{--<span class="menu-title">--}}
                                            {{--Calendar--}}
                                            {{--</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<!--Menu list item-->--}}
                            {{--<li>--}}
                                {{--<a href="ui-widgets.html">--}}
                                    {{--<i class="fa fa-flask"></i>--}}
                                    {{--<span class="menu-title">--}}
                                               {{--Widgets--}}
                                            {{--<span class="label label-pink pull-right">New</span>--}}
                                            {{--</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<!--Menu list item-->--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-envelope-o"></i>--}}
                                    {{--<span class="menu-title">Mail</span>--}}
                                    {{--<i class="arrow"></i>--}}
                                {{--</a>--}}
                                {{--<!--Submenu-->--}}
                                {{--<ul class="collapse">--}}
                                    {{--<li><a href="mail-inbox.html"><i class="fa fa-caret-right"></i> Inbox </a></li>--}}
                                    {{--<li><a href="mail-compose.html"><i class="fa fa-caret-right"></i> Compose </a></li>--}}
                                    {{--<li><a href="mail-mailview.html"><i class="fa fa-caret-right"></i> Mail View </a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<!--Menu list item-->--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-map-marker"></i>--}}
                                    {{--<span class="menu-title">--}}
                                            {{--Maps--}}
                                            {{--<span class="label label-mint pull-right">New</span>--}}
                                            {{--</span>--}}
                                {{--</a>--}}
                                {{--<!--Submenu-->--}}
                                {{--<ul class="collapse">--}}
                                    {{--<li><a href="maps-gmap.html">Google Maps</a></li>--}}
                                    {{--<li><a href="maps-vectormap.html">Vector Maps</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<!--Menu list item-->--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-plus-square"></i>--}}
                                    {{--<span class="menu-title">Menu Level</span>--}}
                                    {{--<i class="arrow"></i>--}}
                                {{--</a>--}}
                                {{--<!--Submenu-->--}}
                                {{--<ul class="collapse">--}}
                                    {{--<li><a href="#"><i class="fa fa-caret-right"></i> Second Level Item</a></li>--}}
                                    {{--<li><a href="#"><i class="fa fa-caret-right"></i> Second Level Item</a></li>--}}
                                    {{--<li><a href="#"><i class="fa fa-caret-right"></i> Second Level Item</a></li>--}}
                                    {{--<li class="list-divider"></li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">Third Level<i class="arrow"></i></a>--}}
                                        {{--<!--Submenu-->--}}
                                        {{--<ul class="collapse">--}}
                                            {{--<li><a href="#"><i class="fa fa-caret-right"></i> Third Level Item</a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-caret-right"></i> Third Level Item</a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-caret-right"></i> Third Level Item</a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-caret-right"></i> Third Level Item</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">Third Level<i class="arrow"></i></a>--}}
                                        {{--<!--Submenu-->--}}
                                        {{--<ul class="collapse">--}}
                                            {{--<li><a href="#"><i class="fa fa-caret-right"></i> Third Level Item</a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-caret-right"></i> Third Level Item</a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-caret-right"></i> Third Level Item</a></li>--}}
                                            {{--<li class="list-divider"></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-caret-right"></i> Third Level Item</a></li>--}}
                                            {{--<li><a href="#"><i class="fa fa-caret-right"></i> Third Level Item</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        <!--Widget-->
                        <!--================================-->
                        {{--<div class="mainnav-widget">--}}
                            {{--<!-- Show the button on collapsed navigation -->--}}
                            {{--<div class="show-small">--}}
                                {{--<a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">--}}
                                    {{--<i class="fa fa-desktop"></i>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                            {{--<!-- Hide the content on collapsed navigation -->--}}
                            {{--<div id="demo-wg-server" class="hide-small mainnav-widget-content">--}}
                                {{--<ul class="list-group">--}}
                                    {{--<li class="list-header pad-no pad-ver">Server Status</li>--}}
                                    {{--<li class="mar-btm">--}}
                                        {{--<span class="label label-primary pull-right">15%</span>--}}
                                        {{--<p>CPU Usage</p>--}}
                                        {{--<div class="progress progress-sm">--}}
                                            {{--<div class="progress-bar progress-bar-primary" style="width: 15%;">--}}
                                                {{--<span class="sr-only">15%</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li class="mar-btm">--}}
                                        {{--<span class="label label-purple pull-right">75%</span>--}}
                                        {{--<p>Bandwidth</p>--}}
                                        {{--<div class="progress progress-sm">--}}
                                            {{--<div class="progress-bar progress-bar-purple" style="width: 75%;">--}}
                                                {{--<span class="sr-only">75%</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <!--================================-->
                        <!--End widget-->
                        </ul>
                    </div>
                </div>
            </div>
            <!--================================-->
            <!--End menu-->
        </div>
    </nav>
    <!--===================================================-->
    <!--END MAIN NAVIGATION-->