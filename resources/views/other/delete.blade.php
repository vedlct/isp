<form method="post" action="{{ route('other.update') }}">
    @csrf
    <input type="hidden" name="id" value="{{ $other->id }}">

    <div class="form-group">
        <div class="">
            <input type="submit" value="Delete Data" class="btn btn-success btn-sm float-right">
        </div>
    </div>

</form>