<form class="empform" action="{{route('employee.updateEmployee')}}" novalidate="" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="row">
        <input type="hidden"value="{{$employee->employeeId}}" name="empId" id="empId" >
        <input type="hidden"value="{{$user->userId}}" name="userId" id="userId" >
        <div class="form-group col-md-6">
            <label>Employee Name</label>
            <input type="text" class="form-control"value="{{$employee->employeeName}}" name="employeeName" required="" placeholder="Enter Employee Name">
        </div>
        <div class="form-group col-md-6">
            <label>Email</label>
            <div>
                <input type="email" class="form-control"value="{{$employee->email}}" name="email" required="" parsley-type="email" placeholder="Enter a valid e-mail">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>Password</label>
            <div>
                <input type="text" class="form-control" name="password" value="" required="" parsley-type="email" placeholder="enter Password">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>User Type</label>
            <div>
                <select class="form-control" name="usertype">
                    @foreach(USER_TYPE as $key=>$value)
                        <option value="{{$key}}" {{ $user->fkusertype == $key ? 'selected' : '' }}>{{$value}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>Designation</label>
            <div>
                <input parsley-type="text" type="text" name="degisnation" value="{{$employee->degisnation}}" class="form-control" required="" placeholder="Enter Designation">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>salary</label>
            <div>
                <input data-parsley-type="digits" name="salary" value="{{$employee->salary}}" type="text" class="form-control" required="" placeholder="Enter Salary Amount">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>Phone</label>
            <div>
                <input data-parsley-type="number" name="phone"value="{{$employee->phone}}" type="text" class="form-control" required="" placeholder="Enter Phone numbers">
            </div>
        </div>

        <div class="form-group col-md-6">
            <label>Address</label>
            <div>
                <textarea required=""  name="address"  class="form-control" rows="5">{{$employee->address}}</textarea>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>Status</label>
            <div>
                <select class="form-control" name="status">
                    <option value="1">Active</option>
                    <option value="0">InActive</option>
                </select>
            </div>
        </div>

        <div class="col-md-12"><hr></div>
        @foreach($documents as $document)
            <div class="form-group col-md-6">
                <a href="{{url("public/".$document->path)}}" download>{{$document->name}}</a>
            </div>
            {{--{{$document->path}}--}}

            <div class="form-group col-md-6 pull-right">
                {{--<button type="button" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>--}}
                <button type="button" class="btn btn-sm btn-danger" data-panel-id="{{$document->fileId}}" onclick="deleteFile(this)"><i class="fa fa-trash"></i></button>
            </div>

        @endforeach

        <div id="TextBoxesGroup123" class="col-md-12">

        </div>

        <div class="form-group col-md-12 pull-right">
            <button type="button" class="btn btn-info btn-sm " onclick="addMoreField()">add more</button>
            <button type="button" class="btn btn-danger btn-sm " onclick="removeField()">remove</button>
        </div>

        <div class="form-group col-md-12">
            <div class="pull-right">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Employee</button>
            </div>
        </div>
    </div>
</form>




<script>
    counter=0;





    function addMoreField(){


        var newTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'TextBoxDiv' + counter);

        newTextBoxDiv.after().html('<div class="row"><div class="form-group col-md-6">\n' +
            '                                <label>Name</label>\n' +
            '                                <input type="text" name="clientFile[]"  placeholder="insert image" class="form-control" required>\n' +
            '                            </div>\n' +
            '                            <div class="form-group col-md-6">\n' +
            '                                <label>File</label>\n' +
            '                                <input type="file" name="clientImage[]"  placeholder="insert image" class="form-control" required>\n' +
            '                            </div></div>'
        );
        newTextBoxDiv.appendTo("#TextBoxesGroup123");
        counter++;
        // ii++;

    }

    function removeField(){
        if(counter==0){
            alert(" textbox to remove");
            return false;
        }
        counter--;
        $("#TextBoxDiv" + counter).remove();

    }



    function deleteFile(x) {
        var id=$(x).data('panel-id');
        // alert(id);
        if(confirm("Want to delete?")){
            $.ajax({
                type: 'POST',
                url: "{!! route('employee.deleteFile') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {

                    // console.log(data);
                    editClientById(data);


                }
            });
        }


    }
</script>