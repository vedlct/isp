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
use App\User;
use Illuminate\Http\Request;
use PDF;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Auth;
class BillController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(){
        $date=Carbon::now()->format('F-Y');
        $package = Package::get();
        return view('bill.show', compact('package','date'));
    }
    public function showWithData(Request $r){
        $bill = Bill::select('bill.fkclientId','client.clientFirstName','client.clientLastName','client.ip','client.bandWide','bill.price as billprice','bill.billId',DB::raw('DATE_FORMAT(bill.billdate,"%M-%Y") as billdate'),
            'client.address', 'package.packageName','bill.status as billStatus')
            ->leftjoin('client','bill.fkclientId','client.clientId')
            ->leftjoin('package','package.packageId','client.fkpackageId');
        if ($r->billMonth){
            $month = Carbon::parse($r->billMonth)->format('m');
            $bill= $bill->where(DB::raw('month(bill.billdate)'),$month);
        }
        if ($r->pastDue){
            $bill= $bill->where('bill.status','np');
        }
        $datatables = DataTables::of($bill);
        return $datatables->make(true);
    }
    public function showPastDue(){
        return view('bill.internet.showPastDue');
    }
    public function showPastDueLastMonth(){
        $LastMonth=Carbon::now()->subMonth()->format('F-Y');
        return view('bill.showPastDue',compact('LastMonth'));
    }
    public function showDate($date){
        $currentMonth = Carbon::parse($date)->format('m');
        $client = Client::select('clientId','clientFirstName','clientLastName','ip','bandWide','client.price as cprice', 'address', 'packageName')
            ->leftjoin('package','packageId','fkpackageId')
            ->get();


        $bill = Bill::where(DB::raw('month(billdate)'),$currentMonth)->get();
        $package = Package::get();
        return view('bill.show', compact('client', 'bill', 'package','date'));
    }
    public function paid(Request $r){
        $month = Carbon::parse($r->date)->format('m');
        $bill=Bill::leftjoin('client','bill.fkclientId','client.clientId')->where(DB::raw('month(billdate)'),$month)->where('client.clientId',$r->id)->first();
        $bill->status = 'p';
        $bill->save();
        $report = new Report();
        $report->status = ACCOUNT_STATUS['Credit'];
        $report->price = $bill->price;
        $report->tabelId = $bill->billId;
        $report->date = $bill->billdate;
        $report->tableName = 'bill';
        $report->save();
        $message='Monthly bill of '.$r->date.' has been paid successfully for client Name '.$bill->clientFirstName.' '.$bill->clientLastName;
        return  $message;
    }
    public function due(Request $r){
//        $client = Client::findOrFail($r->id);
        $month = Carbon::parse($r->date)->format('m');
        $bill=Bill::leftjoin('client','bill.fkclientId','client.clientId')->where(DB::raw('month(billdate)'),$month)->where('client.clientId',$r->id)->first();
        $bill->status = 'np';
        $bill->save();
        $report = Report::where('tabelId' , $bill->billId)
            ->where('tableName', 'bill')->delete();
        $message='Monthly bill of '.$r->date.' for client Name '.$bill->clientFirstName.' '.$bill->clientLastName.' has been changed to unpaid';
        return  $message;
    }
    public function generatePdf(){

//        $userName='techcloud';
//        $password='tcl@it404$';
//        $brand='TECH CLOUD';
        $destination='01680674598';
        $sms='Test SMS From TCL API';

//        $arrContextOptions=array(
//            "ssl"=>array(
//                "verify_peer"=>false,
//                "verify_peer_name"=>false,
//            ),
//        );

        $smsConfig=SmsConfig::select('userName','password','brandName','sms_rate')->first();
        $userName=$smsConfig->userName;
        $password=$smsConfig->password;
        $brand=$smsConfig->brandName;
        $rate= (float)($smsConfig->sms_rate);
        //  return $smsConfig;

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $sms="Dear valued Client, Please Pay your Internet Bill Within 10th ".date('F')." ".date('Y')." Otherwise your connection will disconnect. Please ignore if you already paid.";

        $json = file_get_contents("https://msms.techcloudltd.com/pages/RequestSMS.php?user_name=".urlencode($userName)."&pass_word=".urlencode($password)."&brand=".urlencode($brand)."&type=1&destination=".urlencode($destination)."&sms=".urlencode($sms), false, stream_context_create($arrContextOptions));


        //   $json = file_get_contents("https://msms.techcloudltd.com/pages/RequestSMS.php?user_name=".urlencode($userName)."&pass_word=".urlencode($password)."&brand=".urlencode($brand)."&type=1&destination=".urlencode($destination)."&sms=".urlencode($sms) , false, stream_context_create($arrContextOptions));
//        $json = file_get_contents('https://msms.techcloudltd.com/pages/RequestSMS.php?user_name='.$userName.'&pass_word='.$password.'&brand='.$brand.'&type=1&destination='.$destination.'&sms='.$sms);
//        $json = file_get_contents('https://msms.techcloudltd.com/pages/RequestBalance.php?user_name='.$userName.'&pass_word='.$password); /* balance api*/
//        $json = file_get_contents('https://msms.techcloudltd.com/pages/RequestSMS.php?user_name=techcloud&pass_word=tcl@it404$&brand=TECH%20CLOUD&type=1&destination=01680674598&sms=Test%20SMS%20From%20TCL%20API');
        return $json;
    }
    /* internet Bill */
    public function internetBillShow(){
        $date=Carbon::now()->format('F-Y');
        $package = Package::get();
        $users=User::where('fkusertype','InternetEmp')->get();


        $internetClient=InternetClient::where('internet_client.clientStatus',2)->count('internet_client.clientId');

        $json="";
        $n = SmsCheckMonth::select('deliveryStatus')->where(DB::raw('month(date)'), date('m') )->where(DB::raw('Year(date)'), date('Y') )
            ->where(function($query) {
            $query->where('type',1)
                ->orWhere('type',2)
                ->orWhere('type',3);
        })->first();

        if ($n){

            if ($n->deliveryStatus==409){
                $json="Sms Wasn't Sent Successfully Please contact with Provider";
            }

        }else{

            $json="";
        }


        return view('bill.internet.show', compact('package','date','internetClient','json','users'));

    }
    public function internetBillShowWithData(Request $r){

        $bill = InternetBill::select('internet_bill.billId as internetBillId','internet_bill.fkclientId','internet_bill.partial',
            'internet_bill.discount','internet_client.clientFirstName',
            'internet_client.clientLastName','internet_client.phone','internet_client.clientSerial','internet_bill.price as billprice',
            'internet_bill.billId',DB::raw('DATE_FORMAT(internet_bill.billdate,"%M-%Y") as billdate'),
            'internet_client.bandWide', 'package.packageName','internet_bill.status as billStatus','user.name')
            ->leftjoin('internet_client','internet_bill.fkclientId','internet_client.clientId')
            ->leftjoin('package','package.packageId','internet_client.fkpackageId')
            ->leftjoin('user','user.userId','internet_bill.receivedBy')
            ->where('internet_client.clientStatus',2);
        if ($r->billMonth){
            $month = Carbon::parse($r->billMonth)->format('m');
            $bill= $bill->where(DB::raw('month(internet_bill.billdate)'),$month);
        }
        if ($r->pastDue){
            $bill= $bill->where('internet_bill.status','np');
        }
        if ($r->pastRecieved){
            $bill= $bill->where('internet_bill.status','ap');
        }
        if ($r->pastDueClient){

            $bill= $bill->where('internet_bill.fkclientId',$r->pastDueClient);
        }

        if($r->emp){
            $bill= $bill->where('internet_bill.receivedBy',$r->emp);
        }
        if($r->statusId){
            $bill= $bill->where('internet_bill.status',$r->statusId);
        }

        $datatables = DataTables::of($bill)->with('total', $bill->count('internet_client.clientId'));
        return $datatables->make(true);
    }
    public function internetBillPaid(Request $r){

        $month = Carbon::parse($r->date)->format('m');
        $bill=InternetBill::leftjoin('internet_client','internet_bill.fkclientId','internet_client.clientId')
            ->where(DB::raw('month(internet_bill.billdate)'),$month)
            ->where('internet_client.clientId',$r->id)->first();
        $bill->status = 'p';
        $bill->receivedBy = Auth::user()->userId;
        $bill->receiveDate=date('Y-m-d');
        $bill->partial = $bill->price;
        $bill->discount = 0;
        $bill->save();

        $report=Report::where('date',$bill->billdate)->where('tabelId',$bill->billId)
            ->where('tableName','internet_bill')->where('status',ACCOUNT_STATUS['Credit'])->first();

        if (!$report) {
            $report = new Report();
        }

        // $report = new Report();
        $report->status = ACCOUNT_STATUS['Credit'];
        $report->price = $bill->price;
        $report->tabelId = $bill->billId;
        $report->date = $bill->billdate;
        $report->tableName = 'internet_bill';
        $report->partial = $bill->price;
        $report->discount = 0;
        $report->save();


        $smsConfig=SmsConfig::select('userName','password','brandName','sms_rate')->first();
        $userName=$smsConfig->userName;
        $password=$smsConfig->password;
        $brand=$smsConfig->brandName;
        $rate= (float)($smsConfig->sms_rate);
        //  return $smsConfig;

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $sms="Dear valued Client, Your Internet Bill of ".date('F')." ".date('Y'). "-" . $bill->price ." has been paid successfully.";

        $json = file_get_contents("https://msms.techcloudltd.com/pages/RequestSMS.php?user_name=".urlencode($userName)."&pass_word=".urlencode($password)."&brand=".urlencode($brand)."&type=1&destination=".urlencode($bill->phone)."&sms=".urlencode($sms), false, stream_context_create($arrContextOptions));

        //return $json;
        $data=array();

        if (substr($json, 0, 3)== "404" || substr($json, 0, 3)== "405" ){

            $data=array(
                'message'=>'Wrong User Name or password of Sms Config!',
            );

            //  return back()->with('message', 'Wrong User Name or password of Sms Config!');
        }elseif (substr($json, 0, 3)== "407"){

            $data=array(
                'message'=>'Wrong Brand Name of Sms Config!',
            );

            // return back()->with('message', 'Wrong Brand Name of Sms Config!');
        }elseif (substr($json, 0, 3)== "409"){

            $data=array(
                'message'=>'sms Sent cancelled for insufficient balance!',
            );

            // return back()->with('message', 'sms Sent cancelled for insufficient balance!');
        }elseif (substr($json, 0, 3)== "400"){

            $data=array(
                'message'=>'Sms Send SuccessFully!',
            );
            // return back()->with('message', 'Sms Send SuccessFully!');
        }elseif (substr($json, 0, 3)== "408"){

            $data=array(
                'message'=>'Invalid number!',
            );
            // return back()->with('message', 'Invalid number!');
        }else{

            $data=array(
                'message'=>'bill paid',
            );

            // $message='Monthly Cable bill of '.$r->date.' has been paid successfully for client Name '.$bill->clientFirstName.' '.$bill->clientLastName;
            //return  $data;

        }

        return $data;


//        $message='Monthly Internet bill of '.$r->date.' has been paid successfully for client Name '.$bill->clientFirstName.' '.$bill->clientLastName;
//        return  $message;
    }
    public function generateInternetPdf($id,$date){
        $clientId=$id;
        $client=InternetClient::leftJoin('package','package.packageId','internet_client.fkpackageId')->findOrFail($clientId);
        $company=Company::first();
        $pdf = PDF::Make();
        $pdf->SetDirectionality('ltr');
        $pdf->loadView('bill.internet.pdf',compact('client','company','date'));
        return $pdf->stream('bill' . '.pdf', array('Attachment' => 0));
    }
    public function generateAllInternetBillPdf($date){
        $month = Carbon::parse($date)->format('m');
        $client=InternetBill::leftJoin('internet_client','internet_bill.fkclientId','internet_client.clientId')->leftJoin('package','package.packageId','internet_client.fkpackageId')->where(DB::raw('month(internet_bill.billdate)'),$month)->get();
        $company=Company::first();
        $pdf = PDF::Make();
        $pdf->SetDirectionality('ltr');
        $pdf->loadView('bill.internet.allBillPdf',compact('client','company','date'));
        return $pdf->stream('bill' . '.pdf', array('Attachment' => 0));
    }

    public function internetBillDue(Request $r){
        $month = Carbon::parse($r->date)->format('m');
        $bill=InternetBill::leftjoin('internet_client','internet_bill.fkclientId','internet_client.clientId')
            ->where(DB::raw('month(internet_bill.billdate)'),$month)
            ->where('internet_client.clientId',$r->id)->first();
        $bill->status = 'np';
        $bill->partial = null;
        $bill->discount = null;
        $bill->save();
        $report = Report::where('tabelId' , $bill->billId)
            ->where('tableName', 'internet_bill')->delete();
        $message='Monthly Internet bill of '.$r->date.' for client Name '.$bill->clientFirstName.' '.$bill->clientLastName.' has been changed to unpaid';
        return  $message;
    }
    public function internetBillRecieved(){

        $date=Carbon::now()->format('F-Y');


        return view('bill.internet.showBillRecieved', compact('date'));
    }


    /*Cable Bill */
    public function cableBillShow(){
        $date=Carbon::now()->subMonth()->format('F-Y');
        $package = CablePackage::get();
        $cableClient=CableClient::where('cable_client.clientStatus',2)->count('cable_client.clientId');
        $users=User::where('fkusertype','CableEmp')->get();


        $json="";
        $n = SmsCheckMonth::select('deliveryStatus')->where(DB::raw('month(date)'), date('m') )->where(DB::raw('Year(date)'), date('Y') )
            ->where(function($query) {
                $query->where('type',1)
                    ->orWhere('type',2)
                    ->orWhere('type',3);
            })->first();

        if ($n){

            if ($n->deliveryStatus==409){
                $json="Sms Wasn't Sent Successfully Please contact with Provider";
            }

        }else{

            $json="";
        }

        return view('bill.cable.show', compact('package','date','cableClient','json','users'));

    }
    public function cableBillShowWithData(Request $r){


        $bill = CableBill::select('cable_bill.fkclientId','cable_client.clientFirstName','cable_client.clientSerial','cable_client.clientLastName','cable_client.phone',
            'cable_bill.price as billprice','cable_bill.billId',DB::raw('DATE_FORMAT(cable_bill.billdate,"%M-%Y") as billdate'),
            'cable_bill.status as billStatus','user.name','cable_bill.partial','cable_bill.billId as cableBillId',
            'cable_bill.discount')
            ->leftjoin('cable_client','cable_bill.fkclientId','cable_client.clientId')
            ->leftjoin('user','user.userId','cable_bill.receivedBy')
            ->where('cable_client.clientStatus',2);
        if ($r->billMonth){
            $month = Carbon::parse($r->billMonth)->format('m');
            $bill= $bill->where(DB::raw('month(cable_bill.billdate)'),$month);
        }
        if ($r->pastDue){
            $bill= $bill->where('cable_bill.status','np');
        }
        if ($r->pastRecieved){
            $bill= $bill->where('cable_bill.status','ap');
        }
        if ($r->pastDueClient){

            $bill= $bill->where('cable_bill.fkclientId',$r->pastDueClient);
        }
        if($r->emp){
            $bill= $bill->where('cable_bill.receivedBy',$r->emp);
        }
        if($r->statusId){
            $bill= $bill->where('cable_bill.status',$r->statusId);
        }

        $datatables = DataTables::of($bill)->with('total', $bill->count('cable_client.clientId'));
        return $datatables->make(true);

    }
    public function cableBillPaid(Request $r){

        $month = Carbon::parse($r->date)->format('m');
        $bill=CableBill::select('cable_bill.*','cable_client.clientId','cable_client.phone','cable_client.clientFirstName','cable_client.clientLastName')->leftjoin('cable_client','cable_bill.fkclientId','cable_client.clientId')->where(DB::raw('month(cable_bill.billdate)'),$month)->where('cable_client.clientId',$r->id)->first();
        $bill->status = 'p';
        $bill->receivedBy = Auth::user()->userId;
        $bill->receiveDate=date('Y-m-d');
        $bill->partial = $bill->price;
        $bill->discount = 0;
        $bill->save();

        $report=Report::where('date',$bill->billdate)->where('tabelId',$bill->billId)
            ->where('tableName','cable_bill')->where('status',ACCOUNT_STATUS['Credit'])->first();

        if (!$report) {
            $report = new Report();
        }

       // $report = new Report();
        $report->status = ACCOUNT_STATUS['Credit'];
        $report->price = $bill->price;
        $report->tabelId = $bill->billId;
        $report->date = $bill->billdate;
        $report->tableName = 'cable_bill';
        $report->partial = $bill->price;
        $report->discount = 0;
        $report->save();

        $smsConfig=SmsConfig::select('userName','password','brandName','sms_rate')->first();
        $userName=$smsConfig->userName;
        $password=$smsConfig->password;
        $brand=$smsConfig->brandName;
        $rate= (float)($smsConfig->sms_rate);
        //  return $smsConfig;

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $sms="Dear valued Client, Your Cable Bill of ".date('F')." ".date('Y'). "-" . $bill->price ." has been paid successfully.";

        $json = file_get_contents("https://msms.techcloudltd.com/pages/RequestSMS.php?user_name=".urlencode($userName)."&pass_word=".urlencode($password)."&brand=".urlencode($brand)."&type=1&destination=".urlencode($bill->phone)."&sms=".urlencode($sms), false, stream_context_create($arrContextOptions));

        //return $json;
        $data=array();

        if (substr($json, 0, 3)== "404" || substr($json, 0, 3)== "405" ){

            $data=array(
                'message'=>'Wrong User Name or password of Sms Config!',
            );

          //  return back()->with('message', 'Wrong User Name or password of Sms Config!');
        }elseif (substr($json, 0, 3)== "407"){

            $data=array(
                'message'=>'Wrong Brand Name of Sms Config!',
            );

           // return back()->with('message', 'Wrong Brand Name of Sms Config!');
        }elseif (substr($json, 0, 3)== "409"){

            $data=array(
                'message'=>'sms Sent cancelled for insufficient balance!',
            );

           // return back()->with('message', 'sms Sent cancelled for insufficient balance!');
        }elseif (substr($json, 0, 3)== "400"){

            $data=array(
                'message'=>'Sms Send SuccessFully!',
            );
           // return back()->with('message', 'Sms Send SuccessFully!');
        }elseif (substr($json, 0, 3)== "408"){

            $data=array(
                'message'=>'Invalid number!',
            );
           // return back()->with('message', 'Invalid number!');
        }else{

            $data=array(
                'message'=>'bill paid',
            );

            // $message='Monthly Cable bill of '.$r->date.' has been paid successfully for client Name '.$bill->clientFirstName.' '.$bill->clientLastName;
            //return  $data;

        }

        return $data;




    }
    public function cableBillDue(Request $r){

        $month = Carbon::parse($r->date)->format('m');
        $bill=CableBill::select('cable_bill.*','cable_client.clientId')->leftjoin('cable_client','cable_bill.fkclientId','cable_client.clientId')->where(DB::raw('month(cable_bill.billdate)'),$month)->where('cable_client.clientId',$r->id)->first();
        $bill->status = 'np';
        $bill->partial = null;
        $bill->discount = null;
        $bill->save();

        $report = Report::where('tabelId' , $bill->billId)
            ->where('tableName', 'cable_bill')->delete();

        $message='Monthly Cable bill of '.$r->date.' for client Name '.$bill->clientFirstName.' '.$bill->clientLastName.' has been changed to unpaid';
        return  $message;
    }
    public function generateCablePdf($id,$date){
        $clientId=$id;
        $client=CableClient::findOrFail($clientId);
        $company=Company::first();
        $pdf = PDF::Make();
        $pdf->SetDirectionality('ltr');
        $pdf->loadView('bill.cable.pdf',compact('client','company','date'));
        return $pdf->stream('bill' . '.pdf', array('Attachment' => 0));
    }
    public function generateAllCableBillPdf($date){
        $month = Carbon::parse($date)->format('m');
        $client=CableBill::leftJoin('cable_client','cable_bill.fkclientId','cable_client.clientId')->leftJoin('cablepackage','cablepackage.cablepackageId','cable_client.fkpackageId')->where(DB::raw('month(cable_bill.billdate)'),$month)->get();
        $company=Company::first();
        $pdf = PDF::Make();
        $pdf->SetDirectionality('ltr');
        $pdf->loadView('bill.cable.allBillPdf',compact('client','company','date'));
        return $pdf->stream('bill' . '.pdf');
    }
    public function showCablePastDue(){
        return view('bill.cable.showPastDue');
    }

    public function approvedCable(Request $r){
        $bill=CableBill::findOrFail($r->primaryId);
        $bill->status="ap";
        $bill->save();

        $report = new Report();
        $report->status = ACCOUNT_STATUS['Credit'];
        $report->price = $bill->price;
        $report->tabelId = $bill->billId;
        $report->date = $bill->billdate;
        $report->tableName = 'cable_bill';
        $report->save();


        return $r;
    }
    public function approvedInternet(Request $r){
        $bill=InternetBill::findOrFail($r->primaryId);
        $bill->status="ap";
        $bill->save();

        $report = new Report();
        $report->status = ACCOUNT_STATUS['Credit'];
        $report->price = $bill->price;
        $report->tabelId = $bill->billId;
        $report->date = $bill->billdate;
        $report->tableName = 'internet_bill';
        $report->save();


        return $r;
    }

    public function cableBillRecieved(){

        $date=Carbon::now()->format('F-Y');

        return view('bill.cable.showBillRecieved', compact('date'));
    }
    public function clientPastDueMonth(Request $r){

         $clientId=$r->clientId;

        return view('bill.internet.showPastDueForClient',compact('clientId'));


    }
    public function cableClientPastDueMonth(Request $r){

         $clientId=$r->clientId;

        return view('bill.cable.showPastDueForClient',compact('clientId'));


    }
    public function clientBillPay(Request $r){

       // return $r;

        for ($i=0;$i<count($r->rowid);$i++){

            $bill=InternetBill::leftJoin('internet_client','internet_bill.fkclientId','internet_client.clientId')->findOrFail($r->rowid[$i]);

            $partialArr=explode("+",$bill->partial);
            $discountArr=explode("+",$bill->discount);
            $par=array_sum($partialArr);
            $dis=array_sum($discountArr);

            if ($bill->price !=null){
                if (($par+$dis) >= $bill->price){
                    $bill->status = 'p';
                }else{
                    $bill->status = 'np';
                }
            }else{
                $bill->status = 'np';
            }


            if ($r->amount[$i] != null){
                if ($bill->partial != null){
                    $bill->partial = $bill->partial."+".$r->amount[$i];
                }else{
                    $bill->partial = $r->amount[$i];
                }

            }else{
//                $num = 0;
//                $bill->partial = $bill->partial;
            }
            if ($r->discount[$i] != null){
                if ($bill->discount != null){
                    $bill->discount = $bill->discount."+".$r->discount[$i];
                }else{
                    $bill->discount = $r->discount[$i];
                }

            }else{
//                $num = 0;
//                $bill->discount = $bill->discount;
            }

            $bill->receivedBy = Auth::user()->userId;
            $bill->receiveDate=date('Y-m-d');
            $bill->save();



            $report=Report::where('date',$bill->billdate)->where('tabelId',$bill->billId)
                ->where('tableName','internet_bill')->where('status',ACCOUNT_STATUS['Credit'])->first();

            if (!$report) {
                $report = new Report();
            }

        $report->status = ACCOUNT_STATUS['Credit'];
        $report->price = $bill->price;
        $report->tabelId = $bill->billId;
        $report->date = $bill->billdate;
        $report->partial = $r->amount[$i];
        $report->discount = $r->discount[$i];
        $report->tableName = 'internet_bill';
        $report->save();

        }

        $smsConfig=SmsConfig::select('userName','password','brandName','sms_rate')->first();
        $userName=$smsConfig->userName;
        $password=$smsConfig->password;
        $brand=$smsConfig->brandName;
        $rate= (float)($smsConfig->sms_rate);
        //  return $smsConfig;

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $sms="Dear valued Client, Your Internet Bill of ".date('F')." ".date('Y'). "-" . $par ." has been paid successfully with discount $dis. Total due remaining this month is ".($bill->price-($par+$dis)).".";

        $json = file_get_contents("https://msms.techcloudltd.com/pages/RequestSMS.php?user_name=".urlencode($userName)."&pass_word=".urlencode($password)."&brand=".urlencode($brand)."&type=1&destination=".urlencode($bill->phone)."&sms=".urlencode($sms), false, stream_context_create($arrContextOptions));


        if (substr($json, 0, 3)== "404" || substr($json, 0, 3)== "405" ){

            return back()->with('message', 'Wrong User Name or password of Sms Config!');
        }elseif (substr($json, 0, 3)== "407"){

            return back()->with('message', 'Wrong Brand Name of Sms Config!');
        }elseif (substr($json, 0, 3)== "409"){

            return back()->with('message', 'sms Sent cancelled for insufficient balance!');
        }elseif (substr($json, 0, 3)== "400"){

            return back()->with('message', 'Sms Send SuccessFully!');
        }elseif (substr($json, 0, 3)== "408"){

            return back()->with('message', 'Invalid number!');
        }else{
            return back();
        }


        // return back();


    }
    public function cableClientBillPay(Request $r){



        for ($i=0;$i<count($r->rowid);$i++){

            $bill=CableBill::leftJoin('cable_client','cable_bill.fkclientId','cable_client.clientId')->findOrFail($r->rowid[$i]);

            $partialArr=explode("+",$bill->partial);
            $discountArr=explode("+",$bill->discount);
            $par=array_sum($partialArr);
            $dis=array_sum($discountArr);

            if ($bill->price !=null) {
                if (($par + $dis) >= $bill->price) {
                    $bill->status = 'p';
                } else {
                    $bill->status = 'np';
                }
            }else{
                $bill->status = 'np';
            }


            if ($r->amount[$i] != null){
                if ($bill->partial != null){
                    $bill->partial = $bill->partial."+".$r->amount[$i];
                }else{
                    $bill->partial = $r->amount[$i];
                }

            }else{
//                $num = 0;
//                $bill->partial = $bill->partial;
            }
            if ($r->discount[$i] != null){
                if ($bill->discount != null){
                    $bill->discount = $bill->discount."+".$r->discount[$i];
                }else{
                    $bill->discount = $r->discount[$i];
                }

            }else{
//                $num = 0;
//                $bill->discount = $bill->discount;
            }

            $bill->receivedBy = Auth::user()->userId;
            $bill->receiveDate=date('Y-m-d');
            $bill->save();



            $report=Report::where('date',$bill->billdate)->where('tabelId',$bill->billId)
                ->where('tableName','cable_bill')->where('status',ACCOUNT_STATUS['Credit'])->first();

            if (!$report) {
                $report = new Report();
            }

        $report->status = ACCOUNT_STATUS['Credit'];
        $report->price = $bill->price;
        $report->tabelId = $bill->billId;
        $report->date = $bill->billdate;
        $report->partial = $r->amount[$i];
        $report->discount = $r->discount[$i];
        $report->tableName = 'cable_bill';
        $report->save();

        }

        $smsConfig=SmsConfig::select('userName','password','brandName','sms_rate')->first();
        $userName=$smsConfig->userName;
        $password=$smsConfig->password;
        $brand=$smsConfig->brandName;
        $rate= (float)($smsConfig->sms_rate);
        //  return $smsConfig;

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $sms="Dear valued Client, Your Cable Bill of ".date('F')." ".date('Y'). "-" . $par ." has been paid successfully with discount $dis.Total due remaining this month is ".($bill->price-($par+$dis)).".";

        $json = file_get_contents("https://msms.techcloudltd.com/pages/RequestSMS.php?user_name=".urlencode($userName)."&pass_word=".urlencode($password)."&brand=".urlencode($brand)."&type=1&destination=".urlencode($bill->phone)."&sms=".urlencode($sms), false, stream_context_create($arrContextOptions));

        //return $json;

        if (substr($json, 0, 3)== "404" || substr($json, 0, 3)== "405" ){

            return back()->with('message', 'Wrong User Name or password of Sms Config!');
        }elseif (substr($json, 0, 3)== "407"){

            return back()->with('message', 'Wrong Brand Name of Sms Config!');
        }elseif (substr($json, 0, 3)== "409"){

            return back()->with('message', 'sms Sent cancelled for insufficient balance!');
        }elseif (substr($json, 0, 3)== "400"){

            return back()->with('message', 'Sms Send SuccessFully!');
        }elseif (substr($json, 0, 3)== "408"){

            return back()->with('message', 'Invalid number!');
        }else{
            return back();
        }

        //return back();


    }
}