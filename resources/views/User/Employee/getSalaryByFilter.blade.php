<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Employee Name</th>
        <th>Employee Salary</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($report as $employee)
        <tr>
            <td>{{$employee->employeeName}}</td>
            <td>{{$employee->salary}}</td>
            <td>
                @if($report->where('tabelId', $employee->employeeId)->first() == true)
                    <div class="btn btn-info">Done</div>

                @else
                    <button class="btn btn-success">Pay  </button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>

</table>