<form class="empform" action="{{route('expense.update')}}" novalidate="" method="post">
    {{csrf_field()}}
    <input type="hidden" name="expenseId" value="{{$expense->expenseId}}">
    <div class="form-group">
        <label>Expense Type</label>
        <div>
            <select class="form-control" name="expenseType">
                <option value="">Select</option>
                <option @if($expense->expenseType == 'Food')selected @endif>Food</option>
                <option @if($expense->expenseType == 'Router')selected @endif>Router</option>
                <option @if($expense->expenseType == 'Accessories')selected @endif>Accessories</option>
                <option @if($expense->expenseType == 'Others')selected @endif>Others</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>Expense For</label>
        <div>
            <select id="statusFilter" class="form-control" name="expensefor">
                <option value="">Select</option>
                <option value="Internet" @if($expense->expenseFor == 'Internet')selected @endif>Internet</option>
                <option value="Cable" @if($expense->expenseFor == 'Cable')selected @endif>Cable</option>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label>price</label>
        <div>
            <input data-parsley-type="digits" name="price" value="{{$expense->price}}" type="text" class="form-control" required="" placeholder="Enter Salary Amount">
        </div>
    </div>
    <div class="form-group">
        <label>Quantity</label>
        <div>
            <input data-parsley-type="digits" name="amount" value="{{$expense->amount}}" type="text" class="form-control" required="" placeholder="Enter Salary Amount">
        </div>
    </div>
    <div class="form-group">
        <label>Cause</label>
        <div>
            <textarea required="" name="cause"class="form-control" rows="5">{{$expense->cause}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Expense</button>
        </div>
    </div>
</form>