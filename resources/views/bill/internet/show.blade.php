@extends('layouts.mainLayout')
@section('css')

    <!-- DataTables -->
    <link href="{{url('public/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('public/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .lds-facebook {
            display: inline-block;
            position: relative;
            width: 64px;
            height: 37px;
        }
        .lds-facebook div {
            display: inline-block;
            position: absolute;
            left: 6px;
            width: 13px;
            background: #99ff48;
            animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }
        .lds-facebook div:nth-child(1) {
            left: 6px;
            animation-delay: -0.24s;
        }
        .lds-facebook div:nth-child(2) {
            left: 26px;
            animation-delay: -0.12s;
        }
        .lds-facebook div:nth-child(3) {
            left: 45px;
            animation-delay: 0;
        }
        @keyframes lds-facebook {
            0% {
                top: 6px;
                height: 51px;
            }
            50%, 100% {
                top: 19px;
                height: 26px;
            }
        }

        .blinking{
            animation:blinkingText 2s infinite;
        }
        @keyframes blinkingText{
            0%{		color: red;	}
            49%{	color: transparent;	}
            50%{	color: transparent;	}
            99%{	color:transparent;	}
            100%{	color: #000;	}
        }

    </style>

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
                    <div align="right" class="col-md-8">
                        @if( $json !== "")
                            <h5><span class="blinking"><i class="fa fa-circle"></i></span>{{$json}}</h5>
                        @endif

                    </div>
                    </div>
                    <br>

                    <div class="row">
                    <div class="col-md-3">
                        <div id="loding" class="lds-facebook"><div></div><div></div><div></div></div>
                        <button id="generateBill" style="display: none" class="btn btn-info" name="generateBill">Genarate All bill</button>
                    </div>
                    <div class="col-md-3">
                        {{--<button id="sendBillToPaySms" style="" class="btn btn-success" name="sendBillToPaySms">Send Sms To Bill Pay</button>--}}
                        <button id="" style="" class="btn btn-success" name="">Send Sms To Bill Pay</button>
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
                                <th>Package Name</th>
                                <th>BandWidth</th>
                                <th>Price</th>
                                <th>Received By</th>
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
                    "url": "{!! route('bill.internet.show.withData')!!}",
                    "type": "POST",
                    data:function (d){

                        d._token="{{csrf_token()}}";
                        if ($('#billMonth').val()!=""){
                            d.billMonth=$('#billMonth').val();
                        }

                    },
                },
                columns: [


                    { data: 'clientFirstName', name: 'internet_client.clientFirstName',"orderable": false, "searchable":true },
                    { data: 'clientLastName', name: 'internet_client.clientLastName',"orderable": false, "searchable":true },
                    { data: 'phone', name: 'internet_client.phone', "orderable": false, "searchable":true },
                    { data: 'packageName', name: 'package.packageName', "orderable": false, "searchable":true },
                    { data: 'bandWide', name: 'internet_client.bandWide', "orderable": true, "searchable":true },
                    { data: 'billprice', name: 'internet_bill.price', "orderable": true, "searchable":true },

                    { data: 'name', name: 'user.name', "orderable": true, "searchable":true },


                    { "data": function(data){

                    if (data.billStatus=='np'){
                        return '<select style="background-color:red;color:white"class="form-control" id="billtype'+data.fkclientId+'" data-panel-date="{{$date}}" data-panel-id="'+data.fkclientId+'" data-primary-id="'+data.billId+'" onchange="changebillstatus(this)">'+
                        '<option  value="paid"  >Paid</option>'+
                        '<option value="due" selected  >Due</option>'+
                                @if(Auth::user()->fkusertype=='Admin')
                                    '<option value="approved"  >Approved</option>'+
                                @endif
                        '</select>';
                    }else if (data.billStatus=='p'){
                        return '<select  style="background-color:green;color:white"class="form-control" id="billtype'+data.fkclientId+'" data-panel-date="{{$date}}" data-panel-id="'+data.fkclientId+'" data-primary-id="'+data.billId+'" onchange="changebillstatus(this)">'+
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
                        return '<button class="btn btn-info btn-sm" data-panel-date="{{$date}}" data-panel-id="'+data.fkclientId+'" onclick="generateBill(this)" ><i class="fa fa-print"></i></button>'
                            ;},
                        "orderable": false, "searchable":false
                    },


                ],
                "fnDrawCallback": function() {
                    var api = this.api()
                    var json = api.ajax.json();
                    if ('{{$internetClient}}'==json.total){

                        $('#generateBill').show();
                        $('#loding').hide();

                    }


                }
            });



        } );

        function generateBill(x) {
            var id = $(x).data('panel-id');
            var date = $(x).data('panel-date');

            let url = "{{ route('bill.Internet.invoiceByClient',[':id',':date']) }}";


            url = url.replace(':date', date);
            url = url.replace(':id', id);


            window.open(url,'_blank');

        }
        function changeDate(x) {

            {{--var date=$(x).val();--}}

            {{--// alert(date);--}}
            {{--let url = "{{ route('bill.Internet.show.date', ':date') }}";--}}
            {{--url = url.replace(':date', date);--}}
            {{--document.location.href=url;--}}

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
                                url: "{!! route('bill.Internet.paid') !!}",
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


                                                    table.ajax.reload();




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
                                url: "{!! route('bill.Internet.due') !!}",
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


                                                    table.ajax.reload();




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
                                url: "{!! route('bill.internet.approved') !!}",
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


                                                    table.ajax.reload();




                                                }
                                            }

                                        }
                                    });


                                }
                            });

                        }

                    },
                    cancel: function () {

                        table.ajax.reload();

                    },

                }
            });


        }






        $("#generateBill").click(function () {




            let url = "{{ route('bill.Internet.invoice',[':date']) }}";


            url = url.replace(':date', '{{$date}}');

            window.open(url,'_blank')

        });
        $("#sendBillToPaySms").click(function () {


            $.confirm({
                title: 'Confirm!',
                content: 'Are You Sure!',
                buttons: {
                    confirm: function () {



                            $.ajax({
                                type: 'get',
                                url: "{!! route('sms.billToPay.send') !!}",
                                cache: false,
                                data: {_token: "{{csrf_token()}}", },
                                success: function (data) {

                                    console.log(data);

                                    if (data=="400"){

                                        $.alert({
                                            title: 'Success!',
                                            type: 'green',
                                            content: 'Sms Send SuccessFully',
                                            buttons: {
                                                tryAgain: {
                                                    text: 'Ok',
                                                    btnClass: 'btn-blue',
                                                    action: function () {


                                                        table.ajax.reload();



                                                    }
                                                }

                                            }
                                        });

                                    }
                                    else if(data=="400") {

                                        $.alert({
                                            title: 'Alert!',
                                            type: 'red',
                                            content: 'sms Sent cancelled for insufficient balance',
                                            buttons: {
                                                tryAgain: {
                                                    text: 'Ok',
                                                    btnClass: 'btn-red',
                                                    action: function () {


                                                        table.ajax.reload();




                                                    }
                                                }

                                            }
                                        });

                                    }
                                    else if(data=="1") {

                                        $.alert({
                                            title: 'Alert!',
                                            type: 'red',
                                            content: 'You Allready Sent Sms once in this month',
                                            buttons: {
                                                tryAgain: {
                                                    text: 'Ok',
                                                    btnClass: 'btn-red',
                                                    action: function () {


                                                        table.ajax.reload();




                                                    }
                                                }

                                            }
                                        });

                                    }



                                }
                            });

                    },
                    cancel: function () {

                        table.ajax.reload();

                    },

                }
            });


        });



    </script>

@endsection