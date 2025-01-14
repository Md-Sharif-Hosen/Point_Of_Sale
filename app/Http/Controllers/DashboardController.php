<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    //
    public function DashboardPage():view
    {
        return view('pages.dashboard.dashboard-page');
    }

    public function Summary(Request $request)
    {
    $user_id=$request->header('id');

    $product=Product::where('user_id',$user_id)->count();
    $category=Category::where('user_id',$user_id)->count();
    $customer=Customer::where('user_id',$user_id)->count();
    $invoice=Invoice::where('user_id',$user_id)->count();
    $total=Invoice::where('user_id',$user_id)->sum('total');
    $vat=Invoice::where('user_id',$user_id)->sum('vat');
    $payable=Invoice::where('user_id',$user_id)->sum('payable');

    $salesData=Invoice::where('user_id',$user_id)
       ->selectRaw('DATE(created_at) as date, SUM(total) as total')
       ->groupBy('date')
       ->orderBy('date','desc')
       ->take(7)
       ->get();

    return[
        'product'=>$product,
        'category'=>$category,
        'customer'=>$customer,
        'invoice'=>$invoice,
        'total'=>$total,
        'vat'=>$vat,
        'payable'=>$payable,
        'salesData'=>$salesData
    ];
    }
}
