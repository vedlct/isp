@extends('layouts.mainLayout')
@section('css')
    <!-- DataTables -->


    <link href="{{url('public/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('public/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    @endsection
@section('content')
    <div class="row m-2">
        <div class="card col-12">
            <div class="card-body">
                <div class="text-right mb-2 mr-2">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#addEmp">Add Employee</button>
                </div>
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Designation</th>
                        <th>Salary</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
        <!-- end col -->



    {{--Add Employee Modal--}}
    <!--  Modal content for the above example -->

    <div class="modal fade bs-example-modal-lg" id="addEmp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="empform" action="{{route('employee.store')}}" novalidate="" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Employee Name</label>
                            <input type="text" class="form-control" name="employeeName" required="" placeholder="Enter Employee Name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <div>
                                <input type="email" class="form-control" name="email" required="" parsley-type="email" placeholder="Enter a valid e-mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <div>
                                <input parsley-type="text" type="text" name="degisnation" class="form-control" required="" placeholder="Enter Designation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>salary</label>
                            <div>
                                <input data-parsley-type="digits" name="salary" type="text" class="form-control" required="" placeholder="Enter Salary Amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <div>
                                <input data-parsley-type="number" name="phone" type="text" class="form-control" required="" placeholder="Enter Phone numbers">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <div>
                                <textarea required="" name="address" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Employee</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- end row -->

        {{--edit Modal--}}
    <div class="modal fade bs-example-modal-lg" id="editEmp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="editEmpBody">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    @endsection


@section('js')
    <!-- Required datatable js -->
        <script src="{{url('public/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!-- Datatable init js -->
        <script>
            $(document).ready(function() {
                $('.empform').parsley();
            });
        </script>

        <script>
            $(document).ready( function () {

                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    Filter: true,
                    stateSave: true,
                    type:"POST",
                    "ajax":{
                        "url": "{!! route('employee.getData') !!}",
                        "type": "POST",
                        "data":{ _token: "{{csrf_token()}}"},
                    },
                    columns: [
                        { data: 'employeeName', name: 'employeeName' },
                        { data: 'degisnation', name: 'degisnation' },
                        { data: 'salary', name: 'salary'},
                        { data: 'phone', name: 'phone'},
                        { data: 'email', name: 'email'},
                        { data: 'address', name: 'address'},
                        { "data": function(data){
                               if(data.status=='1'){
                                   return "<span class=\"badge badge-success\">Active</span>"
                               }
                               else {
                                   return "<span class=\"badge badge-danger\">InActive</span>"
                               }
                               },
                            "orderable": false, "searchable":false, "name":"selected_rows" },
                        { "data": function(data){

                                return '<a class="btn btn-default btn-sm" data-panel-id="'+data.employeeId+'" onclick="editClient(this)"><i class="fa fa-edit"></i></a>'
                                    ;},
                            "orderable": false, "searchable":false, "name":"selected_rows" },
                    ]
                });
            } );
            function editClient(x) {
                var id=$(x).data('panel-id');

                $.ajax({
                    type: 'POST',
                    url: "{!! route('employee.edit') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}",'id': id},
                    success: function (data) {
                        $("#editEmpBody").html(data);
                        $('#editEmp').modal();
                        // console.log(data);
                    }
                });

            }
        </script>
    {{--DataTables--}}
    <script src="{{url('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{url('public/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{url('public/pages/datatables.init.js')}}"></script>
    @endsection