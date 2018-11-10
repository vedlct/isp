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

    <div class="row">

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">All Clients</h4>

                    <table id="datatable" class="table table-bordered  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>IP</th>
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
                    { data: 'clientFirstName', name: 'clientFirstName' },
                    { data: 'clientLastName', name: 'clientLastName' },
                    { data: 'email', name: 'email'},
                    { data: 'phone', name: 'phone'},
                    { data: 'ip', name: 'ip'},
                    { data: 'bandWide', name: 'bandWide'},
                    { data: 'price', name: 'price'},
                    { data: 'address', name: 'address'},
                    { "data": function(data){

                            return '<a class="btn btn-default btn-sm" data-panel-id="'+data.clientId+'" onclick="editClient(this)"><i class="fa fa-edit"></i></a>'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                ]
            });
        } );


        function editClient(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("client.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;

        }
    </script>

@endsection