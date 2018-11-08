@extends('layouts.mainLayout')
@section('css')
    <!-- DataTables -->



    @endsection
@section('content')

    <div class="row m-2">
        <div class="card col-12">
            <div class="card-body">
                <div class="text-right mb-2 mr-2">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg">Add Employee</button>
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
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{$employee->employeeName}}</td>
                            <td>{{$employee->degisnation}}</td>
                            <td>{{$employee->salary}}</td>
                            <td>{{$employee->phone}}</td>
                            <td>{{$employee->email}}</td>
                            <td>{{$employee->address}}</td>
                            @if($employee->status=='1')
                            <td><p><i class="badge badge-success">Active</i></p></td>
                            @else
                                <td><p><i class="badge badge-danger">InActive</i></p></td>
                            @endif
                            <td>
                                <button type="button" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <!-- end col -->



    {{--Add Employee Modal--}}
    <!--  Modal content for the above example -->

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
    <!-- end row -->

        {{--DElete Modal --}}

    @endsection


@section('js')
    <!-- Required datatable js -->
        <script src="{{url('public/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!-- Datatable init js -->
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
        <script>
            $(document).ready(function() {
                $('.empform').parsley();
            });
        </script>
    @endsection