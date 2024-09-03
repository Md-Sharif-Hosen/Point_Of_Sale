<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function CustomerPage()
    {
        return view('pages.dashboard.customer-page');
    }

    public function CustomerList(Request $request)
    {
        //function_body
        $user_id = $request->header('id');
        return Customer::where('user_id', $user_id)->get();
        //     dd($customer->toArray());
    }

    public function CustomerCreate(Request $request)
    {
        //function_body
        $user_id = $request->header('id');
        return Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'user_id' => $user_id
        ]);
        // return response()->json([
        //    'status' => 'success',
        //    'message' => 'Customer created successfully',
        //     'data' => $customer
        // ], 201);
    }

    public function CustomerByID(Request $request)
    {
        //function_body
        $customer_id = $request->input('id');
        $user_id = $request->header('id');
        return Customer::where('id', $customer_id)->where('user_id', $user_id)->first();
    }

    public function CustomerUpdate(Request $request)
    {
        //function_body


        $customer_id = $request->input('id');
        $user_id = $request->header('id');
        return Customer::where('id', $customer_id)->where('user_id', $user_id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile')
        ]);
    }
    public function CustomerDelete(Request $request)
    {
        //function_body
        $customer_id = $request->input('id');
        $user_id = $request->header('id');
        return Customer::where('id', $customer_id)->where('user_id', $user_id)->delete();
    }
}
