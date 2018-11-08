@extends('layout.mainLayout')
@section('css')
    <link href="{{url('public/plugins/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{url('public/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css')}}" rel="stylesheet">
    <style>
        .row {
            margin-top: 14px;
        }
    </style>
    @endsection
@section('content')
    <div class="panel">
        <div class="panel-heading">
            @if(session()->has('success'))
                Emp Saved
                @endif
            <h3 class="panel-title pull-left">Employee List</h3>
            <a href="{{route('employee.create')}}" class="btn btn-success pull-right mt-5 mr-5">Add Emmployee</a>
        </div>
        <hr>
        <div class="panel-body">
            <table id="demo-dt-basic" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="">EmployeeName</th>
                    <th class="min-tablet">Designation</th>
                    <th class="min-tablet">Salary</th>
                    <th class="min-desktop">Phone</th>
                    <th class="min-desktop">Email</th>
                    <th class="min-desktop">Address</th>
                    <th class="min-desktop">Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{$employee->employeeName}}</td>
                    <td>{{$employee->degisnation}}</td>
                    <td>{{$employee->salary}}</td>
                    <td>{{$employee->phone}}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->address}}</td>
                    <td>
                        <button type="button" class="btn btn-primary editmodal" data-id="{{$employee->employeeId}}" data-toggle="modal" data-target="#editModal">
                            <i class="fa fa-edit"></i>
                        </button>
                        <div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{route('employee.updateEmployee')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Employee Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <input type="hidden" name="editid" id="editid">
                                            <div class="row mb-3">
                                                <div class="col-md-3">Employee Name</div>
                                                <div class="col-md-9 form-group"><input class="form-control" type="text" value="{{$employee->employeeName}}" name="employeeName"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">Designation</div>
                                                <div class="col-md-9 form-group"><input class="form-control" type="text" value="{{$employee->degisnation}}" name="degisnation"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">Salary</div>
                                                <div class="col-md-9 form-group"><input class="form-control" type="text" value="{{$employee->salary}}" name="salary"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">Phone</div>
                                                <div class="col-md-9 form-group"><input class="form-control" type="text" value="{{$employee->phone}}" name="phone"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">Email</div>
                                                <div class="col-md-9 form-group"><input class="form-control" type="text" value="{{$employee->email}}" name="email"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">Address</div>
                                                <div class="col-md-9 form-group"><input class="form-control" type="text" value="{{$employee->address}}" name="address"></div>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update Employee</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        {{--Delete Modal For The Employee--}}
                            <button type="button" class="btn btn-danger datapass" data-id="{{$employee->employeeId}}" data-toggle="modal" data-target="#exampleModal">
                               <i class="fa fa-trash"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{route('employee.deleteEmployee')}}" method="post">
                                            {{csrf_field()}}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete Employee</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <h4 class="text-center">Are You Sure?</h4>
                                                <input type="hidden" name="deleteId" id="deleteId">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Delete Employee</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                    </td>

                </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

    @endsection


@section('foot-js')
    <script src="{{url('public/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{url('public/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{url('public/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
    <!--Fullscreen jQuery [ OPTIONAL ]-->
    <script src="{{url('public/plugins/screenfull/screenfull.js')}}"></script>
    <!--DataTables Sample [ SAMPLE ]-->
    <script src="{{url('public/js/demo/tables-datatables.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".datapass").click(function () {
                $('#deleteId').val($(this).data('id'));
            });
        });

        $(".editmodal").click(function () {
            $('#editid').val($(this).data('id'));
        });
    </script>
    @endsection