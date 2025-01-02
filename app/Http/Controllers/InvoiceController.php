<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    //
    public function InvoicePage()
    {
        //function_body
        return view('pages.dashboard.invoice-page');
    }
    public function SalePage()
    {
        //function_body
        return view('pages.dashboard.sale-page');
    }

    public function InvoiceCreate(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_id = $request->header('id');
            $total = $request->input('total');
            $discount = $request->input('discount');
            $vat = $request->input('vat');
            $payable = $request->input('payable');
            $customer_id = $request->input('customer_id');

            $invoice = Invoice::create([
                'total' => $total,
                'discount' => $discount,
                'vat' => $vat,
                'payable' => $payable,
                'user_id' => $user_id,
                'customer_id' => $customer_id
            ]);

            $invoiceID = $invoice->id;
            $products = $request->input('products');
            foreach ($products as $eachProducts) {
                InvoiceProduct::create([
                    "invoice_id" => $invoiceID,
                    "user_id" => $user_id,
                    "product_id" => $eachProducts['product_id'],
                    "qty" => $eachProducts['qty'],
                    "sale_price" => $eachProducts['sale_price']
                ]);
            }

            DB::commit();
            return 1;
        } catch (Exception $e) {
            DB::rollBack();
            return 0;
        }
    }

    public function InvoiceSelect(Request $request)
    {
        //function_body
        $user_id = $request->header('id');

        return Invoice::where('user_id', $user_id)->with('customer')->get();
    }

    public function InvoiceDetails(Request $request)
    {
        $user_id = $request->header('id');
        $customerDetails = Customer::where('user_id', $user_id)->where('id', $request->input('cus_id'))->first();
        $invoiceTotal = Invoice::where('user_id', $user_id)->where('id', $request->input('inv_id'))->first();
        $invoiceProduct = InvoiceProduct::where('invoice_id', $request->input('inv_id'))->where('user_id', $user_id)->with('product')->get();
        return [
            'customer'=>$customerDetails,
            "invoice"=>$invoiceTotal,
            'product'=>$invoiceProduct
        ];
    }

    public function InvoiceDelete(Request $request)
    {
        DB::beginTransaction();
        try{
            $user_id = $request->header('id');
            InvoiceProduct::where('invoice_id',$request->input('inv_id'))->where('user_id',$user_id)->delete();
            Invoice::where('id', $request->input('inv_id'))->delete();
            DB::commit();
            return 1;
        }catch(Exception $e){
        DB::rollBack();
        return 0;
        }
    }
}
