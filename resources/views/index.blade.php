
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
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Total Bill Recieved</a></h4>
                    <div class="row">
                    <div class="text-left col-md-6">
                        {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}
                        <h2 class="font-light m-b-0"><span class="text-success">800</span></h2>


                    </div>
                    <div class="text-right col-md-6">
                        <h5 class="font-light m-b-0">Client</h5>

                        <span class="text-muted">Last Month</span>

                    </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Total Bill Due</a></h4>

                    <div class="row">

                        <div class="text-left col-md-6">
                            {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}
                            <h2 class="font-light m-b-0"><span class="text-success">200</span></h2>


                        </div>

                    <div class="text-right col-md-6">
                        <h5 class="font-light m-b-0">Client</h5>

                        <span class="text-muted">Last Month</span>

                    </div>

                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Past Bill Due</a></h4>

                    <div class="row">

                        <div class="text-left col-md-6">
                            {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}
                            <h2 class="font-light m-b-0"><span class="text-success"><span id="duepayment"><div class="lds-facebook"><div></div><div></div><div></div></div></span></span></h2>


                        </div>

                    <div class="text-right col-md-6">
                        <h5 class="font-light m-b-0">Client</h5>

                        {{--<span class="text-muted">Last Month</span>--}}

                    </div>

                    </div>


                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Total Expense</a></h4>

                    <div class="row">

                        <div class="text-left col-md-6">
                            {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}
                            {{--<h2 class="font-light m-b-0"><span class="text-success">{{$totalOFLastMonthDebit}} </span></h2>--}}
                            <h2 class="font-light m-b-0"><span class="text-success">35000.00 </span></h2>


                        </div>

                    <div class="text-right col-md-6">
                        <h5 class="font-light m-b-0">TK</h5>

                        <span class="text-muted">Last Month</span>

                    </div>

                    </div>


                </div>
            </div>
        </div>
        <div style="margin-top: 10px;margin-bottom: 10px" class="col-md-12"></div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Total Earning</a></h4>
                    <div class="row">

                        <div class="text-left col-md-6">
                            {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}
                            {{--<h2 class="font-light m-b-0"><span class="text-success">{{$totalOFLastMonthCredit}}</span></h2>--}}
                            <h2 class="font-light m-b-0"><span class="text-success">100000.00</span></h2>


                        </div>

                    <div class="text-right col-md-6">
                        <h5 class="font-light m-b-0">TK</h5>

                        <span class="text-muted">Last Month</span>

                    </div>

                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Total(Summary)</a></h4>
                    <div class="row">
                        <div class="text-left col-md-6">
                            {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}
                            {{--<h2 class="font-light m-b-0"><span class="text-success">{{(number_format(($totalOFLastMonthCredit-$totalOFLastMonthDebit),2))}}</span></h2>--}}
                            <h2 class="font-light m-b-0"><span class="text-success">65000.00</span></h2>


                        </div>
                    <div class="text-right col-md-6">
                        <h5 class="font-light m-b-0">TK</h5>

                        <span class="text-muted">Last Month</span>

                    </div>

                    </div>


                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')
    <script>
    $(document).ready( function () {
        $.ajax({
            type: 'GET',
            url: "{!! route('dashboard.duepayment') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}"},
            success: function (data) {
                $("#duepayment").html(data);
                // console.log(data);
            }
        });

    });

    $(document).ready( function () {
        $.ajax({
            type: 'GET',
            url: "{!! route('dashboard.insertbillformonth') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}"},
            success: function (data) {


              //  $("#duepayment").html(data);
                 console.log(data);
            }
        });

    });
    </script>
    }
    @endsection