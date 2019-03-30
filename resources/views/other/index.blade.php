@extends('layouts.mainLayout')

@section('css')


    <!-- DataTables -->
    <link href="{{url('public/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('public/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    {{--Edit Modal --}}
    <div class="block-body text-center">
        <!-- Modal-->
        <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    {{--<div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Edit Person</strong>--}}
                        {{--<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>--}}
                    {{--</div>--}}
                    <div class="modal-header">
                        Edit Other
                    </div>
                    <div class="modal-body" id="updateModalBody">

                    </div>
                </div>
            </div>
        </div>
    </div>


     {{--Insert Modal--}}
     <div class="block-body text-center">
         <!-- Modal-->
         <div id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
             <div role="document" class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         Insert Other
                     </div>
                     <div class="modal-body" id="insertModalBody">

                     </div>
                 </div>
             </div>
         </div>
     </div>


    <div class="container-fluid">


        <div class="card">

            <div class="card-header">
                <div class="row">
                    <h4 class="col-10">Others</h4>
                    <div class="col-2">
                        <button class="float-right btn btn-success" onclick="openInsertModal()">Add Other</button>
                    </div>
                </div>

            </div>

            <div class="card-body">

                <table id="datatable" class="table table-bordered  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>


                    <tbody></tbody>

                </table>
            </div>
        </div>


    </div>

@endsection

@section('js')

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('public/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>

    <script>

        // view shop details
        function openInsertModal() {
            $.ajax({
                type: 'POST',
                url: "{!! route('create.other') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    // 'id': id
                },
                success: function (data) {
                    $('#insertModalBody').html(data);
                    $('#insertModal').modal();
                }
            });
        }

        // Edit Other
        function editOther(x) {
            var id = $(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "{!! route('other.edit') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {
                    $("#updateModalBody").html(data);
                    $('#editModal').modal();
                }
            });
        }

        // Delete Other
        function deleteOther(x) {
            var id = $(x).data('panel-id');

            $.confirm({
                theme: 'dark',
                title: 'Confirm!',
                content: 'Are you sure want to delete?',
                buttons: {
                    // send request
                    confirm: function () {
                        $.ajax({
                            type: 'POST',
                            url: "{!! route('other.confirm.delete') !!}",
                            cache: false,
                            data: {
                                _token: "{{csrf_token()}}",
                                'id': id
                            },
                            success: function (data) {
                                location.reload();
                            }
                        });
                    },
                    // cancel request
                    cancel: function () {

                    }
                }
            });


        }

        $(document).ready( function () {

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('other.getdata') !!}",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"},
                },
                columns: [
                    { data: 'title', name: 'other.title' },
                    { data: 'amount', name: 'other.amount'},
                    { data: 'type', name: 'other.type'},

                    { "data": function(data){

                            return '<a class="btn btn-success btn-sm mr-2"  data-panel-id="'+data.id+'" onclick="editOther(this)"><i class="fa fa-edit"></i></a>'+
                                '<a class="btn btn-danger btn-sm"  data-panel-id="'+data.id+'" onclick="deleteOther(this)"><i class="fa fa-trash"></i></a>'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                ]
            });

        } );

    </script>
@endsection