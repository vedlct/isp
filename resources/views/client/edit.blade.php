<form method="post" action="{{route('internet.client.update',['id'=>$client->clientId])}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="row">
        <div class="form-group col-md-6">
            <label>First Name</label>
            <input type="text" name="clientFirstName" placeholder="First Name" class="form-control" value="{{$client->clientFirstName}}" >
        </div>
        <div class="form-group col-md-6">
            <label>Last Name</label>
            <input type="text" name="clientLastName" placeholder="Last Name" class="form-control" value="{{$client->clientLastName}}" >
        </div>
        <div class="form-group col-md-6">
            <label>email</label>
            <input type="email" name="email" placeholder="Email" class="form-control" value="{{$client->email}}" >
        </div>
        <div class="form-group col-md-6">
            <label>phone</label>
            <input type="text" name="phone" placeholder="phone" class="form-control" value="{{$client->phone}}" >
        </div>

        <div class="form-group col-md-6">
            <label>Client Id</label>
            <input type="text" name="clientSerial" value="{{$client->clientSerial}}"  placeholder="id" class="form-control" >
        </div>

        <div class="form-group col-md-6">
            <label>Package</label>
            <select class="form-control" id="packageedit" onchange="getpackage()" name="package" required>
                <option>Select a Package</option>
                @foreach($package as  $p)
                    <option value="{{$p->packageId}}"  @if($p->packageId == $client->fkpackageId) selected @endif >{{$p->packageName}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>bandWidth</label>
            <input type="text" name="bandwidth" id="bandwidthedit" placeholder="bandwidth" class="form-control" value="{{$client->bandWide}}" >
        </div>
        <div class="form-group col-md-6">
            <label>Price</label>
            <input type="text" name="price" id="priceedit" placeholder="price" class="form-control" value="{{$client->price}}" >
        </div>




        <div class="form-group col-md-6">
            <label>Bandwidth Type</label>
            <select class="form-control" name="bandwidthType" required>
                <option value="">Select Type</option>
                @foreach(BANDWIDTH_TYPE as $key => $value)
                    <option value="{{$key}}" @if($key == $client->bandwidthType) selected @endif>{{$value}}</option>

                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>Cable Length</label>
            <input type="number" name="cableLength" value="{{$client->cableLength}}"  placeholder="meter" class="form-control" >
        </div>

        <div class="form-group col-md-6">
            <label>ip</label>
            <input type="text" name="ip" placeholder="ip" class="form-control" value="{{$client->ip}}" >
        </div>


        <div class="form-group col-md-6">
            <label>Connection Date</label>
            <input type="text" name="conDate"  placeholder="date" value="{{$client->conDate}}" class="form-control datepicker" >
        </div>

        <div class="form-group col-md-6">
            <label>Connection Type</label>
            <select class="form-control" name="connectionType" onchange="connectionTypeChangeEdit(this)" required>
                <option value="">Select Connection Type</option>
                @foreach(CONNECTION_TYPE as $key => $value)
                    <option value="{{$key}}" @if($key==$client->type)selected @endif>{{$value}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>Status</label>
            <select class="form-control" name="status" required>
                <option value="">Select Status</option>
                @foreach(USER_STATUS as $key => $value)
                    <option value="{{$key}}" @if($client->clientStatus == $key) selected @endif>{{$value}}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group col-md-6" id="connectionTypeFieldEdit">

        </div>


        <div class="form-group col-md-6">
            <label>address</label>
            <input type="text" name="address"  placeholder="address" class="form-control" value="{{$client->address}}" >
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
            <button class="btn btn-success pull-right">submit</button>
        </div>

    </div>
</form>
<script>
    counter=0;
    $(document).ready(function() {
//            $('.empform').parsley();

        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd',
            autoclose:true,


        })
        @if($client->type)

        var val={{$client->type}};
        if(val=='1'){
            $('#connectionTypeFieldEdit').html('' +
                ' <label>Connection</label>\n' +
                '<select class="form-control" name="connectionValue"  required>\n' +
                '                                    <option value="">Select Connection Type</option>\n' +
                '                                    @foreach(CONNECTION_FIBER as $key => $value)\n' +
                '                                        <option value="{{$key}}" @if($key==$client->typeDetails)selected @endif>{{$value}}</option>\n' +
                '                                    @endforeach\n' +
                '                                </select>');
        }
        else if(val=='2'){
            $('#connectionTypeFieldEdit').html('' +
                ' <label>Connection</label>\n' +
                '<select class="form-control" name="connectionValue"  required>\n' +
                '                                    <option value="">Select Connection Type</option>\n' +
                '                                    @foreach(CONNECTION_UTP as $key => $value)\n' +
                '                                        <option value="{{$key}}" @if($key==$client->typeDetails)selected @endif>{{$value}}</option>\n' +
                '                                    @endforeach\n' +
                '                                </select>');
        }
        else {
            $('#connectionTypeFieldEdit').html('');
        }

        @endif
    });


    function connectionTypeChangeEdit(x) {
        // alert();
        var val=$(x).val();
        if(val=='1'){
            $('#connectionTypeFieldEdit').html('' +
                ' <label>Connection</label>\n' +
                '<select class="form-control" name="connectionValue"  required>\n' +
                '                                    <option value="">Select Connection Type</option>\n' +
                '                                    @foreach(CONNECTION_FIBER as $key => $value)\n' +
                '                                        <option value="{{$key}}">{{$value}}</option>\n' +
                '                                    @endforeach\n' +
                '                                </select>');
        }
        else if(val=='2'){
            $('#connectionTypeFieldEdit').html('' +
                ' <label>Connection</label>\n' +
                '<select class="form-control" name="connectionValue"  required>\n' +
                '                                    <option value="">Select Connection Type</option>\n' +
                '                                    @foreach(CONNECTION_UTP as $key => $value)\n' +
                '                                        <option value="{{$key}}">{{$value}}</option>\n' +
                '                                    @endforeach\n' +
                '                                </select>');
        }
        else {
            $('#connectionTypeFieldEdit').html('');
        }


    }

    function addMoreField(){
        // if(counter>10){
        //     alert("Only 10 textboxes allow");
        //     return false;
        // }


        // var id=document.getElementById("service"+(counter-1)).value;
        // if(id=="") {
        //     alert("Please Select a Service First!!");
        //     return false;
        //
        // }
        //


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

    function getpackage() {
        var id=document.getElementById('packageedit').value;


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

                document.getElementById('bandwidthedit').value = data.bandwidth;
                document.getElementById('priceedit').value = data.price;

            }
        });
    }

    function deleteFile(x) {
        var id=$(x).data('panel-id');
        // alert(id);
        if(confirm("Want to delete?")){
            $.ajax({
                type: 'POST',
                url: "{!! route('internet.client.deleteFile') !!}",
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