

<div class="row">

    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">




                <div class="table table-responsive">
                    <form action="{{route('bill.cable.updateBillPay')}}" method="post">
                        {{csrf_field()}}
                        <table id="manageapplication1" class="table table-striped table-bordered" style="width:100%" >
                            <thead>
                            <tr style="text-align: center">

                                <th>Month</th>
                                <th>Total Bill</th>
                                <th>Total Paid</th>
                                <th>Due</th>
                                <th>Discount</th>
                                <th>Amount(Full/Partial)</th>



                            </tr>
                            </thead>

                            <tfoot>
                            <tr>

                                <th colspan="6"><button id="test321"  class="btn btn-sm btn-success pull-right">
                                        Submit
                                    </button>
                                </th>
                            </tr>
                            </tfoot>

                        </table>


                    </form>
                </div>


            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->





<script>

    $(document).ready( function () {


        table = $('#manageapplication1').DataTable({
            processing: true,
            serverSide: false,
            stateSave: true,
            "lengthMenu": [[12, 25, 50,100, -1], [12, 25, 50,100, "All"]],

            "ajax":{
                "url": "{!! route('bill.cable.show.withData')!!}",
                "type": "POST",
                data:function (d){

                    d._token="{{csrf_token()}}";

                    d.pastDueClient='{{$clientId}}';




                },
            },
            columns: [


                { data: 'billdate', name: 'cable_bill.billdate', "orderable": true, "searchable":true },
                { data: 'billprice', name: 'cable_bill.price', "orderable": true, "searchable":true },

                { "data": function(data){
                    if (data.partial !=null){
                        return data.partial+"="+totalPaid(data.partial);
                    }else {
                        return data.partial;
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
                            if (data.discount != null) {
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

//                    { data: 'billprice', name: 'internet_bill.price', "orderable": true, "searchable":true },
//                    { data: 'address', name: 'client.address', "orderable": true, "searchable":true },

//                    { "data": function(data){
//                        if (data.discount != null){
//
//                            return '<input type="hidden" class="form-control" id="rowid" name="rowid[]" value="'+data.internetBillId+'">' +
//                                '<input type="text"class="form-control" id="discount" name="discount[]" value="'+data.discount+'">'
//                                ;
//
//                        }else {
//                            return '<input type="hidden" class="form-control" id="rowid" name="rowid[]" value="'+data.internetBillId+'">' +
//                                '<input type="text"class="form-control" id="discount" name="discount[]" value="">'
//                                ;
//                        }
//                        },
//                        "orderable": false, "searchable":false
//                    },
                { "data": function(data){

                    return '<input type="hidden" class="form-control" id="rowid" name="rowid[]" value="'+data.cableBillId+'">' +
                        '<input type="number" class="form-control" id="discount" name="discount[]" value="">'
                        ;

                },
                    "orderable": false, "searchable":false
                },
//                    { "data": function(data){
//
//                        if (data.partial != null){
//
//                            return '<input type="text"class="form-control date" id="amount" name="amount[]" value="'+data.partial+'">'
//                                ;
//
//                        }else {
//                            return '<input type="text"class="form-control date" id="amount" name="amount[]" value="">'
//                                ;
//                        }
//                        },
//                        "orderable": false, "searchable":false
//                    },
                { "data": function(data){


                    return '<input type="number" class="form-control date" id="amount" name="amount[]" value="">'
                        ;

                },
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

