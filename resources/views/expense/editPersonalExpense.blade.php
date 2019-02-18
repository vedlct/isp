<form class="empform" action="{{route('personal.expense.update',['id'=>$expense->id])}}" novalidate="" method="post">
    <div class="row">
    {{csrf_field()}}

    <div class="form-group col-md-12">
        <label>Expense For</label>
        <div>
            <select id="statusFilter" class="form-control" name="expensefor" required>
                @foreach($expensePerson as $person)
                    <option value="{{$person->id}}" @if($person->id == $expense->personId)selected @endif>{{$person->name}}</option>
                @endforeach
            </select>
        </div>
    </div>



    <div class="form-group col-md-6">
        <label>TK</label>
        <div>
            <input data-parsley-type="number" name="price" type="text" value="{{$expense->price}}" class="form-control" required placeholder="Enter Price Amount">
        </div>
    </div>
    <div class="form-group col-md-6">
         <label>Date</label>
         <div>
            <input  name="date" type="text" value="{{$expense->date}}" class="form-control datepicker" required placeholder="Enter Price Amount">
         </div>
   </div>

    <div class="form-group col-md-12">
        <label>Cause</label>
        <div>
            <textarea required="" name="cause" class="form-control" rows="5">{{$expense->cause}}</textarea>
        </div>
    </div>
    <div class="form-group col-md-12">
        <div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Expense</button>
        </div>
    </div>
    </div>
</form>


<script>
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose:true,

    });
</script>
