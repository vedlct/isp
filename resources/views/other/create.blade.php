<form method="post" action="{{ route('insert.other') }}">
    @csrf
    <div class="col-md-12">
        <div class="block">
            <div class="block-body">
                <div class="form-group">
                    <label class="form-control-label">Title</label>
                    <div class="">
                        <input name="title" type="text" placeholder="Title" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-control-label">Type</label>
                    <div class="">
                        <select class="form-control" name="type" required>
                            <option value="">Select Type</option>
                            <option value="Expense">Expense</option>
                            <option value="Income">Income</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-control-label">Amount</label>
                    <div class="">
                        <input name="amount" type="number" placeholder="Amount" class="form-control form-control-success" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="" for="exampleFormControlTextarea1">Description</label>
                    <div class="">
                        <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="">
                        <input type="submit" value="Insert Data" class="btn btn-success btn-sm float-right">
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>