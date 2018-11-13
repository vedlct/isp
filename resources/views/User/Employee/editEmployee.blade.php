<form class="empform" action="{{route('employee.updateEmployee')}}" novalidate="" method="post">
    {{csrf_field()}}
    <input type="hidden"value="{{$employee->employeeId}}" name="empId" id="empId" >
    <div class="form-group">
        <label>Employee Name</label>
        <input type="text" class="form-control"value="{{$employee->employeeName}}" name="employeeName" required="" placeholder="Enter Employee Name">
    </div>
    <div class="form-group">
        <label>Email</label>
        <div>
            <input type="email" class="form-control"value="{{$employee->email}}" name="email" required="" parsley-type="email" placeholder="Enter a valid e-mail">
        </div>
    </div>
    <div class="form-group">
        <label>Designation</label>
        <div>
            <input parsley-type="text" type="text" name="degisnation" value="{{$employee->degisnation}}" class="form-control" required="" placeholder="Enter Designation">
        </div>
    </div>
    <div class="form-group">
        <label>salary</label>
        <div>
            <input data-parsley-type="digits" name="salary" value="{{$employee->salary}}" type="text" class="form-control" required="" placeholder="Enter Salary Amount">
        </div>
    </div>
    <div class="form-group">
        <label>Phone</label>
        <div>
            <input data-parsley-type="number" name="phone"value="{{$employee->phone}}" type="text" class="form-control" required="" placeholder="Enter Phone numbers">
        </div>
    </div>

    <div class="form-group">
        <label>Address</label>
        <div>
            <textarea required=""  name="address"  class="form-control" rows="5">{{$employee->address}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label>Status</label>
        <div>
            <select class="form-control" name="status">
                <option value="1">Active</option>
                <option value="0">InActive</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Employee</button>
        </div>
    </div>
</form>