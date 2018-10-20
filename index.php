
<?php include ("header.php") ?>

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <button class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Create</button>
                        <div class="dropdown pull-right m-r-10 hidden-sm-down">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                January 2017
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">February 2017</a>
                                <a class="dropdown-item" href="#">March 2017</a>
                                <a class="dropdown-item" href="#">April 2017</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daily Sales</h4>
                                <div class="text-right">
                                    <h2 class="font-light m-b-0"><i class="ti-arrow-up text-success"></i> $120</h2>
                                    <span class="text-muted">Todays Income</span>
                                </div>
                                <span class="text-success">60%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Weekly Sales</h4>
                                <div class="text-right">
                                    <h2 class="font-light m-b-0"><i class="ti-arrow-up text-info"></i> $5,000</h2>
                                    <span class="text-muted">Todays Income</span>
                                </div>
                                <span class="text-info">30%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 30%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Monthly Sales</h4>
                                <div class="text-right">
                                    <h2 class="font-light m-b-0"><i class="ti-arrow-up text-purple"></i> $8,000</h2>
                                    <span class="text-muted">Todays Income</span>
                                </div>
                                <span class="text-purple">60%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-purple" role="progressbar" style="width: 60%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Yearly Sales</h4>
                                <div class="text-right">
                                    <h2 class="font-light m-b-0"><i class="ti-arrow-down text-danger"></i> $12,000</h2>
                                    <span class="text-muted">Todays Income</span>
                                </div>
                                <span class="text-danger">80%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->

                <!-- Row -->
                <div class="row">
                    <!--<div class="col-lg-8">-->
                    <!--    <div class="card">-->
                    <!--        <div class="card-body">-->
                    <!--            <select class="custom-select pull-right">-->
                    <!--                <option selected>January</option>-->
                    <!--                <option value="1">February</option>-->
                    <!--                <option value="2">March</option>-->
                    <!--                <option value="3">April</option>-->
                    <!--            </select>-->
                    <!--            <h4 class="card-title">Projects of the Month</h4>-->
                    <!--            <div class="table-responsive m-t-40">-->
                    <!--                <table class="table stylish-table">-->
                    <!--                    <thead>-->
                    <!--                        <tr>-->
                    <!--                            <th colspan="2">Assigned</th>-->
                    <!--                            <th>Name</th>-->
                    <!--                            <th>Priority</th>-->
                    <!--                            <th>Budget</th>-->
                    <!--                        </tr>-->
                    <!--                    </thead>-->
                    <!--                    <tbody>-->
                    <!--                        <tr>-->
                    <!--                            <td style="width:50px;"><span class="round">S</span></td>-->
                    <!--                            <td>-->
                    <!--                                <h6>Sunil Joshi</h6><small class="text-muted">Web Designer</small></td>-->
                    <!--                            <td>Elite Admin</td>-->
                    <!--                            <td><span class="label label-light-success">Low</span></td>-->
                    <!--                            <td>$3.9K</td>-->
                    <!--                        </tr>-->
                    <!--                        <tr class="active">-->
                    <!--                            <td><span class="round"><img src="../assets/images/users/2.jpg" alt="user" width="50" /></span></td>-->
                    <!--                            <td>-->
                    <!--                                <h6>Andrew</h6><small class="text-muted">Project Manager</small></td>-->
                    <!--                            <td>Real Homes</td>-->
                    <!--                            <td><span class="label label-light-info">Medium</span></td>-->
                    <!--                            <td>$23.9K</td>-->
                    <!--                        </tr>-->
                    <!--                        <tr>-->
                    <!--                            <td><span class="round round-success">B</span></td>-->
                    <!--                            <td>-->
                    <!--                                <h6>Bhavesh patel</h6><small class="text-muted">Developer</small></td>-->
                    <!--                            <td>MedicalPro Theme</td>-->
                    <!--                            <td><span class="label label-light-danger">High</span></td>-->
                    <!--                            <td>$12.9K</td>-->
                    <!--                        </tr>-->
                    <!--                        <tr>-->
                    <!--                            <td><span class="round round-primary">N</span></td>-->
                    <!--                            <td>-->
                    <!--                                <h6>Nirav Joshi</h6><small class="text-muted">Frontend Eng</small></td>-->
                    <!--                            <td>Elite Admin</td>-->
                    <!--                            <td><span class="label label-light-success">Low</span></td>-->
                    <!--                            <td>$10.9K</td>-->
                    <!--                        </tr>-->
                    <!--                        <tr>-->
                    <!--                            <td><span class="round round-warning">M</span></td>-->
                    <!--                            <td>-->
                    <!--                                <h6>Micheal Doe</h6><small class="text-muted">Content Writer</small></td>-->
                    <!--                            <td>Helping Hands</td>-->
                    <!--                            <td><span class="label label-light-danger">High</span></td>-->
                    <!--                            <td>$12.9K</td>-->
                    <!--                        </tr>-->
                    <!--                        <tr>-->
                    <!--                            <td><span class="round round-danger">N</span></td>-->
                    <!--                            <td>-->
                    <!--                                <h6>Johnathan</h6><small class="text-muted">Graphic</small></td>-->
                    <!--                            <td>Digital Agency</td>-->
                    <!--                            <td><span class="label label-light-danger">High</span></td>-->
                    <!--                            <td>$2.6K</td>-->
                    <!--                        </tr>-->
                    <!--                    </tbody>-->
                    <!--                </table>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-lg-4">-->
                    <!--    <div class="card">-->
                    <!--        <div class="card-body">-->
                    <!--            <select class="custom-select pull-right">-->
                    <!--                <option selected>Today</option>-->
                    <!--                <option value="1">Weekly</option>-->
                    <!--            </select>-->
                    <!--            <h4 class="card-title">Weather Report</h4>-->
                    <!--            <div class="d-flex align-items-center flex-row m-t-30">-->
                    <!--                <div class="p-2 display-5 text-info"><i class="wi wi-day-showers"></i> <span>73<sup>°</sup></span></div>-->
                    <!--                <div class="p-2">-->
                    <!--                    <h3 class="m-b-0">Saturday</h3><small>Ahmedabad, India</small></div>-->
                    <!--            </div>-->
                    <!--            <table class="table no-border">-->
                    <!--                <tr>-->
                    <!--                    <td>Wind</td>-->
                    <!--                    <td class="font-medium">ESE 17 mph</td>-->
                    <!--                </tr>-->
                    <!--                <tr>-->
                    <!--                    <td>Humidity</td>-->
                    <!--                    <td class="font-medium">83%</td>-->
                    <!--                </tr>-->
                    <!--                <tr>-->
                    <!--                    <td>Pressure</td>-->
                    <!--                    <td class="font-medium">28.56 in</td>-->
                    <!--                </tr>-->
                    <!--                <tr>-->
                    <!--                    <td>Cloud Cover</td>-->
                    <!--                    <td class="font-medium">78%</td>-->
                    <!--                </tr>-->
                    <!--                <tr>-->
                    <!--                    <td>Ceiling</td>-->
                    <!--                    <td class="font-medium">25760 ft</td>-->
                    <!--                </tr>-->
                    <!--            </table>-->
                    <!--            <hr/>-->
                    <!--            <ul class="list-unstyled row text-center city-weather-days">-->
                    <!--                <li class="col"><i class="wi wi-day-sunny"></i><span>09:30</span>-->
                    <!--                    <h3>70<sup>°</sup></h3></li>-->
                    <!--                <li class="col"><i class="wi wi-day-cloudy"></i><span>11:30</span>-->
                    <!--                    <h3>72<sup>°</sup></h3></li>-->
                    <!--                <li class="col"><i class="wi wi-day-hail"></i><span>13:30</span>-->
                    <!--                    <h3>75<sup>°</sup></h3></li>-->
                    <!--                <li class="col"><i class="wi wi-day-sprinkle"></i><span>15:30</span>-->
                    <!--                    <h3>76<sup>°</sup></h3></li>-->
                    <!--            </ul>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

<?php include ("footer.php") ?>
