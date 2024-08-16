<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user_registration(request $request)
    {
        try{

            $user= User::create([
                 'first_name' => $request->input('first_name'),
                 'last_name' => $request->input('last_name'),
                 'email' => $request->input('email'),
                 'mobile' => $request->input('mobile'),
                 'password' => Hash::make($request->input('password')),
             ]);
             return response()->json([
                "status"=>"success",
                "message"=> "User Registration Successfull"
             ]);
        }
        catch(Exception $e){
          return response()->json([
               'status'=>'Faild',
               "message"=> "User Registration Faild"
            //    'message'=>$e->getMessage()
          ]);
        }
    }
}
