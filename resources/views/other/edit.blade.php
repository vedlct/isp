<form method="post" action="{{ route('other.update') }}">
    @csrf
    <input type="hidden" name="id" value="{{ $other->id }}">
    <div class="col-md-12">
        <div class="block">
            <div class="block-body">
                <div class="form-group">
                    <label class="form-control-label">Title</label>
                    <div class="">
                        <input name="title" type="text" placeholder="Title" value="{{ $other->title }}" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-control-label">Type</label>
                    <div class="">
                        <select class="form-control" name="type" required>
                            <option value="">Select Type</option>
                            <option value="Expense" @if($other->type=="Expense") selected @endif>Expense</option>
                            <option value="Income" @if($other->type=="Income") selected @endif>Income</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-control-label">Amount</label>
                    <div class="">
                        <input name="amount" type="number" value="{{ $other->amount }}" placeholder="Amount" class="form-control form-control-success" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="" for="exampleFormControlTextarea1">Description</label>
                    <div class="">
                        <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $other->description }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="">
                        <input type="submit" value="Update Data" class="btn btn-success btn-sm float-right">
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>