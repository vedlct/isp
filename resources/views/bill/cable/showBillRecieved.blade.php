@extends('layouts.mainLayout')
@section('css')


    <!-- DataTables -->
    <link href="{{url('public/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('public/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')



    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">All Bill</h4>

                    <div class="row">
                        <div class="col-md-3">
                            <label>Select Month</label>
                            <input type="text" id="billMonth" class="form-control datepicker" @if(isset($date)) value="{{$date}}" @endif name="selectMonth" onchange="changeDate(this)">

                        </div>

                    </div>
                    <br>


                    <div class="table table-responsive">
                        <table id="manageapplication" class="table table-striped table-bordered" style="width:100%" >
                            <thead>
                            <tr>




                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>Price</th>
                                <th>Received By</th>
                                <th>Bill Date</th>
                                <th>Action</th>
                                <th>Invoice</th>


                            </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



@endsection
@section('js')

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('public/assets/js/bootstrap-datepicker.js')}}"></script>

    <script>

        $(document).ready( function () {
            $('.datepicker').datepicker({
                format: 'MM-yyyy',
                autoclose:true,
                minViewMode: 1,

            });


            table = $('#manageapplication').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('bill.cable.show.withData')!!}",
                    "type": "POST",
                    data:function (d){

                        d._token="{{csrf_token()}}";
                        d.pastRecieved=true;
                        if ($('#billMonth').val()!=""){
                            d.billMonth=$('#billMonth').val();
                        }



                    },
                },
                columns: [


                    { data: 'clientFirstName', name: 'cable_client.clientFirstName',"orderable": false, "searchable":true },
                    { data: 'clientLastName', name: 'cable_client.clientLastName',"orderable": false, "searchable":true },
                    { data: 'phone', name: 'cable_client.phone', "orderable": false, "searchable":true },
//                    { data: 'packageName', name: 'package.packageName', "orderable": false, "searchable":true },
//                    { data: 'bandWide', name: 'cable_client.bandWide', "orderable": true, "searchable":true },
                    { data: 'billprice', name: 'cable_bill.price', "orderable": true, "searchable":true },
                    { data: 'name', name: 'user.name', "orderable": false, "searchable":false },
                    { data: 'billdate', name: 'cable_bill.billdate', "orderable": true, "searchable":true },



                    { "data": function(data){

                        if (data.billStatus=='np'){
                            return '<select style="background-color:red;color:white"class="form-control" id="billtype'+data.billId+'" data-panel-date="{{$date}}" data-panel-id="'+data.fkclientId+'" data-primary-id="'+data.billId+'" onchange="changebillstatus(this)">'+
                                '<option  value="paid"  >Paid</option>'+
                                '<option value="due" selected  >Due</option>'+
                                    @if(Auth::user()->fkusertype=='Admin')
                                        '<option value="approved"  >Approved</option>'+
                                    @endif
                                        '</select>';
                        }else if (data.billStatus=='p'){
                            return '<select  style="background-color:green;color:white"class="form-control" id="billtype'+data.billId+'" data-panel-date="{{$date}}" data-panel-id="'+data.fkclientId+'" data-primary-id="'+data.billId+'" onchange="changebillstatus(this)">'+
                                '<option  value="paid" selected  >Paid</option>'+
                                '<option value="due"   >Due</option>'+
                                    @if(Auth::user()->fkusertype=='Admin')
                                        '<option value="approved"  >Approved</option>'+
                                    @endif
                                        '</select>';
                        }
                        else if(data.billStatus=='ap'){
                            return "Approved";
                        }
                        ;},
                        "orderable": false, "searchable":false
                    },

                    { "data": function(data){
                        return '<button class="btn btn-info btn-sm" data-panel-date="{{date('Y-m-d')}}" data-panel-id="'+data.fkclientId+'" onclick="generateBill(this)" ><i class="fa fa-print"></i></button>'
                            ;},
                        "orderable": false, "searchable":false
                    },


                ],

            });

        } );

        function generateBill(x) {
            var id = $(x).data('panel-id');
            var date = $(x).data('panel-date');

//            alert(date);return false;


            let url = "{{ route('bill.Internet.invoiceByClient',[':id',':date']) }}";


            url = url.replace(':id', id);
            url = url.replace(':date', date);


            window.open(url,'_blank');

        }
        function changeDate(x) {
            table.ajax.reload();

        }

        function changebillstatus(x) {

            $.confirm({
                title: 'Confirm!',
                content: 'Are You Sure!',
                buttons: {
                    confirm: function () {
                        var id = $(x).data('panel-id');
                        var date = $(x).data('panel-date');
                        var primaryId = $(x).data('primary-id');

                        var billtype = document.getElementById('billtype'+id).value;

                        if (billtype == 'paid') {

                            $.ajax({
                                type: 'POST',
                                url: "{!! route('bill.Cable.paid') !!}",
                                cache: false,
                                data: {_token: "{{csrf_token()}}", 'id': id,date:date},
                                success: function (data) {

                                    console.log(data);

                                    $.alert({
                                        title: 'Success!',
                                        type: 'green',
                                        content: data,
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-blue',
                                                action: function () {


                                                    table.ajax.reload()




                                                }
                                            }

                                        }
                                    });

                                }
                            });
                        }
                        else if (billtype == 'due') {
                            $.ajax({
                                type: 'POST',
                                url: "{!! route('bill.Cable.due') !!}",
                                cache: false,
                                data: {_token: "{{csrf_token()}}", 'id': id,date:date},
                                success: function (data) {



                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: data,
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-red',
                                                action: function () {


                                                    table.ajax.reload()




                                                }
                                            }

                                        }
                                    });


                                }
                            });

                        }

                        else if(billtype == 'approved'){
                            $.ajax({
                                type: 'POST',
                                url: "{!! route('bill.Cable.approved') !!}",
                                cache: false,
                                data: {_token: "{{csrf_token()}}", 'id': id,date:date,primaryId:primaryId},
                                success: function (data) {

                                    console.log(data);


                                    $.alert({
                                        title: 'Success!',
                                        type: 'green',
                                        content: "Approved",
                                        buttons: {
                                            tryAgain: {
                                                text: 'Ok',
                                                btnClass: 'btn-red',
                                                action: function () {


                                                    table.ajax.reload()




                                                }
                                            }

                                        }
                                    });


                                }
                            });

                        }

                    },
                    cancel: function () {

                        table.ajax.reload()

                    },

                }
            });


        }









    </script>

@endsection