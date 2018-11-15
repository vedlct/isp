<form method="post" action="{{route('package.cable.update',['id'=>$package->cablepackageId])}}">
    {{csrf_field()}}
    <div class="row">
        <div class="form-group col-md-6">
            <label>package Name</label>
            <input type="text" name="cablepackageName" placeholder="package name" class="form-control" value="{{$package->cablepackageName}}">
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
