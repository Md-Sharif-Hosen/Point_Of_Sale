<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    //
 function ReportPage()
    {
        return view('pages.dashboard.report-page');
    }
//    function SalesReport(Request $request)
//     {

//         $user_id = $request->header('id');
//         $FormDate = date('Y-m-d', strtotime($request->FormDate));
//         $ToDate = date('Y-m-d', strtotime($request->ToDate));

//         $total = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('total');
//         $vat = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('vat');
//         $payable = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('payable');
//         $discount = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('discount');


//         $list = Invoice::where('user_id', $user_id)
//             ->whereDate('created_at', '>=', $FormDate)
//             ->whereDate('created_at', '<=', $ToDate)
//             ->with('customer')->get();


//         $data = [
//             'payable' => $payable,
//             'discount' => $discount,
//             'total' => $total,
//             'vat' => $vat,
//             'list' => $list,
//             'FormDate' => $request->FormDate,
//             'ToDate' => $request->FormDate
//         ];

//         $pdf = Pdf::loadView('pages.report.salesreport', $data);

//         return $pdf->download('invoice.pdf');
//     }
public function SalesReport( Request $request)
{
    $user_id=$request->header('id');
    $FormDate=date('Y-m-d',strtotime($request->FormDate));
    $ToDate=date('Y-m-d',strtotime($request->ToDate));

    $invoices=Invoice::where('user_id',$user_id)
            ->whereDate('created_at','>=',$FormDate)
            ->whereDate('created_at','<=',$ToDate)
            ->with('customer')
            ->get();
    if($invoices->isEmpty()){
        return response()->json(['error'=>'No Invoice found for the selected data range',404]);
    }
   $total=$invoices->sum('total');
   $vat=$invoices->sum('vat');
   $payable=$invoices->sum('payable');
   $discount=$invoices->sum('discount');

   $data=[
    'payable'=>$payable,
    'vat'=>$vat,
    'total'=>$total,
    'discount'=>$discount,
    'list'=>$invoices,
    'FormDate'=>$request->FormDate,
    'ToDate'=>$request->ToDate
   ];

   $pdf=Pdf::loadView('pages.report.salesreport',$data);
   return $pdf->download('invoice.pdf');

}

}
