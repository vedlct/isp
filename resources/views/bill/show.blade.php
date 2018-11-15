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
                        <input type="text" class="form-control datepicker" @if(isset($date)) value="{{$date}}" @endif name="selectMonth" onchange="changeDate(this)">
                    </div>


                    <table id="datatable" class="table table-bordered  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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

                        <tbody>
                        @foreach($client as $c)
                        <tr>
                            <td>{{$c->clientFirstName}}</td>
                            <td>{{$c->clientLastName}}</td>
                            <td>{{$c->ip}}</td>
                            <td>{{$c->packageName}}</td>
                            <td>{{$c->bandWide}}</td>
                            <td>{{$c->cprice}}</td>
                            <td>{{$c->address}}</td>
                            <td>


                                <select class="form-control" id="billtype" data-panel-date="{{$date}}" data-panel-id='{{$c->clientId}}' onchange="changebillstatus(this)">
                                    <option  value="paid" @if($bill->where('fkclientId', $c->clientId)->first() == true) selected @else @endif>Paid</option>
                                    <option value="due" @if($bill->where('fkclientId', $c->clientId)->first() == false) selected   @endif>Due</option>
                                </select>
                            </td>

                            <td>
                                <button class="btn btn-info btn-sm" data-panel-date="{{$date}}" data-panel-id="{{$c->clientId}}" onclick="generateBill(this)" ><i class="fa fa-print"></i></button>
                            </td>



                        </tr>
                            @endforeach
                        </tbody>






                    </table>

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
                format: 'yyyy-mm-dd',
                autoclose:true,
                minViewMode: 1,

            });

            $('#datatable').DataTable({
                    responsive: true,
                    deferRender: true,

            }
            );
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
            var id = $(x).data('panel-id');
            var date = $(x).data('panel-date');
            var billtype = document.getElementById('billtype').value;

            if (billtype == 'paid') {

                $.ajax({
                    type: 'POST',
                    url: "{!! route('bill.paid') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}", 'id': id,date:date},
                    success: function (data) {

                    }
                });
            }
            else {
                $.ajax({
                    type: 'POST',
                    url: "{!! route('bill.due') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}", 'id': id,date:date},
                    success: function (data) {
                        alert(data);
                        //  $("#datatable").reload();
                        location.reload();
                        // alert(data);
                        // console.log(data);

                    }
                });

            }
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