

{{--{{$reportId}}--}}
{{--{{$report}}--}}
{{--{{$report->tableName}}--}}

{{--<div class="card">--}}
    {{--<div class="card-header">--}}
        {{--Report - {{$report->status}}--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
        @if($report->status==ACCOUNT_STATUS['Debit'])
        <h5 class="card-title">{{$report->expenseType}}</h5>
        <p class="card-text">{{$report->cause}}</p>
        <div class="row">
            @if($report->tableName =='employee')
            <div class="col-md-4">
                <label>Name</label> :{{$report->employeeName}}
            </div>
            <div class="col-md-4">
                <label>Designation</label> :{{$report->degisnation}}
            </div>
            <div class="col-md-4">
                <label>phone</label> :{{$report->phone}}
            </div>
            <div class="col-md-4">
                <label>email</label> :{{$report->email}}
            </div>
            <div class="col-md-4">
                <label>Paid Salary</label> :{{$report->price}}
            </div>
            @else

            <div class="col-md-4">
                <label>Amount</label> : {{$report->amount}}
            </div>
            <div class="col-md-4">
                <label>Price</label> : {{$report->price}}
            </div>
            <div class="col-md-4">
                <label>Expense For</label> : {{$report->expenseFor}}
            </div>
            @endif
        </div>


        </div>

        @else

            <h5 style="text-align: center" class="card-title">
                @if($report->tableName=="cable_bill")
                    Cable
                @elseif($report->tableName=="internet_bill")
                    Internet
                @endif
                Bill


            </h5>
            <div class="row">
            <div class="col-md-12">
                <label>Name</label> : {{$report->clientFirstName.' '. $report->clientLastName}}
            </div>

            <div class="col-md-6">
                <label>phone</label> :{{$report->phone}}
            </div>
            <div class="col-md-6">
                <label>email</label> :{{$report->email}}
            </div>
            <div class="col-md-4">
                <label>Total Bill</label> :<span style="color: red">{{$report->Totalprice}}</span>
            </div>
            <div class="col-md-4">
                <label>Total Discount</label> :<span style="color: red">{{$report->discount}}</span>
            </div>
            <div class="col-md-4">
                <label>Total Paid</label> :<span style="color: red">{{$report->partial}}</span>
            </div>
            <div class="col-md-12">
                <label>Address</label> :{{$report->address}}
            </div>
            </div>



        @endif
    {{--</div>--}}
{{--</div>--}}

