<!DOCTYPE html>
<html lang="en">
<head>
    <title>Invoice</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    <style>
        /* body {
             background: #ddd none repeat scroll 0 0;
         }*/


        /*
        img {
            width: 80px;

        }
        .versity_name span {
            color: red;
        }

        .application h3 {
            color: red;
            font-size: 25px;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
        }

        .versity_name h2 {
            font-size: 37px;
            margin-left: 18px;
        }
        .application p {
            margin: 0;
            padding: 0;
        }
        .photo > p {
            border: 1px solid;
            height: 122px;
            margin-top: 5px;
            text-align: center;
            width: 110px;
        }*/

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }

        input {
            border: medium none;
            padding: 0;
        }
        .tblColor{
            background-color: #ddd;

        }



    </style>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}

    <style>

        @font-face {
            font-family: 'Helvetica', sans-serif;
            src: url('public/fonts/HelveticaLt_1.ttf');
        }

        /*<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300" rel="stylesheet">*/
        body{
            font-family: 'Helvetica', sans-serif;
            font-size: 11px;
        }


    </style>

</head>

<style>
    @page { size: auto;  margin:10px 10px 10px 20px; }
</style>

<body style="background: #fff ">
<div class="structure" style="margin-left: 20px;">










    {{--Test--}}
    <table style="width: 100%; border:none;">

        <tr>

            <td  style="width: 100%;border: none;">
                <table  style="width:100%; text-align: center; border: none;" >

                    <tr style="margin: 0px;width: 100%">
                        <td style="border: none;padding: 0px;" >
                            <img style="margin:0px" width="100px" height="60px" src="{{url('public/logo/TCL_logo.png')}}" alt="">
                        </td>
                        <td style="text-align: center; border: none; ">
                            <h1 style="">
                                INVOICE<br>
                                {{$date}}

                            </h1>
                        </td>
                        <td style="border: none;">

                        </td>

                    </tr>

                    <tr >
                        <td style="border: none;">
                            <p><h3 style="color: #0476BD;">{{strtoupper($company->companyTitle)}}</h3></p>

                            <p>{{$company->companyAddress}}</p>

                            <p style="margin-top: -10px">
                                P: {{$company->companyPhone1}}, {{$company->companyPhone2}} <br>
                                E: {{$company->companyEmail}}<br>
                            </p>
                        </td>

                        <td style="text-align: center; border: none;">

                        </td>

                        <td style="border: none;">
                            <div style="margin-left: 20%">
                                <p><h3 style="color: #0476BD">{{strtoupper($client->clientFirstName)}} {{strtoupper($client->clientLastName)}}</h3></p>

                                <p style="margin-top: -10px">

                                    E: {{$client->email}} <br>
                                    P: {{$client->phone}}<br>
                                    Address : {{$client->address }}<br>


                                </p>
                            </div>
                        </td>

                    </tr>
                    {{--<tr>--}}

                    {{--<td style="width: 35%;border: none ">--}}




                    {{--</td>--}}
                    {{--<td style="width: 40%;border: none "></td>--}}

                    {{--<td style="border: none;width: 25%;">--}}
                    {{--<img style="margin-left: 30px" width="198px" height="148px" src="{{url('public/logo/TCL_logo.png')}}" alt="">--}}
                    {{--</td>--}}

                    {{--<td style="width: 40%; border: none;">--}}
                    {{----}}


                    {{--</td>--}}

                    {{--</tr>--}}
                </table>
                {{--<table style="width:100%; margin-top: 0;border: none;">--}}

                {{----}}
                {{--</table>--}}


                <table border="0" style="width:100%;">
                    <tr style="background: #4682B4;color: white">
                        <td style="text-align: center;" colspan=""><b>Month</b></td>
                        <td style="text-align: center;" colspan=""><b>Prev Due</b></td>
                        <td style="text-align: center;" colspan=""><b>Due</b></td>
                        <td style="text-align: center;" colspan=""><b>Total</b></td>
                    </tr>
                    <tr style="">
                        <td style="text-align: center;" colspan=""></td>
                        <td style="text-align: center;" colspan=""><b>0</b></td>
                        <td style="text-align: center;" colspan=""><b>{{$client->price}}</b></td>
                        <td style="text-align: center;" colspan=""><b>{{$client->price}}</b></td>
                    </tr>




                </table>

            </td>


        </tr>


        <tr>
            <td style="width: 100%;border: none;">
                {{--Client Copy--}}
                <hr style="border:2px solid dotted;margin-top: 20px">
                Client Copy
                <table border="0" style="width:100%;">
                    <tr>
                        <td></td>
                        <td>Name :</td>
                        <td colspan="2">{{strtoupper($client->clientFirstName)}} {{strtoupper($client->clientLastName)}}</td>
                        <td>Mem. No.</td>
                        <td colspan="2">{{$client->clientSerial}}</td>
                        <td>Package</td>
                        <td>{{$client->packageName}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Address :</td>
                        <td colspan="2">{{$client->address }}</td>
                        <td>Con. Date</td>
                        <td colspan="2">{{$client->conDate}}</td>
                        <td>CONNECTION TYPE</td>
                        <td>@if($client->bandwidthType){{CONNECTION_TYPE[$client->bandwidthType]}} @endif</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>Date</td>
                        <td colspan="2"></td>
                        <td colspan="2">Paid:</td>
                        <td colspan="2">Due:</td>
                        <td>{{$client->phone}}</td>
                    </tr>

                </table>


                {{--Office Copy--}}
                <hr style="border:2px solid dotted;margin-top: 20px">
                Office Copy
                <table border="0" style="width:100%;">
                    <tr>
                        <td></td>
                        <td>Name :</td>
                        <td colspan="2">{{strtoupper($client->clientFirstName)}} {{strtoupper($client->clientLastName)}}</td>
                        <td>Mem. No.</td>
                        <td colspan="2">{{$client->clientSerial}}</td>
                        <td>Package</td>
                        <td>{{$client->packageName}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Address :</td>
                        <td colspan="2">{{$client->address }}</td>
                        <td>Con. Date</td>
                        <td colspan="2">{{$client->conDate}}</td>
                        <td>CONNECTION TYPE</td>
                        <td>@if($client->bandwidthType){{CONNECTION_TYPE[$client->bandwidthType]}} @endif</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>Date</td>
                        <td colspan="2"></td>
                        <td colspan="2">Paid:</td>
                        <td colspan="2">Due:</td>
                        <td>{{$client->phone}}</td>
                    </tr>

                </table>


            </td>


        </tr>

    </table>



    {{--Test Ends--}}




    <hr style="border:2px solid dotted;margin-top: 20px">

    <table style="width: 100%; border:none;">

        <tr>

            <td  style="width: 100%;border: none;">
                <table  style="width:100%; text-align: center; border: none;" >

                    <tr style="margin: 0px;width: 100%">
                        <td style="border: none;padding: 0px;" >
                            <img style="margin:0px" width="100px" height="60px" src="{{url('public/logo/TCL_logo.png')}}" alt="">
                        </td>
                        <td style="text-align: center; border: none; ">
                            <h1 style="">
                                INVOICE<br>
                                {{$date}}

                            </h1>
                        </td>
                        <td style="border: none;">

                        </td>

                    </tr>

                    <tr >
                        <td style="border: none;">
                            <p><h3 style="color: #0476BD;">{{strtoupper($company->companyTitle)}}</h3></p>

                            <p>{{$company->companyAddress}}</p>

                            <p style="margin-top: -10px">
                                P: {{$company->companyPhone1}}, {{$company->companyPhone2}} <br>
                                E: {{$company->companyEmail}}<br>
                            </p>
                        </td>

                        <td style="text-align: center; border: none;">

                        </td>

                        <td style="border: none;">
                            <div style="margin-left: 20%">
                                <p><h3 style="color: #0476BD">{{strtoupper($client->clientFirstName)}} {{strtoupper($client->clientLastName)}}</h3></p>

                                <p style="margin-top: -10px">

                                    E: {{$client->email}} <br>
                                    P: {{$client->phone}}<br>
                                    Address : {{$client->address }}<br>


                                </p>
                            </div>
                        </td>

                    </tr>
                    {{--<tr>--}}

                    {{--<td style="width: 35%;border: none ">--}}




                    {{--</td>--}}
                    {{--<td style="width: 40%;border: none "></td>--}}

                    {{--<td style="border: none;width: 25%;">--}}
                    {{--<img style="margin-left: 30px" width="198px" height="148px" src="{{url('public/logo/TCL_logo.png')}}" alt="">--}}
                    {{--</td>--}}

                    {{--<td style="width: 40%; border: none;">--}}
                    {{----}}


                    {{--</td>--}}

                    {{--</tr>--}}
                </table>
                {{--<table style="width:100%; margin-top: 0;border: none;">--}}

                {{----}}
                {{--</table>--}}


                <table border="0" style="width:100%;">
                    <tr style="background: #4682B4;color: white">
                        <td style="text-align: center;" colspan=""><b>Month</b></td>
                        <td style="text-align: center;" colspan=""><b>Prev Due</b></td>
                        <td style="text-align: center;" colspan=""><b>Due</b></td>
                        <td style="text-align: center;" colspan=""><b>Total</b></td>
                    </tr>
                    <tr style="">
                        <td style="text-align: center;" colspan=""></td>
                        <td style="text-align: center;" colspan=""><b>0</b></td>
                        <td style="text-align: center;" colspan=""><b>{{$client->price}}</b></td>
                        <td style="text-align: center;" colspan=""><b>{{$client->price}}</b></td>
                    </tr>




                </table>

            </td>


        </tr>


        <tr>
            <td style="width: 100%;border: none;">
                {{--Client Copy--}}
                <hr style="border:2px solid dotted;margin-top: 20px">
                Client Copy
                <table border="0" style="width:100%;">
                    <tr>
                        <td></td>
                        <td>Name :</td>
                        <td colspan="2">{{strtoupper($client->clientFirstName)}} {{strtoupper($client->clientLastName)}}</td>
                        <td>Mem. No.</td>
                        <td colspan="2">{{$client->clientSerial}}</td>
                        <td>Package</td>
                        <td>{{$client->packageName}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Address :</td>
                        <td colspan="2">{{$client->address }}</td>
                        <td>Con. Date</td>
                        <td colspan="2">{{$client->conDate}}</td>
                        <td>CONNECTION TYPE</td>
                        <td>@if($client->bandwidthType){{CONNECTION_TYPE[$client->bandwidthType]}} @endif</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>Date</td>
                        <td colspan="2"></td>
                        <td colspan="2">Paid:</td>
                        <td colspan="2">Due:</td>
                        <td>{{$client->phone}}</td>
                    </tr>

                </table>


                {{--Office Copy--}}
                <hr style="border:2px solid dotted;margin-top: 20px">
                Office Copy
                <table border="0" style="width:100%;">
                    <tr>
                        <td></td>
                        <td>Name :</td>
                        <td colspan="2">{{strtoupper($client->clientFirstName)}} {{strtoupper($client->clientLastName)}}</td>
                        <td>Mem. No.</td>
                        <td colspan="2">{{$client->clientSerial}}</td>
                        <td>Package</td>
                        <td>{{$client->packageName}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Address :</td>
                        <td colspan="2">{{$client->address }}</td>
                        <td>Con. Date</td>
                        <td colspan="2">{{$client->conDate}}</td>
                        <td>CONNECTION TYPE</td>
                        <td>@if($client->bandwidthType){{CONNECTION_TYPE[$client->bandwidthType]}} @endif</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>Date</td>
                        <td colspan="2"></td>
                        <td colspan="2">Paid:</td>
                        <td colspan="2">Due:</td>
                        <td>{{$client->phone}}</td>
                    </tr>

                </table>


            </td>


        </tr>

    </table>




</div>

</body>
</html>