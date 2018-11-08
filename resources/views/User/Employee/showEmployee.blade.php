@extends('layout.mainLayout')
@section('css')
    <link href="{{url('public/plugins/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{url('public/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css')}}" rel="stylesheet">

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
                    <th class="min-tablet">Degisnation</th>
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
                        <div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
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

                                                <input type="hidden" name="id">

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
    @endsection