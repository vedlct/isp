@extends('layouts.mainLayout')
@section('css')
    <!-- DataTables -->


    <link href="{{url('public/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('public/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
    <div class="row m-2">

        <div class="card col-12">
            <div class="card-body">
                <div class="text-left mb-2 mr-2">
                    <label for="datepicket">Start Date </label>
                    <input class="form-group datepicker" type="text"></div>
                <div class="text-right mb-2 mr-2">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#addEmp">Add Expense</button>
                </div>
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Employee Salary</th>
                        <th>Salary Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Nasim</td>
                        <td>Nasim</td>
                        <td>Nasim</td>
                        <td>Nasim</td>
                    </tr>
                    </tbody>
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
                    <form class="empform" action="{{route('expense.store')}}" novalidate="" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Quantity</label>
                            <div>
                                <input data-parsley-type="number" name="amount" type="text" class="form-control" required="" placeholder="Enter Quantity Amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>price</label>
                            <div>
                                <input data-parsley-type="number" name="price" type="text" class="form-control" required="" placeholder="Enter Price Amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cause</label>
                            <div>
                                <textarea required="" name="cause" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Expense</button>
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
    <div class="modal fade " id="editEmp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Datatable init js -->
    <script>
        $(document).ready(function() {
            $('.empform').parsley();

            $('.datepicker').datepicker({
                format: 'yyyy/mm/dd',
                autoclose:true,
                minViewMode: 1,

            });
        });
    </script>


    {{--DataTables--}}
    <script src="{{url('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{url('public/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{url('public/pages/datatables.init.js')}}"></script>
@endsection