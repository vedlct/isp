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

            <div class="card-header">

                <div class="row">

                    <div class="col-md-6 pull-left">
                        <label class="col-md-2" for="statusFilter">
                            Expense Type
                        </label>
                        <select class="form-control col-md-4" id="statusFilter">
                            <option value="">Select</option>
                            <option value="Food">Food</option>
                            <option value="Router">Router</option>
                            <option value="Accessories">Accessories</option>
                            <option value="Others">Others</option>
                        </select>

                    </div>

                    <div class="text-left col-md-6">
                        <label for="datepicket">From</label>
                        <input class="form-group datepicker" id="dateFilterFrom" name="dateFilterFrom" type="text"> &nbsp;
                        <label for="datepicket">To</label>
                        <input class="form-group datepicker" id="dateFilterTo" name="dateFilterTo" type="text">
                        <input class="btn btn-sm btn-info" id="Submit" name="Submit" value="Submit" onclick="getSummaryData()" type="button">


                    </div>



                </div>

            </div>

            <div class="card-body col-md-12">

                <div class="row">

                <div class="col-md-6">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Type</th>
                        {{--<th>Action</th>--}}
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                    <tr>

                        <th style="text-align:right">Total:</th>
                        <th colspan="2"><span id="pageTotal1"></span></th>

                    </tr>
                    </tfoot>
                </table>
                </div>
                <div class="col-md-6">
                <table id="datatableCredit" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Discount</th>
                        <th>Amount Recieved</th>
                        {{--<th>Action</th>--}}
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                    <tr>
                        <th style="text-align:right">Total:</th>
                        <th ><span id="pageTotal"></span></th>
                        <th ><span id="discountTotal"></span></th>
                        <th ><span id="recievedTotal"></span></th>
                        {{--<th ><span id=""></span></th>--}}

                    </tr>
                    </tfoot>
                </table>
                </div>

                </div>

            </div>
        </div>
    </div>
    <!-- end col -->


@endsection


@section('js')



    <!-- Required datatable js -->
    <script src="{{url('public/plugins/parsleyjs/parsley.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    {{--<script src="//cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>--}}
    <!-- Datatable init js -->
    <script>
        $(document).ready(function() {
//            $('.empform').parsley();

            $('.datepicker').datepicker({
                format: 'yyyy/mm/dd',
                autoclose:true,
                minViewMode: 1,

            });
        });
    </script>

    <script>




        $(document).ready( function () {

            datatable =  $('#datatable').DataTable({

                drawCallback: function () {
                    var api = this.api();
                    $('#pageTotal1').html(api.column( 1, {page:'current'}).data().sum());

                },

                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('report.getDebitData') !!}",
                    "type": "POST",


                    data:function (d){

                        d._token="{{csrf_token()}}";

                        if ($('#dateFilterTo').val()!=""){
                            d.dateFilterTo=$('#dateFilterTo').val();
                        }
                        if ($('#dateFilterFrom').val()!=""){
                            d.dateFilterFrom=$('#dateFilterFrom').val();
                        }
                        if($('#dateFilterTo').val()== '' && $('#dateFilterFrom').val() == ''){
                            d.currentMonth=true;
                        }
                        if($('#statusFilter').val()!= ''){
                            d.statusFilter=$('#statusFilter').val();
                        }

                    }
                },
                columns: [
                    { data: 'date', name: 'date' },
                    { data: 'price', name: 'price' },
                    { data: 'expenseType', name: 'expense.expenseType' },

//                    { "data": function(data){
//                        if (data.tableName == 'employee'){
//                            return 'Employee-Salary';
//                            }else {
//                            return 'Expense';
//
//                            }
//                        },
//
//                        "orderable": false, "searchable":false, "name":"selected_rows" },

//                    { "data": function(data){
//
//                        return '<a class="btn btn-info btn-sm" data-panel-id="'+data.reportId+'" onclick="showDetails(this)"><i class="fa fa-edit"></i></a>'
//                            ;},
//                        "orderable": false, "searchable":false, "name":"selected_rows" },

                ]
            });

            table =  $('#datatableCredit').DataTable({

                drawCallback: function () {
                    var api = this.api();
                    $('#pageTotal').html(api.column( 1, {page:'current'}).data().sum());
                    $('#discountTotal').html(api.column( 2, {page:'current'}).data().sum());
                    $('#recievedTotal').html(api.column( 3, {page:'current'}).data().sum());

                },

                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('report.getCreditData') !!}",
                    "type": "POST",


                    data:function (d){

                        d._token="{{csrf_token()}}";

                        if ($('#dateFilterTo').val()!=""){
                            d.dateFilterTo=$('#dateFilterTo').val();
                        }
                        if ($('#dateFilterFrom').val()!=""){
                            d.dateFilterFrom=$('#dateFilterFrom').val();
                        }
                        if($('#dateFilterTo').val()== '' && $('#dateFilterFrom').val() == ''){
                            d.currentMonth=true;
                        }

                    }
                },
                columns: [
                    { data: 'date', name: 'date' },
                    { data: 'price', name: 'price' },
                    { data: 'discount', name: 'discount' },
                    { data: 'partial', name: 'partial' },

//                    { "data": function(data){
//
//                        return '<a class="btn btn-info btn-sm" data-panel-id="'+data.reportId+'" onclick="showDetails(this)"><i class="fa fa-edit"></i></a>'
//                            ;},
//                        "orderable": false, "searchable":false, "name":"selected_rows" },

                ]
            });




        } );

        $('#statusFilter').on('change', function(){

            datatable.ajax.reload();

        });
        {{--function showDetails(x) {--}}
            {{--var id = $(x).data('panel-id');--}}

            {{--$.ajax({--}}
                {{--type: 'POST',--}}
                {{--url: "{!! route('report.Details') !!}",--}}
                {{--cache: false,--}}
                {{--data: {_token: "{{csrf_token()}}", 'id': id},--}}
                {{--success: function (data) {--}}

                    {{--$('.modal-body').html(data);--}}
                    {{--$('#myModalLabel').html("Details-Report");--}}
                    {{--$('#myModal').modal();--}}

                {{--}--}}
            {{--});--}}
        {{--}--}}

        function getSummaryData() {
            datatable.ajax.reload();  //just reload table
            table.ajax.reload();  //just reload table
            {{--$.ajax({--}}
                {{--type: 'POST',--}}
                {{--url: "{!! route('report.getTotalDebit') !!}",--}}
                {{--cache: false,--}}
                {{--data: {_token: "{{csrf_token()}}",'dateFilterTo':$('#dateFilterTo').val(),'dateFilterFrom':$('#dateFilterFrom').val()},--}}
                {{--success: function (data) {--}}
                    {{--$("#totalSum").html(data);--}}
{{--//                        console.log(data);--}}
                {{--}--}}
            {{--});--}}
        }

    </script>

    {{--DataTables--}}
    <script src="{{url('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{url('public/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{url('public/pages/datatables.init.js')}}"></script>

    <script>
        jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
            return this.flatten().reduce( function ( a, b ) {
                if ( typeof a === 'string' ) {
                    a = a.replace(/[^\d.-]/g, '') * 1;
                }
                if ( typeof b === 'string' ) {
                    b = b.replace(/[^\d.-]/g, '') * 1;
                }

                return a + b;
            }, 0 );
        } );
    </script>

@endsection