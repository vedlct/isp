<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Employee Name</th>
        <th>Employee Salary</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($salary as $employee)
        <tr>
            <td>{{$employee->employeeName}}</td>
            <td>{{$employee->salary}}</td>
            <td>
                @if(\App\Http\Controllers\EmployeeController::salaryStatus($employee->employeeId)=='paid')
                    <div class="badge badge-primary">Paid</div>
                    <button type="button"  data-panel-id="{{$salary->where('fkemployeeId', $employee->employeeId)->first()->id}}" onclick="unpaid(this)" class="btn btn-sm btn-danger" id="unPaid"><i class="fa fa-trash"></i></button>
                @else
                    <form action="{{route('employee.salary.pay')}}" method="post">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$employee->employeeId}}">
                        <button type="submit" id="payButton" class="btn btn-info">Pay</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>

</table>