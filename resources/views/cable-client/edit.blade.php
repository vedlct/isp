<form method="post" action="{{route('cable.client.update',['id'=>$client->clientId])}}" enctype="multipart/form-data">
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
            <label>Price</label>
            <input type="text" name="price" id="priceedit" placeholder="price" class="form-control" value="{{$client->price}}" >
        </div>

        <div class="form-group col-md-6">
            <label>Cable Length</label>
            <input type="number" name="cableLength" value="{{$client->cableLength}}"  placeholder="meter" class="form-control" >
        </div>

        <div class="form-group col-md-6">
            <label>Client Id</label>
            <input type="text" name="clientSerial" value="{{$client->clientSerial}}"  placeholder="id" class="form-control" >
        </div>

        <div class="form-group col-md-6">
            <label>No. Of Tv</label>
            <input type="number" name="noOfTv"   class="form-control" value="{{$client->noOfTv}}">
        </div>

        <div class="form-group col-md-6">
            <label>Connection Date</label>
            <input type="text" name="conDate"  placeholder="date" value="{{$client->conDate}}" class="form-control datepicker" >
        </div>


        <div class="form-group col-md-6">
            <label>address</label>
            <input type="text" name="address"  placeholder="address" class="form-control" value="{{$client->address}}" >
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


        });
    });
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