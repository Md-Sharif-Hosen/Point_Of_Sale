<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use App\Models\User;
use App\Helper\JWTToken;
use App\Mail\OTPMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function LoginPage():view
      {
        return view('pages.auth.login-page');
      }

    public function RegistrationPage():view
      {
        return view('pages.auth.registration-page');
      }

    public function SendOTPPage():view
      {
        return view('pages.auth.send-otp-page');
      }

    public function VerifyOTPPage():view
      {
        return view('pages.auth.verify-otp-page');
      }

    public function ResetPasswordPage():view
      {
        return view('pages.auth.reset-password-page');
      }
 

    public function UserProfilePage():view
      {
        return view('pages.dashboard.profile-page');
      }
 
    public function UserRegistration(request $request)
    {
        try{

            $user= User::create([
                 'firstName' => $request->input('firstName'),
                 'lastName' => $request->input('lastName'),
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
          ->select('id')->first();
 
          if ($count !== null) {
           $token=JWTToken::CreateToken($request->input("email"),$count->id);
           return response()->json([
             'status'=>'success',
             'message'=>"User login successfull",
             
           ],200)->cookie('token',$token ,time()+60*24*30);
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

    public function SendOTPCode(request $request)
    {
        //function_body
        $email=$request->input('email');
        $otp=rand(1000,9999);
        $count=User::where('email','=',$email)->count();

        if($count==1){
          Mail::to($email)->send(new OTPMail($otp));
          User::where('email','=',$email)->update(['otp'=>$otp]);
          return response()->json([
            'status'=>'success',
            'message'=>'4 Digit OTPCode has been send'
          ],200);
        }else{
          return response()->json([
            'status'=>'Failed',
            'message'=>"Unauthorized"
          ],500);
        }
    }
    
    public function VerifyOTP(request $request)
    {
        //function_body
        $email=$request->input('email');
        $otp=$request->input('otp');
        $count=User::where('email','=',$email)->where('otp','=',$otp)->count();

        if($count==1){
          User::where('email','=',$email)->update(['otp'=>"0"]);
          $token=JWTToken::CreateTokenForSetPassword($request->input('email'));
          return response()->json([
            'status'=>"success",
            'message'=>'OTP verification successfull',
            // 'token'=>$token
          ],200)->cookie('token',$token,60*24*30);
        }else
        {
          return response()->json([
            'status'=>"Failed",
            'message'=>'OTP verification Failed',
            
          ],200);
        }

    }

    public function PasswordReset(request $request)
    {
        try{
          $email=$request->header('email');
          $password=$request->input('password');
        User::where('email','=',$email)->update(['password'=>$password]);
          return response()->json([
                   'status'=>'success',
                  //  'message'=>$result
                   'message'=>'Password rest successful'
          ],200);
        }catch(Exception $e){
          return response()->json([
            'status'=>'Failed',
            'message'=>'Something went wrong'
            ],500);
        }
    }

    public function UserLogout()
    {
         return redirect('/userLogin')->cookie('token','',-1);
    }
}
