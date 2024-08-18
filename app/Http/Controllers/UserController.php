<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helper\JWTToken;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserRegistration(request $request)
    {
        try{

            $user= User::create([
                 'first_name' => $request->input('first_name'),
                 'last_name' => $request->input('last_name'),
                 'email' => $request->input('email'),
                 'mobile' => $request->input('mobile'),
                 'password' => $request->input('password'),
                //  'password' => Hash::make($request->input('password')),
             ]);
             return response()->json([
                "status"=>"success",
                "message"=> "User Registration Successfull"
                // "message"=> $user
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

    public function UserLogin(request $request)
    {
        //function_body
        try{
          $count=User::where( 'email' , '=' ,$request->input("email"))
          ->where('password','=',$request->input("password"))
          ->count();
 
          if ($count==1) {
           $token=JWTToken::CreateToken($request->input("email"));
           return response()->json([
             'status'=>'success',
             'message'=>"User login successfull",
             'token'=>$token
           ],200);
          }else{
           return response()->json([
             'status'=>'Failed',
             'message'=>"Unauthorized",
           ],200);
          }
        }catch(Exception $e){
          return $e->getMessage();
        }
        
    }
}
