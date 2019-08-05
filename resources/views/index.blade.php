
@extends('layouts.mainLayout')

@section('content')
    <style>
        .lds-facebook {
            display: inline-block;
            position: relative;
            width: 64px;
            height: 37px;
        }
        .lds-facebook div {
            display: inline-block;
            position: absolute;
            left: 6px;
            width: 13px;
            background: #99ff48;
            animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }
        .lds-facebook div:nth-child(1) {
            left: 6px;
            animation-delay: -0.24s;
        }
        .lds-facebook div:nth-child(2) {
            left: 26px;
            animation-delay: -0.12s;
        }
        .lds-facebook div:nth-child(3) {
            left: 45px;
            animation-delay: 0;
        }
        @keyframes lds-facebook {
            0% {
                top: 6px;
                height: 51px;
            }
            50%, 100% {
                top: 19px;
                height: 26px;
            }
        }

    </style>


    <div class="card">
        <div class="card-body">
            <h3>All Report  ( {{date('M')}} )</h3>
            <div class="row">
    @if(Auth::user()->fkusertype=="Admin" || Auth::user()->fkusertype=="InternetEmp")
                <div class="table-responsive col-md-6">
                    <table class="table table-striped table-bordered ">
                        <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center"><h3>Internet</h3></td>
                        </tr>
                        <tr>
                            <td> <a href="{{route('bill.internet.showTotalBillRecieved')}}">Total Bill Recieved</a></td>
                            <td>@if($totalbilllastmonthinternet->totalbillinternet){{$totalbilllastmonthinternet->totalbillinternet}} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <td><a href="{{route('bill.showPastDueLastMonth')}}">Total Bill Due</a></td>
                            <td>@if($totalduelastmonthinternet->totaldueinternet){{$totalduelastmonthinternet->totaldueinternet}} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <td><a href="{{route('bill.showPastDue')}}">Past Bill Due</a></td>
                            <td>@if($totalpastduelastmonthinternet->totalpastdueinternet){{$totalpastduelastmonthinternet->totalpastdueinternet}} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <td><a href="#">Total Expense</a></td>
                            <td>@if($totalOFLastMonthDebit){{$totalOFLastMonthDebit}} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <td><a href="#">Total Earning</a></td>
                            <td>@if($totalOFLastMonthCredit){{$totalOFLastMonthCredit}} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <td><a href="#">Total(Summary)</a></td>
                            <td>@if($summary){{$summary }} @else 0 @endif</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                @endif
                @if(Auth::user()->fkusertype=="Admin" || Auth::user()->fkusertype=="CableEmp")

                <div class="table-responsive col-md-6">
                    <table class="table table-striped table-bordered ">
                        <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center"><h3>Cable</h3></td>
                        </tr>
                        <tr>
                            <td><a href="{{route('bill.cable.showTotalBillRecieved')}}">Total Bill Recieved</a></td>
                            <td>@if($totalbilllastmonthcable->totalbillcable){{$totalbilllastmonthcable->totalbillcable}} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <td><a href="{{route('bill.showPastDueLastMonth')}}">Total Bill Due</a></td>
                            <td>@if($totalduelastmonthcable->totalduecable){{$totalduelastmonthcable->totalduecable}} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <td><a href="{{route('bill.showPastDue')}}">Past Bill Due</a></td>
                            <td>@if($totalpastduelastmonthcable->totalpastduecable){{$totalpastduelastmonthcable->totalpastduecable}} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <td><a href="#">Total Expense</a></td>
                            <td>{{$totalOFLastMonthDebit}}</td>
                        </tr>
                        <tr>
                            <td><a href="#">Total Earning</a></td>
                            <td>{{$totalOFLastMonthCreditcable}}</td>
                        </tr>
                        <tr>
                            <td><a href="#">Total(Summary)</a></td>
                            <td>{{$summarycable }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
@endif
        <hr class="col-md-12">
        <div class="table-responsive col-md-6">
            <table class="table table-striped table-bordered ">
                <tbody>
                    <tr>
                        <td colspan="2" style="text-align: center"><h3>Salary Expense</h3></td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="table-responsive col-md-6">
            <table class="table table-striped table-bordered ">
                <tbody>
                <tr>
                    <td colspan="2" style="text-align: center"><h3>Personal Expense</h3></td>
                </tr>
                </tbody>
            </table>

        </div>
            </div>

        </div>


    </div>

@endsection
@section('js')
    <script>
    {{--$(document).ready( function () {--}}

        {{--$.ajax({--}}
            {{--type: 'GET',--}}
            {{--url: "{!! route('dashboard.duepayment') !!}",--}}
            {{--cache: false,--}}
            {{--data: {_token: "{{csrf_token()}}"},--}}
            {{--success: function (data) {--}}
                {{--$("#duepayment").html(data);--}}
                {{--// console.log(data);--}}
            {{--}--}}
        {{--});--}}

    {{--});--}}

    $(document).ready( function () {
        $.ajax({
            type: 'GET',
            url: "{!! route('dashboard.insertbillformonth') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}"},
            success: function (data) {


              //  $("#duepayment").html(data);
               //  console.log(data);
            }
        });

    });
    </script>
    }
    @endsection