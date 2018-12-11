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
                <div class="text-left mb-2">
                    <label for="datepicket">Month </label>
                    <form action="#" method="POST">
                        @csrf
                    <input class="form-group datepicker" name="chooseMonth" id="dataChange" type="text">
                    </form>
                    <a class="btn btn-danger" href="{{route('employee.salaryStore')}}"><i class="fa fa-recycle"></i>Reset</a>
                </div>

                <div id="testDiv">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Employee Salary</th>
                        <th>Month</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salary as $employee)
                    <tr>
                        <td>{{$employee->employeeName}}</td>
                        <td>{{$employee->salary}}</td>
                        <td>
                            {{$salary->where('fkemployeeId',$employee->employeeId)->first()->date}}
                        </td>
                        <td>
                            @if(\App\Http\Controllers\EmployeeController::salaryStatus($employee->employeeId)=='paid')
                                <div class="badge badge-primary">Paid</div>
                                <button type="button"  data-panel-id="{{$salary->where('fkemployeeId', $employee->employeeId)->first()->id}}" onclick="unpaid(this)" class="btn btn-sm btn-danger" id="unPaid"><i class="fa fa-trash"></i></button>
                                @else
                                <form action="{{route('employee.salary.pay')}}" method="post">
                                    @csrf
                                    <input type="hidden" id="id" name="id" value="{{$employee->employeeId}}">
                                    <button type="submit" id="payButton" class="btn btn-info">Pay</button>
                                </form>
                            @endif


                            {{--@if($salary->where('fkemployeeId', $employee->employeeId)->first())--}}
                                {{--@foreach($salary as $sal)--}}
                                {{--@if($sal->satatus=='paid')--}}

                                {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--<form action="{{route('employee.salary.pay')}}" method="post">--}}
                                    {{--@csrf--}}
                                    {{--<input type="hidden" id="id" name="id" value="{{$employee->employeeId}}">--}}
                                    {{--<input class="btn btn-info" type="submit" value="Pay">--}}
                                {{--</form>--}}
                                {{--@endif--}}
                        </td>
                    </tr>
@endforeach
                    </tbody>

                </table>
                </div>
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

    <!-- Datatable init js -->
    <script>
        $(document).ready(function() {
            datatable = $("#datatable").DataTable({
                "ordering": false
            });
            $('.empform').parsley();

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true,
                minViewMode: 1,

            });

            $('#dataChange').on('change',function () {
                currMonth = $('#dataChange').val();
                $.ajax({
                    type: 'POST',
                    url: "{!! route('employee.salaryByMonth') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}",'chooseMonth':currMonth},
                    success: function (data) {
                        console.log(data);
                        if(data.length==0){
                            alert("No Data Found In This Month ")
                        }
                        else{
                            $('#testDiv').html(data)
                        }


                    }
                });
            })
        });

        function unpaid(id) {
            var unPaidId = $(id).data('panel-id');
            $.confirm({
                title: 'Are You Sure!',
                content: 'Cancel the Paid Status',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: 'POST',
                            url: "{!! route('employee.unPaySalary') !!}",
                            cache: false,
                            data: {_token: "{{csrf_token()}}",'id':unPaidId},
                            success: function (data) {
                            }
                        });
                        location.reload();
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }
                }
            });
            console.log(unPaidId);
        }
    </script>


    {{--DataTables--}}
    <script src="{{url('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{url('public/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

@endsection