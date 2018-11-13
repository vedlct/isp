<form method="post" action="{{route('package.update',['id'=>$package->packageId])}}">
    {{csrf_field()}}
    <div class="row">
        <div class="form-group col-md-6">
            <label>package Name</label>
            <input type="text" name="packageName" placeholder="package name" class="form-control" value="{{$package->packageName}}">
        </div>
        <div class="form-group col-md-6">
            <label>Bandwidth</label>
            <input type="text" name="bandwidth" placeholder="Bandwidth" class="form-control" value="{{$package->bandwidth}}">
        </div>
        <div class="form-group col-md-6">
            <label>Price</label>
            <input type="text" name="price" placeholder="price" class="form-control" value="{{$package->price}}">
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-success pull-right">Update</button>
        </div>

    </div>
</form>
