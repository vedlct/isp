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

        $userName="techcloud";
        $password="tcl@it404$";
        $brand="TECH%20CLOUD";
        $destination="01731893442";
        $sms="Test%20SMS%20From%20TCL%20API";
        $json = file_get_contents('https://msms.techcloudltd.com/msms-new/pages/RequestSMS.php?user_name='.$userName.'&pass_word='.$password.'&brand='.$brand.'&type=1&destination='.$destination.'&sms='.$sms);
//        $json = file_get_contents('https://msms.techcloudltd.com/pages/RequestBalance.php?user_name='.$userName.'&pass_word='.$password.''); /* balance api*/
//        $json = json_decode(file_get_contents('https://msms.techcloudltd.com/msms-new/pages/RequestSMS.php?user_name=techcloud&pass_word=tcl@it404$&brand=TECH%20CLOUD&type=1&destination=01616404404&sms=Test%20SMS%20From%20TCL%20API'), true);
        return $json;
    }
    /* internet Bill */
    public function internetBillShow(){
        $date=Carbon::now()->format('F-Y');
        $package = Package::get();
        $users=User::where('fkusertype','InternetEmp')->get();


        $internetClient=InternetClient::where('internet_client.clientStatus',2)->count('internet_client.clientId');


        $n = SmsCheckMonth::select('deliveryStatus')->where(DB::raw('month(date)'), date('m') )->where(DB::raw('Year(date)'), date('Y') )->where('type',2)->first();

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
        $bill = InternetBill::select('internet_bill.fkclientId','internet_client.clientFirstName',
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
        $bill->save();


        $message='Monthly Internet bill of '.$r->date.' has been paid successfully for client Name '.$bill->clientFirstName.' '.$bill->clientLastName;
        return  $message;
    }
    public function generateInternetPdf($id,$date){
        $clientId=$id;
        $client=InternetClient::leftJoin('package','package.packageId','internet_client.fkpackageId')->findOrFail($clientId);
        $company=Company::first();
        $pdf = PDF::loadView('bill.pdf',compact('client','company','date'));
        return $pdf->stream('bill' . '.pdf', array('Attachment' => 0));
    }
    public function generateAllInternetBillPdf($date){
        $month = Carbon::parse($date)->format('m');
        $client=InternetBill::leftJoin('internet_client','internet_bill.fkclientId','internet_client.clientId')->leftJoin('package','package.packageId','internet_client.fkpackageId')->where(DB::raw('month(internet_bill.billdate)'),$month)->get();
        $company=Company::first();
        $pdf = PDF::loadView('bill.internet.allBillPdf',compact('client','company','date'));
        return $pdf->stream('bill' . '.pdf', array('Attachment' => 0));
    }

    public function internetBillDue(Request $r){
        $month = Carbon::parse($r->date)->format('m');
        $bill=InternetBill::leftjoin('internet_client','internet_bill.fkclientId','internet_client.clientId')
            ->where(DB::raw('month(internet_bill.billdate)'),$month)
            ->where('internet_client.clientId',$r->id)->first();
        $bill->status = 'np';
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

        return view('bill.cable.show', compact('package','date','cableClient','users'));

    }
    public function cableBillShowWithData(Request $r){


        $bill = CableBill::select('cable_bill.fkclientId','cable_client.clientFirstName','cable_client.clientSerial','cable_client.clientLastName','cable_client.phone',
            'cable_bill.price as billprice','cable_bill.billId',DB::raw('DATE_FORMAT(cable_bill.billdate,"%M-%Y") as billdate'),
            'cable_bill.status as billStatus','user.name')
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
        $datatables = DataTables::of($bill)->with('total', $bill->count('cable_client.clientId'));
        return $datatables->make(true);

    }
    public function cableBillPaid(Request $r){
        $month = Carbon::parse($r->date)->format('m');
        $bill=CableBill::select('cable_bill.*','cable_client.clientId')->leftjoin('cable_client','cable_bill.fkclientId','cable_client.clientId')->where(DB::raw('month(cable_bill.billdate)'),$month)->where('cable_client.clientId',$r->id)->first();
        $bill->status = 'p';
        $bill->receivedBy = Auth::user()->userId;
        $bill->receiveDate=date('Y-m-d');
        $bill->save();

//        $report = new Report();
//        $report->status = ACCOUNT_STATUS['Credit'];
//        $report->price = $bill->price;
//        $report->tabelId = $bill->billId;
//        $report->date = $bill->billdate;
//        $report->tableName = 'cable_bill';
//        $report->save();

        $message='Monthly Cable bill of '.$r->date.' has been paid successfully for client Name '.$bill->clientFirstName.' '.$bill->clientLastName;
        return  $message;
    }
    public function cableBillDue(Request $r){
        $month = Carbon::parse($r->date)->format('m');
        $bill=CableBill::select('cable_bill.*','cable_client.clientId')->leftjoin('cable_client','cable_bill.fkclientId','cable_client.clientId')->where(DB::raw('month(cable_bill.billdate)'),$month)->where('cable_client.clientId',$r->id)->first();
        $bill->status = 'np';
        $bill->save();

//        $report = Report::where('tabelId' , $bill->billId)
//            ->where('tableName', 'cable_bill')->delete();
        $message='Monthly Cable bill of '.$r->date.' for client Name '.$bill->clientFirstName.' '.$bill->clientLastName.' has been changed to unpaid';
        return  $message;
    }
    public function generateCablePdf($id,$date){
        $clientId=$id;
        $client=CableClient::findOrFail($clientId);
        $company=Company::first();
        $pdf = PDF::loadView('bill.cable.pdf',compact('client','company','date'));
        return $pdf->stream('bill' . '.pdf', array('Attachment' => 0));
    }
    public function generateAllCableBillPdf($date){
        $month = Carbon::parse($date)->format('m');
        $client=CableBill::leftJoin('cable_client','cable_bill.fkclientId','cable_client.clientId')->leftJoin('cablepackage','cablepackage.cablepackageId','cable_client.fkpackageId')->where(DB::raw('month(cable_bill.billdate)'),$month)->get();
        $company=Company::first();
        $pdf = PDF::loadView('bill.cable.allBillPdf',compact('client','company','date'));
        return $pdf->stream('bill' . '.pdf', array('Attachment' => 0));
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
}