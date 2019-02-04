@extends('layouts.mainLayout')
@section('css')
    <!-- DataTables -->


    <link href="{{url('public/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('public/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="NewSmsConfigModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b><h4 class="modal-title dark profile-title" id="myModalLabel">Create SMS Configuration</h4></b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                </div>

                <div class="modal-body">

                    <form action="{{route('sms.addConfig')}}" method="post">
                        {{csrf_field()}}


                        <div class="form-group">

                            <label for="">User Name<span style="color: red">*</span></label>

                            <input class="form-control" maxlength="255" name="useName" required type="text">

                        </div>

                        <div class="form-group">

                            <label for="">Password<span style="color: red">*</span></label>

                            <input class="form-control" name="password" required type="password">

                        </div>
                        <div class="form-group">

                            <label for="">Brand Name<span style="color: red">*</span></label>

                            <input class="form-control" maxlength="11" name="brandName" required type="text">

                        </div>
                        <div class="form-group">

                            <label for="">Rate<span style="color: red">*</span></label>

                            <input class="form-control" maxlength="20" name="sms_rate" required type="text">

                        </div>

                        <div class="form-group">

                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>

                    </form>

                </div>



            </div>
        </div>
    </div>



    <div class="modal" id="editModalAgreement">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Agreement Question</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div  id="editModalBodyAgreement">

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid">



            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <div class="card-header">
                        <div class="row">
                        <div class="col-md-6" align="left">
                        <h4>Sms Configuration</h4>
                        </div>
                            @if(empty($smsConfig))
                        <div class="col-md-6" align="right">
                            <a onclick="addnewSmsConfig()" href="#"> <button class="btn btn-info">Add New</button></a>
                        </div>
                            @endif
                        </div>
                    </div>

                <div class="card-body">

                    <div class="table table-responsive">
                        <table id="agreementtable" class="table table-striped table-bordered" >
                            <thead>
                            <tr>


                                <th>User Name</th>
                                {{--<th>Password</th>--}}
                                <th>BrandName</th>
                                <th>rate</th>
                                <th width="30%">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(!empty($smsConfig))
                                <tr>

                                    <td width="40%">{{$smsConfig->userName}}</td>
                                    {{--<td width="20">{{$smsConfig->password}}</td>--}}
                                    <td width="20">{{$smsConfig->brandName}}</td>
                                    <td width="20">{{$smsConfig->sms_rate}}</td>



                                    <td width="10%"><button class="btn btn-sm btn-success" data-panel-id="{{$smsConfig->id}}" onclick="editSmsConfig(this)">Edit</button>
                                    </td>

                                </tr>

                            @endif





                            </tbody>

                        </table>
                    </div>
                    <br>


                </div>

            </div>

    </div> <!-- end container-fluid -->



@endsection
@section('js')
    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    {{--<script src="{{url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>--}}
    {{--<script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>--}}
    <script src="{{url('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <script>
        $(function () {
            $('#agreementtable').DataTable(
                {


                }
            );
        });

        function addnewSmsConfig() {

            $('#NewSmsConfigModal').modal({show:true});

        }
        function editSmsConfig(x) {
            var id=$(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "{!! route('sms.editSmsConfig') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {
//                    console.log(data);
                    $('#editModalBodyAgreement').html(data);
                    $('#editModalAgreement').modal();
                }
            });


        }
    </script>


@endsection