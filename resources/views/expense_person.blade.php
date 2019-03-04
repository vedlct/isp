@extends('layouts.mainLayout')
@section('content')


    {{-- Edit Modal --}}
    <div class="block-body text-center">
        <!-- Modal-->
        <div id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Edit Person</strong>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body" id="modalBody2">

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Person</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('person.insert')}}">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label>Person Name</label>
                                <input type="text" class="form-control" placeholder="person name" name="name" required>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success">Insert</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Person List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($person as $key => $p)
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td>{{ $p->name }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-person-id= {{ $p->id }} onclick="openEditModal(this)" > <i class="fa fa-pencil-square"></i> </button>
                                        {{--<button class="btn btn-danger btn-sm" data-person-id= {{ $p->id }} onclick="deletePermanent(this)" > <i class="fa fa-trash"></i> </button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script>

        // update person details
        function openEditModal(x) {
            id = $(x).data('person-id');
            console.log(id);

            $.ajax({
                type: 'POST',
                url: "{!! route('person.edit') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'id': id
                },
                success: function (data) {
                    $('#modalBody2').html(data);
                    $('#myModal2').modal();
                }
            });
        }

    </script>
@endsection