@extends('layouts.mainLayout')
@section('css')


    <!-- DataTables -->
    <link href="{{url('public/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('public/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    {{--<!-- end page title end breadcrumb -->--}}
    {{--<div class="modal" id="myModal">--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}

                {{--<!-- Modal Header -->--}}
                {{--<div class="modal-header">--}}
                    {{--<h4 class="modal-title">Add Client</h4>--}}
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                {{--</div>--}}

                {{--<!-- Modal body -->--}}
                {{--<div class="modal-body">--}}
                    {{--<form method="post" action="{{route('client.insert')}}">--}}
                        {{--{{csrf_field()}}--}}

                        {{--<div class="row">--}}
                            {{--<div class="form-group col-md-12">--}}
                                {{--<label>First Name</label>--}}
                                {{--<input type="text" name="clientFirstName" placeholder="First Name" class="form-control" >--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-12">--}}
                                {{--<label>Last Name</label>--}}
                                {{--<input type="text" name="clientLastName" placeholder="Last Name" class="form-control" >--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-12">--}}
                                {{--<label>email</label>--}}
                                {{--<input type="email" name="email" placeholder="Email" class="form-control" >--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-12">--}}
                                {{--<label>phone</label>--}}
                                {{--<input type="text" name="phone" placeholder="phone" class="form-control" >--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-12">--}}
                                {{--<label>ip</label>--}}
                                {{--<input type="text" name="ip" placeholder="ip" class="form-control" >--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-12">--}}
                                {{--<label>Package</label>--}}
                                {{--<select class="form-control" id="package" onchange="getpackage()">--}}
                                    {{--<option>Select a Package</option>--}}
                                    {{--@foreach($package as  $p)--}}
                                        {{--<option value="{{$p->packageId}}">{{$p->packageName}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}

                            {{--<div class="form-group col-md-12">--}}
                                {{--<label>bandWidth</label>--}}
                                {{--<input type="text" name="bandwidth" id="bandwidth" placeholder="bandwidth" class="form-control" >--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-12">--}}
                                {{--<label>Price</label>--}}
                                {{--<input type="text" name="price" id="price" placeholder="price" class="form-control" >--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-12">--}}
                                {{--<label>address</label>--}}
                                {{--<input type="text" name="address"  placeholder="address" class="form-control" >--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-12">--}}
                                {{--<button class="btn btn-success pull-right">submit</button>--}}
                            {{--</div>--}}

                        {{--</div>--}}


                    {{--</form>--}}

                {{--</div>--}}

                {{--<!-- Modal footer -->--}}
                {{--<div class="modal-footer">--}}

                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<!-- The Edit Modal -->--}}
    {{--<div class="modal" id="editModal">--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}

                {{--<!-- Modal Header -->--}}
                {{--<div class="modal-header">--}}
                    {{--<h4 class="modal-title">Update Package</h4>--}}
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                {{--</div>--}}

                {{--<!-- Modal body -->--}}
                {{--<div class="modal-body" id="editModalBody">--}}

                {{--</div>--}}

                {{--<!-- Modal footer -->--}}
                {{--<div class="modal-footer">--}}

                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">All Bill</h4>
                    <div class="form-group col-md-3">
                        <label>Select Month</label>
                        <input type="text" id="billMonth" class="form-control datepicker" @if(isset($date)) value="{{$date}}" @endif name="selectMonth" onchange="changeDate(this)">
                    </div>

                    <div class="table table-responsive">
                        <table id="manageapplication" class="table table-striped table-bordered" style="width:100%" >
                            <thead>
                            <tr>

                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>IP</th>
                                <th>Package Name</th>
                                <th>BandWide</th>
                                <th>Price</th>
                                <th>Address</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
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
                    "url": "{!! route('bill.show.withData')!!}",
                    "type": "POST",
                    data:function (d){

                        d._token="{{csrf_token()}}";
                        if ($('#billMonth').val()!=""){
                            d.billMonth=$('#billMonth').val();
                        }


                    },
                },
                columns: [


                    { data: 'clientFirstName', name: 'client.clientFirstName',"orderable": false, "searchable":true },
                    { data: 'clientLastName', name: 'client.clientLastName',"orderable": false, "searchable":true },
                    { data: 'ip', name: 'client.ip', "orderable": false, "searchable":true },
                    { data: 'packageName', name: 'bill.packageName', "orderable": false, "searchable":true },
                    { data: 'bandWide', name: 'client.bandWide', "orderable": true, "searchable":true },
                    { data: 'cprice', name: 'client.cprice', "orderable": true, "searchable":true },
                    { data: 'address', name: 'client.address', "orderable": true, "searchable":true },


                    { "data": function(data){

                    if (data.billStatus=='np'){
                        return '<select class="form-control" id="billtype'+data.clientId+'" data-panel-date="{{$date}}" data-panel-id="'+data.clientId+'" onchange="changebillstatus(this)">'+
                        '<option  value="paid"  >Paid</option>'+
                        '<option value="due" selected  >Due</option>'+
                        '</select>';
                    }else if (data.billStatus=='p'){
                        return '<select class="form-control" id="billtype'+data.clientId+'" data-panel-date="{{$date}}" data-panel-id="'+data.clientId+'" onchange="changebillstatus(this)">'+
                            '<option  value="paid" selected  >Paid</option>'+
                            '<option value="due"   >Due</option>'+
                            '</select>';
                    }
                    ;},
                        "orderable": false, "searchable":false
                    },
                    { "data": function(data){
                        return '<button class="btn btn-info btn-sm" data-panel-date="{{$date}}" data-panel-id="'+data.clientId+'" onclick="generateBill(this)" ><i class="fa fa-print"></i></button>'
                            ;},
                        "orderable": false, "searchable":false
                    },


                ],
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
                                url: "{!! route('bill.paid') !!}",
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