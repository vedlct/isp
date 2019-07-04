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

                    <div class="row">
                        <div class="col-md-3">
                            <label>Select Month</label>
                            <input type="text" id="billMonth" class="form-control datepicker" @if(isset($date)) value="{{$date}}" @endif name="selectMonth" onchange="changeDate(this)">
                        </div>



                        <div class="col-md-3">
                            <label>Select Employee</label>
                            <select class="form-control" onchange="reloadTable()" id="emp">
                                <option value="">Select Employee</option>
                                @foreach($users as $user)
                                    <option value="{{$user->name}}">{{$user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Select Status</label>
                            <select class="form-control" onchange="reloadTable()" id="statusId">
                                <option value="">Select Status</option>
                                <option value="np">Not Paid</option>
                                <option value="p">Paid</option>
                                <option value="ap">Approved</option>
                            </select>
                        </div>


                        <div align="right" class="col-md-8">
                            @if( $json !== "")
                                <h5><span class="blinking"><i class="fa fa-circle"></i></span>{{$json}}</h5>
                            @endif

                        </div>
                    </div>
                    <br>



                    <div class="row">
                        {{--<div class="col-md-3">--}}
                        {{--<div id="loding" class="lds-facebook"><div></div><div></div><div></div></div>--}}
                        {{--<button id="generateAllBill" style="display: none" class="btn-info" name="generateBill">Genarate All bill</button>--}}
                        {{--</div>--}}
                        <div class="col-md-3">
                            <button id="sendBillSms" style="" class="btn btn-success" name="sendBillSms">Send Sms To Bill Pay(1st {{date('M')}})</button>
                            {{--<button id="" style="" class="btn btn-success" name="">Send Sms To Bill Pay</button>--}}
                        </div>
                        <div class="col-md-3">
                            <button id="sendBillToPaySms" style="" class="btn btn-success" name="sendBillToPaySms">Send Sms To Bill Pay(7th {{date('M')}})</button>
                        </div>
                    </div>

                    <div class="table table-responsive">
                        <table id="manageapplication" class="table table-striped table-bordered" style="width:100%" >
                            <thead>
                            <tr>

                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Client Id</th>
                                <th>Phone</th>
                                {{--<th>Package Name</th>--}}
                                <th>Received By</th>

                                <th>Discount</th>
                                <th>Due</th>
                                <th>Received Ammount</th>

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
                    "url": "{!! route('bill.cable.show.withData')!!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        if ($('#billMonth').val()!=""){
                            d.billMonth=$('#billMonth').val();
                        }
                        d.emp=$('#emp').val();
                        d.statusId=$('#statusId').val();
                    },
                },
                columns: [
                    { data: 'clientFirstName', name: 'cable_client.clientFirstName',"orderable": false, "searchable":true },
                    { data: 'clientLastName', name: 'cable_client.clientLastName',"orderable": false, "searchable":true },
                    { data: 'clientSerial', name: 'cable_client.clientSerial',"orderable": true, "searchable":true },
                    { data: 'phone', name: 'cable_client.phone', "orderable": false, "searchable":true },
                    { data: 'name', name: 'user.name', "orderable": true, "searchable":true },
                    { "data": function(data){
                            if (data.discount != null){
                                return data.discount+"="+totalPaid(data.discount);
                            }else {
                                return data.discount;
                            }
                        },
                        "orderable": false, "searchable":false
                    },
                    { "data": function(data){
                            if(data.billprice != null) {
                                if (data.partial != null) {
                                    if (data.discount != null){

                                        return (data.billprice) + "-" + (data.partial) +"-" + (data.discount) + "=" + totalDue(data.billprice,data.discount, data.partial);

                                    }else {
                                        return (data.billprice) + "-" + (data.partial) +"-" + (0) + "=" + totalDue(data.billprice,null, data.partial);
                                    }

                                } else {
                                    return data.billprice;
                                }
                            }else {
                                if (data.partial != null) {
                                    if (data.discount != null){
                                        return (0) + "-" + (data.partial) +"-" + (data.discount) + "=" + totalDue(0,data.discount, data.partial);
                                    }else {
                                        return (0) + "-" + (data.partial) +"-" + (0) + "=" + totalDue(0,null, data.partial);
                                    }

                                } else {
                                    return data.billprice;
                                }
                            }
                        },
                        "orderable": false, "searchable":false
                    },
                    { "data": function(data){
                            if (data.partial !=null){
                                return data.partial+"="+totalPaid(data.partial);
                            }else {
                                return data.partial;
                            }
                        },
                        "orderable": false, "searchable":false
                    },
                    { data: 'billprice', name: 'cable_bill.price', "orderable": true, "searchable":true },
                    { "data": function(data){
                            if (data.billStatus=='np'){
                                return '<select style="background-color:red;color:white"class="form-control" id="billtype'+data.billId+'" data-panel-date="{{$date}}" data-panel-id="'+data.fkclientId+'" data-primary-id="'+data.billId+'" onchange="changebillstatus(this)">'+
                                    '<option  value="paid"  >Paid</option>'+
                                    '<option value="due" selected  >Due</option>'+
                                        @if(Auth::user()->fkusertype=='Admin')
                                            '<option value="approved"  >Approved</option>'+
                                        @endif
                                            '</select>'+
                                    '<button class="btn btn-smbtn-info" onclick="payBill('+data.fkclientId+')"><i class="fa fa-money"></i></button>'
                                    ;
                            }else if (data.billStatus=='p'){
                                return '<select  style="background-color:green;color:white"class="form-control" id="billtype'+data.billId+'" data-panel-date="{{$date}}" data-panel-id="'+data.fkclientId+'" data-primary-id="'+data.billId+'" onchange="changebillstatus(this)">'+
                                    '<option  value="paid" selected  >Paid</option>'+
                                    '<option value="due"   >Due</option>'+
                                        @if(Auth::user()->fkusertype=='Admin')
                                            '<option value="approved"  >Approved</option>'+
                                        @endif
                                            '</select>'+
                                    '<button class="btn btn-smbtn-info" onclick="payBill('+data.fkclientId+')"><i class="fa fa-money"></i></button>'
                                    ;
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
                {{--"fnDrawCallback": function() {--}}
                {{--var api = this.api()--}}
                {{--var json = api.ajax.json();--}}
                {{--if ('{{$cableClient}}'==json.total){--}}
                {{--$('#generateAllBill').show();--}}
                {{--$('#loding').hide();--}}
                {{--}--}}
                {{--}--}}
            });
        } );
        function generateBill(x) {
            var id = $(x).data('panel-id');
            var date = $(x).data('panel-date');
            let url = "{{ route('bill.Cable.invoiceByClient',[':id',':date']) }}";
            url = url.replace(':date', date);
            url = url.replace(':id', id);
            window.open(url,'_blank');
        }
        function changeDate(x) {
            table.ajax.reload();
        }
        function payBill(x) {
            $.ajax({
                type: 'POST',
                url: "{!! route('bill.Cable.pastDueMonthForClient') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}", 'clientId': x},
                success: function (data) {
                    //console.log(data);
                    $('.modal-body').html(data);
                    $('#myModalLabel').html("test");
                    $('#myModal').modal({show: true});
                },
            });
        }
        function changebillstatus(x) {
           // console.log(x);
            $.confirm({
                title: 'Confirm!',
                content: 'Are You Sure!',
                buttons: {
                    confirm: function () {
                        var id = $(x).data('primary-id');
                        var primaryId = $(x).data('primary-id');
                        var date = $(x).data('panel-date');
                        var billtype = document.getElementById('billtype'+id).value;
                        if (billtype == 'paid') {
                            $.ajax({
                                type: 'POST',
                                url: "{!! route('bill.Cable.paid') !!}",
                                cache: false,
                                data: {_token: "{{csrf_token()}}", 'id': id,date:date},
                                success: function (data) {


                                   // console.log(data);

                                    $.alert({
                                        title: 'Success!',
                                        type: 'green',
                                        content: data.message,
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
                                                    location.reload();
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
        $("#generateAllBill").click(function () {
            let url = "{{ route('bill.Cable.invoice',[':date']) }}";
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
                            url: "{!! route('sms.cablebillToPay.send') !!}",
                            cache: false,
                            data: {_token: "{{csrf_token()}}",type:"sendBillToPaySms" },
                            success: function (data) {
                                // console.log(data);
                                if (data.substr(0,3) == "404" || data.substr(0,3)=="405"){
                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: 'Wrong User Name or password of Sms Config',
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
                                else if (data.substr(0,3)=="407"){
                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: 'Wrong Brand Name of Sms Config',
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
                                }else if (data=="409"){
                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: "sms Sent cancelled for insufficient balance",
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
                                else if (data=="400"){
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
        $("#sendBillSms").click(function () {
            $.confirm({
                title: 'Confirm!',
                content: 'Are You Sure!',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: 'get',
                            url: "{!! route('sms.sendCableBillSms.send') !!}",
                            cache: false,
                            data: {_token: "{{csrf_token()}}",type:"sendBillSms"},
                            success: function (data) {
                                console.log(data);
                                if (data == "404 - Wrong Username" || data=="405 - Wrong Password"){
                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: 'Wrong User Name or password of Sms Config',
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
                                else if (data=="407 - Wrong Brandname Given"){
                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: 'Wrong Brand Name of Sms Config',
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
                                }else if (data=="409"){
                                    $.alert({
                                        title: 'Alert!',
                                        type: 'red',
                                        content: "sms Sent cancelled for insufficient balance",
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
                                else if (data=="400"){
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
        function reloadTable() {
            table.ajax.reload();
        }
        function totalPaid(amount) {
            sumofnums = 0;
            nums = amount.split("+");
            for (i = 0; i < nums.length; i++) {
                sumofnums += parseInt(nums[i]);
            }
            return sumofnums;
        }
        function totalDue(amountdue,amountdiscount,amountpaid) {
            sumofnums = 0;
            sumoft = 0;
            nums = amountpaid.split("+");
            for (i = 0; i < nums.length; i++) {
                sumofnums += parseInt(nums[i]);
            }
            if (amountdue != null){
                total=parseInt(parseInt(amountdue)-sumofnums);
            }else {
                total=parseInt(parseInt(0)-sumofnums);
            }
            if (amountdiscount != null){
                t = amountdiscount.split("+");
                for (i = 0; i < t.length; i++) {
                    sumoft += parseInt(t[i]);
                }
            }else {
                sumoft=parseInt(0);
            }


            total=parseInt(total-sumoft);
            return total;
        }
    </script>

@endsection