<?php

namespace App\Http\Controllers;


use App\Bill;
use App\CableBill;
use App\CableClient;
use App\CablePackage;
use App\Client;
use App\InternetBill;
use App\InternetClient;
use App\Package;

//use App\Client;
use App\Company;

use App\Report;
use App\SmsCheckMonth;
use App\SmsConfig;
use Illuminate\Http\Request;
use PDF;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
class SmsController extends Controller
{

    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       // $this->middleware('auth');
    }
    public function sendBillToPay()
    {
        $n = SmsCheckMonth::where(DB::raw('month(date)'), date('m') )->where(DB::raw('Year(date)'), date('Y') )->where('type',2)->first();

        if($n){

            return 1;

        }
        else{

            $client = InternetClient::select('clientId','phone')
                ->where(function ($query) {
                    $query->where('clientStatus', 2)
                        ->orWhere('clientStatus', 3);
                })->get();



//            $userName="techcloud";
//            $password="tcl@it404$";
//            $brand="TECH CLOUD";

            $smsConfig=SmsConfig::select('userName','password','brandName')->first();
                        $userName=$smsConfig->userName;
                        $password=$smsConfig->password;
                        $brand=$smsConfig->brandName;

            $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );

            $balance = file_get_contents('https://msms.techcloudltd.com/pages/RequestBalance.php?user_name='.urlencode($userName).'&pass_word='.urlencode($password),false, stream_context_create($arrContextOptions)); /* balance api*/

           // return count($client);
          //  return (((float)$balance)*100);

            if (($balance == "404 - Wrong Username") || ($balance == "405 - Wrong Password")){

                return $balance;

            }
            else{



                if ( (((float)$balance)) >= (count($client)*.65)){

                    $error=array();

                    foreach ($client as $cl){



                        $destination=$cl->phone;


                        $sms="Dear valued Client, Please Pay your Internet Bill Within 10th ".date('F')." ".date('Y')." Otherwise your connection will disconnect. Please ignore if you already paid.";

                        $json = file_get_contents("https://msms.techcloudltd.com/pages/RequestSMS.php?user_name=".urlencode($userName)."&pass_word=".urlencode($password)."&brand=".urlencode($brand)."&type=1&destination=".urlencode($destination)."&sms=".urlencode($sms), false, stream_context_create($arrContextOptions));

                        if ($json== "407 - Wrong Brandname Given"){
                            $error=array('1'=>$json);
                        }

                    }

                   // return $error;

                    if(!empty($error))
                    {

                        $json_out = json_encode(array_values($error));

                        return $json_out;
                    }

                    $n->deliveryStatus=400;
                    $n->save();

                    return 400;

                }
                else{

                    //$n = SmsCheckMonth::where(DB::raw('month(date)'), date('m') )->where(DB::raw('Year(date)'), date('Y') )->where('type',2)->first();

//                    $n->deliveryStatus=409;
//                    $n->save();

                    return 409;
                }

            }

        }

    }
    public function config()
    {
        $smsConfig=SmsConfig::first();


        return view('sms.config',compact('smsConfig'));

    }
    public function addNewconfig(Request $r)
    {
        $smsConfig=new SmsConfig();

        $smsConfig->userName=$r->useName;
        $smsConfig->password=$r->password;
        $smsConfig->brandName=$r->brandName;
        $smsConfig->save();

        return back();

    }
    public function updateconfig(Request $r)
    {
        $smsConfig=SmsConfig::findOrFail($r->smsId);

        $smsConfig->userName=$r->useName;
        $smsConfig->password=$r->password;
        $smsConfig->brandName=$r->brandName;
        $smsConfig->save();

        return back();

    }
    public function editconfig(Request $r)
    {
        $smsConfig=SmsConfig::findOrFail($r->id);

        return view('sms.updateSmsConfig',compact('smsConfig'));

    }


//////////////////////////sakib/////////////////////////////////////////////







}
