<form method="post" action="{{route('client.update',['id'=>$client->clientId])}}">
    {{csrf_field()}}
    <div class="row">
        <div class="form-group col-md-12">
            <label>First Name</label>
            <input type="text" name="clientFirstName" placeholder="First Name" class="form-control" value="{{$client->clientFirstName}}" >
        </div>
        <div class="form-group col-md-12">
            <label>Last Name</label>
            <input type="text" name="clientLastName" placeholder="Last Name" class="form-control" value="{{$client->clientLastName}}" >
        </div>
        <div class="form-group col-md-12">
            <label>email</label>
            <input type="email" name="email" placeholder="Email" class="form-control" value="{{$client->email}}" >
        </div>
        <div class="form-group col-md-12">
            <label>phone</label>
            <input type="text" name="phone" placeholder="phone" class="form-control" value="{{$client->phone}}" >
        </div>
        <div class="form-group col-md-12">
            <label>ip</label>
            <input type="text" name="ip" placeholder="ip" class="form-control" value="{{$client->ip}}" >
        </div>
        <div class="form-group col-md-12">
            <label>Package</label>
            <select class="form-control" id="packageedit" onchange="getpackage()" name="package">
                <option>Select a Package</option>
                @foreach($package as  $p)
                    <option value="{{$p->packageId}}"  @if($p->packageId == $client->fkpackageId) selected @endif >{{$p->packageName}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-12">
            <label>bandWidth</label>
            <input type="text" name="bandwidth" id="bandwidthedit" placeholder="bandwidth" class="form-control" value="{{$client->bandWide}}" >
        </div>
        <div class="form-group col-md-12">
            <label>Price</label>
            <input type="text" name="price" id="priceedit" placeholder="price" class="form-control" value="{{$client->price}}" >
        </div>
        <div class="form-group col-md-12">
            <label>address</label>
            <input type="text" name="address"  placeholder="address" class="form-control" value="{{$client->address}}" >
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-success pull-right">submit</button>
        </div>

    </div>
</form>
<script>
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
</script>