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
                <div class="text-left">

                    <label for="Start Date">Expense From</label>
                    <input class="form-group datepicker" name="fromdate" id="fromdate" value="{{Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')}}" type="text">
                    <label for="Start Date">To</label>
                    <input class="form-group datepicker" name="toDate" id="toDate" type="text" value="{{Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')}}">
                    <button class="btn btn-sm btn-info" onclick="filter()">Search</button>
                </div>

                <div class="text-right mb-2 mr-2">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#addEmp">Add Expense</button>
                </div>
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Person</th>
                        <th>Tk</th>
                        <th>Date</th>
                        <th>Cause</th>
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="empform" action="{{route('personal.expense.store')}}" novalidate="" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label>Expense For</label>
                            <div>
                                <select id="statusFilter" class="form-control" name="expensefor" required>
                                    <option value="">Select</option>
                                    @foreach($expensePerson as $person)
                                        <option value="{{$person->id}}">{{$person->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label>TK</label>
                            <div>
                                <input data-parsley-type="number" name="price" type="text" class="form-control" required placeholder="Enter Price Amount">
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Expense</h5>
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
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true,

            });
            // fromdate
            // toDate
            datatable =  $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('personal.expense.getData') !!}",
                    "type": "POST",
                    data:function (d){

                        d._token="{{csrf_token()}}";
                        d.fromdate=$('#fromdate').val();
                        d.toDate=$('#toDate').val();

                        if ($('#statusFilter').val()!=""){
                            d.statusFilter=$('#statusFilter').val();
                        }

                    }
                },
                columns: [
                    { data: 'name', name: 'name'},
                    { data: 'price', name: 'price' },
                    { data: 'date', name: 'date'},
                    { data: 'cause', name: 'cause'},
                    { "data": function(data){

                            return '<a class="btn btn-info btn-sm" data-panel-id="'+data.id+'" onclick="editClient(this)"><i class="fa fa-edit"></i></a>' +
                                '<a class="btn btn-danger btn-sm ml-3" data-panel-id="'+data.id+'" onclick="deleteExpense(this)"><i class="fa fa-trash"></i></a>'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },

                ]
            });
        } );
        $('#statusFilter').on('change', function(){

            datatable.ajax.reload();

        });
        function editClient(x) {
            var id=$(x).data('panel-id');



            $.ajax({
                type: 'POST',
                url: "{!! route('personal.expense.edit') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {
                    $("#editEmpBody").html(data);
                    $('#editEmp').modal();
                    // console.log(data);
                }
            });

        }
        function deleteExpense(x) {
            var id=$(x).data('panel-id');
            $.confirm({
                title: 'Confirm!',
                content: 'Simple confirm!',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: 'POST',
                            url: "{!! route('perosnal.expense.deleteExpense') !!}",
                            cache: false,
                            data: {_token: "{{csrf_token()}}",'id': id},
                            success: function (data) {
                                $.alert('Expense Deleted Successfully');
                                datatable.ajax.reload();
                            }
                        });
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }
                }
            });



        }

        function filter(){
            datatable.ajax.reload();
        }

    </script>
    {{--DataTables--}}
    <script src="{{url('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{url('public/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{url('public/pages/datatables.init.js')}}"></script>
@endsection