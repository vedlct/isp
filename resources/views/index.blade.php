
@extends('layouts.mainLayout')

@section('content')
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Debit</a></h4>

                    <div class="text-right">
                        {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}

                        <span class="text-muted">Last Month</span>

                    </div>
                    <div class="text-left">
                        {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}
                        <h2 class="font-light m-b-0"><span class="text-success">{{$totalOFLastMonthDebit}}</span></h2>


                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Credit</a></h4>
                    <div class="text-right">
                        {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}

                        <span class="text-muted">Last Month</span>

                    </div>
                    <div class="text-left">
                        {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}
                        <h2 class="font-light m-b-0"><span class="text-success">{{$totalOFLastMonthCredit}}</span></h2>


                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Summary</a></h4>
                    <div class="text-right">
                        {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}

                        <span class="text-muted">Last Month</span>

                    </div>
                    <div class="text-left">
                        {{--<h2 class="font-light m-b-0"> {{$lastDayCalled}} | {{$target->targetCall}}</h2>--}}
                        <h2 class="font-light m-b-0"><span class="text-success">{{(number_format(($totalOFLastMonthCredit-$totalOFLastMonthDebit),2))}}</span></h2>


                    </div>


                </div>
            </div>
        </div>

    </div>

@endsection
