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

    </style>

@endsection

@section('content')


    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">All Bill</h4>
                    <div class="form-group col-md-3">
                        <label>Select Month</label>{{$internetClient}}
                        <input type="text" id="billMonth" class="form-control datepicker" @if(isset($date)) value="{{$date}}" @endif name="selectMonth" onchange="changeDate(this)">
                    </div>
                    <div class="form-group col-md-3">
                        <div id="loding" class="lds-facebook"><div></div><div></div><div></div></div>
                        <button id="generateBill" style="display: none" class="btn-info" name="generateBill">Genarate bill</button>
                    </div>

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



                    { "data": function(data){

                    if (data.billStatus=='np'){
                        return '<select style="background-color:red;color:white"class="form-control" id="billtype'+data.fkclientId+'" data-panel-date="{{$date}}" data-panel-id="'+data.fkclientId+'" onchange="changebillstatus(this)">'+
                        '<option  value="paid"  >Paid</option>'+
                        '<option value="due" selected  >Due</option>'+
                        '</select>';
                    }else if (data.billStatus=='p'){
                        return '<select  style="background-color:green;color:white"class="form-control" id="billtype'+data.fkclientId+'" data-panel-date="{{$date}}" data-panel-id="'+data.fkclientId+'" onchange="changebillstatus(this)">'+
                            '<option  value="paid" selected  >Paid</option>'+
                            '<option value="due"   >Due</option>'+
                            '</select>';
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

            let url = "{{ route('bill.invoice',[':id',':date']) }}";

            // url = url.replace([':id',':date'], id,date);
            url = url.replace(':date', date);
            url = url.replace(':id', id);
            //
            // document.location.href=url;

            window.open(url,'_blank')

        }
        function changeDate(x) {
            var date=$(x).val();

            // alert(date);
            let url = "{{ route('bill.show.date', ':date') }}";
            url = url.replace(':date', date);
            document.location.href=url;

        }

        function changebillstatus(x) {

            $.confirm({
                title: 'Confirm!',
                content: 'Are You Sure!',
                buttons: {
                    confirm: function () {
                        var id = $(x).data('panel-id');
                        var date = $(x).data('panel-date');

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


                                                    location.reload();




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
                                url: "{!! route('bill.due') !!}",
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


                                                    location.reload();




                                                }
                                            }

                                        }
                                    });


                                }
                            });

                        }

                    },
                    cancel: function () {

                        location.reload();

                    },

                }
            });


        }


            function editClient(x) {
                var id = $(x).data('panel-id');

                $.ajax({
                    type: 'POST',
                    url: "{!! route('client.edit') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}", 'id': id},
                    success: function (data) {
                        $("#editModalBody").html(data);
                        $('#editModal').modal();
                        // console.log(data);
                    }
                });
            }


            function getpackage() {
                var id = document.getElementById('package').value;

                $.ajax({
                    type: 'POST',
                    url: "{!! route('package.getpackage') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}", 'id': id},
                    success: function (data) {
                        // $("#editModalBody").html(data);
                        // $('#editModal').modal();
                        // console.log(data);
                        //   $('bandwidth').val(data.bandwidth);
                        //  $('price').val(data.price);

                        document.getElementById('bandwidth').value = data.bandwidth;
                        document.getElementById('price').value = data.price;

                    }
                });
            }



    </script>

@endsection