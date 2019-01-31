@extends('layouts.mainLayout')
@section('css')


    <!-- DataTables -->
    <link href="{{url('public/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('public/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    <!-- end page title end breadcrumb -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Client</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="{{route('client.insert')}}">
                        {{csrf_field()}}

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>First Name</label>
                                <input type="text" name="clientFirstName" placeholder="First Name" class="form-control" >
                            </div>
                            <div class="form-group col-md-12">
                                <label>Last Name</label>
                                <input type="text" name="clientLastName" placeholder="Last Name" class="form-control" >
                            </div>
                            <div class="form-group col-md-12">
                                <label>email</label>
                                <input type="email" name="email" placeholder="Email" class="form-control" >
                            </div>
                            <div class="form-group col-md-12">
                                <label>phone</label>
                                <input type="text" name="phone" placeholder="phone" class="form-control" >
                            </div>
                            <div class="form-group col-md-12">
                                <label>ip</label>
                                <input type="text" name="ip" placeholder="ip" class="form-control" >
                            </div>
                            <div class="form-group col-md-12">
                                <label>Internet Package</label>
                               <select class="form-control" id="package" onchange="getpackage()" name="package">
                                   <option>Select a Package</option>
                                   @foreach($package as  $p)
                                       <option value="{{$p->packageId}}">{{$p->packageName}}</option>
                                       @endforeach
                               </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Cable Package</label>
                                <select class="form-control" id="cablepackage" onchange="getcablepackage()" name="package">
                                    <option value="Select a Package">Select a Package</option>
                                    @foreach($cablepackage as  $c)
                                        <option value="{{$c->cablepackageId}}">{{$c->cablepackageName}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{--@if($package->where('packageName', 'test')->first()){{$package->where('packageName', 'test')->first()->packageName}}@endif--}}
                            <div class="form-group col-md-12">
                                <label>bandWidth</label>
                                <input type="text" name="bandwidth" id="bandwidth" placeholder="bandwidth" class="form-control" >
                            </div>
                            <div class="form-group col-md-12">
                                <label>Price</label>
                                <input type="text" name="price" id="price" placeholder="price" class="form-control" >
                            </div>
                            <div class="form-group col-md-12">
                                <label>address</label>
                                <input type="text" name="address"  placeholder="address" class="form-control" >
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-success pull-right">submit</button>
                            </div>

                        </div>


                    </form>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>
    <!-- The Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Package</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="editModalBody">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <div class="text-right mb-2 mr-2">
                        <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal">
                            Add Client
                        </button>
                    </div>
                    <h4 class="mt-0 header-title">All Clients</h4>

                    <table id="datatable" class="table table-bordered  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>IP</th>
                            <th>Package Name</th>
                            <th>BandWide</th>
                            <th>Price</th>
                            <th>Address</th>

                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

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
    <script>
        $(document).ready( function () {

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('client.getdata') !!}",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"},
                },
                columns: [
                    { data: 'clientFirstName', name: 'internet_client.clientFirstName' },
                    { data: 'clientLastName', name: 'internet_client.clientLastName' },
                    { data: 'email', name: 'internet_client.email'},
                    { data: 'phone', name: 'internet_client.phone'},
                    { data: 'ip', name: 'internet_client.ip'},
                    { data: 'packageName', name: 'package.packageName'},
                    { data: 'bandWide', name: 'internet_client.bandWide'},
                    { data: 'price', name: 'internet_client.price'},
                    { data: 'address', name: 'internet_client.address'},
                    { "data": function(data){

                            return '<a class="btn btn-default btn-sm"  data-panel-id="'+data.clientId+'" onclick="editClient(this)"><i class="fa fa-edit"></i></a>'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                ]
            });
        } );


        function editClient(x) {
            var id=$(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "{!! route('client.edit') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {
                    $("#editModalBody").html(data);
                    $('#editModal').modal();
                    // console.log(data);
                }
            });
        }


        function getpackage() {
            var id=document.getElementById('package').value;

            $.ajax({
                type: 'POST',
                url: "{!! route('package.getpackage') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {
                    // $("#editModalBody").html(data);
                    // $('#editModal').modal();
                    // console.log(data);
                 //   $('bandwidth').val(data.bandwidth);
                  //  $('price').val(data.price);

                    document.getElementById('bandwidth').value = data.bandwidth;
                    document.getElementById('price').value = data.price;
                    document.getElementById('cablepackage').value = "Select a Package";

                }
            });
        }

        function getcablepackage() {
            var id=document.getElementById('package').value;

            $.ajax({
                type: 'POST',
                url: "{!! route('package.cable.getpackage') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {
                    // $("#editModalBody").html(data);
                    // $('#editModal').modal();
                    // console.log(data);
                 //   $('bandwidth').val(data.bandwidth);
                  //  $('price').val(data.price);

                    var price = document.getElementById('price').value ;

                    document.getElementById('price').value =   parseFloat(price) + parseFloat(data.price);

                }
            });
        }
    </script>

@endsection