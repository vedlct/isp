

    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">




                    <div class="table table-responsive">
                        <form action="{{route('bill.Internet.updateBillPay')}}" method="post">
                            {{csrf_field()}}
                        <table id="manageapplication1" class="table table-striped table-bordered" style="width:100%" >
                            <thead>
                            <tr style="text-align: center">

                                <th>Month</th>
                                <th>Due</th>
                                <th>Discount</th>
                                <th>Amount</th>



                            </tr>
                            </thead>

                            <tfoot>
                            <tr>

                                <th colspan="4"><button id="test321"  class="btn btn-sm btn-success pull-right">
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
                    "url": "{!! route('bill.internet.show.withData')!!}",
                    "type": "POST",
                    data:function (d){

                        d._token="{{csrf_token()}}";

                        d.pastDueClient='{{$clientId}}';




                    },
                },
                columns: [


                    { data: 'billdate', name: 'internet_bill.billdate', "orderable": true, "searchable":true },
                    { data: 'billprice', name: 'internet_bill.price', "orderable": true, "searchable":true },
//                    { data: 'address', name: 'client.address', "orderable": true, "searchable":true },

                    { "data": function(data){
                        return '<input type="hidden" class="form-control" id="rowid" name="rowid[]" value="'+data.internetBillId+'">' +
                            '<input type="text"class="form-control" id="discount" name="discount[]" value="">'
                            ;},
                        "orderable": false, "searchable":false
                    },
                    { "data": function(data){
                        return '<input type="text"class="form-control date" id="amount" name="amount[]" value="">'
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









    </script>

