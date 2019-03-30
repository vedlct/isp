
<form method="post" action="{{ route('person.update') }}">
    @csrf
    <input type="hidden" name="id" value="{{ $person->id }}">

    <div class="form-group">
        <label>Person Name</label>
        <input type="text" name="name" value="{{ $person->name }}" placeholder="Person Name" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" value="Update person" class="btn btn-success float-right">
    </div>
</form>