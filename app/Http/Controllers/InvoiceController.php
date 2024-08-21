<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}

