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
    @page { size: auto;  margin:18mm 3mm 3mm 3mm; }
</style>

<body style="background: #fff ">
<div class="structure">
    <div style= "background: #fff;" class="container ">









        {{--Test--}}
        <table style="width: 100%; border:none;">

            <tr>

                <td  style="width: 100%;border: none;">
                    <table  style="width:100%; text-align: center; border: none; margin-top: -60px " >

                    <tr style="">

                    <td style="text-align: center; border: none; ">
                    <h1 style="">
                    <span style=" padding: 20px ;  border: 1px solid #787878; background-color: #ddd;font-weight: bold">INVOICE

                    </span>
                        <br>{{$date}}

                    </h1>
                    </td>

                    </tr>

                    </table>
                    <table style="width:100%; margin-top: 0;border: none;">

                        <tr>

                            <td style="width: 35%;border: none ">


                                <p><h3 style="color: #0476BD;">{{strtoupper($company->companyTitle)}}</h3></p>

                                <p>{{$company->companyAddress}}</p>

                                <p style="margin-top: -10px">
                                P: {{$company->companyPhone1}}, {{$company->companyPhone2}} <br>
                                E: {{$company->companyEmail}}<br>
                                </p>

                            </td>
                            <td style="width: 40%;border: none "></td>

                            <td style="border: none;width: 25%;">
                                <img style="margin-left: 30px" width="198px" height="148px" src="{{url('public/logo/TCL_logo.png')}}" alt="">
                            </td>

                            <td style="width: 40%; border: none;">
                                <p><h3 style="color: #0476BD">{{strtoupper($client->clientFirstName)}} {{strtoupper($client->clientLastName)}}</h3></p>

                                <p style="margin-top: -10px">

                                E: {{$client->email}} <br>
                                P: {{$client->phone}}<br>
                                Address : {{$client->address }}<br>


                                </p>


                            </td>

                        </tr>
                    </table>


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
                    <hr style="border:2px solid dotted;">
                    Client Copy
                    <table border="0" style="width:100%;">
                        <tr>
                            <td></td>
                            <td>Name :</td>
                            <td colspan="2">{{strtoupper($client->clientFirstName)}} {{strtoupper($client->clientLastName)}}</td>
                            <td>Mem. No.</td>
                            <td colspan="2">{{$client->clientSerial}}</td>
                            <td>Tv No.</td>
                            <td>{{$client->noOfTv}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Address :</td>
                            <td colspan="2">{{$client->address }}</td>
                            <td>Con. Date</td>
                            <td colspan="2">{{$client->conDate}}</td>
                            <td>C.C.</td>
                            <td>0</td>

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
                    <hr style="border:2px solid dotted;">
                    Office Copy
                    <table border="0" style="width:100%;">
                        <tr>
                            <td></td>
                            <td>Name :</td>
                            <td colspan="2">{{strtoupper($client->clientFirstName)}} {{strtoupper($client->clientLastName)}}</td>
                            <td>Mem. No.</td>
                            <td colspan="2">{{$client->clientSerial}}</td>
                            <td>Tv No.</td>
                            <td>{{$client->noOfTv}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Address :</td>
                            <td colspan="2">{{$client->address }}</td>
                            <td>Con. Date</td>
                            <td colspan="2">{{$client->conDate}}</td>
                            <td>C.C.</td>
                            <td>0</td>

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

        <table style="width:100%; margin-top: 0; margin-bottom: 15px;border: none;">

            <tr style="width: 100%; border: none;">


                <td style="width: 45%;border: none;">

                </td>
            </tr>

        </table>


        <hr style="border:2px solid dotted;">

    </div>
</div>
</body>
</html>