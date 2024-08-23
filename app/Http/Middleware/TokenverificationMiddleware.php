<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenverificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    //     $token=$request->cookie('token');

    //     $result=JWTToken::VerfyToken($token);

    //         if($result=="Unauthorized")
    //         {
    //             return redirect('/userLogin');
    //         }
    //          else{
    //         $request->headers->set('email',$result->userEmail);
    //         $request->headers->set('id',$result->userID);
    //         return $next($request);
    //     }

        
    // }
    
     $token = $request->cookie('token');

     // Verify the token
     $result = JWTToken::VerfyToken($token);
 
     // Check if the result is a string indicating an error
     if (is_string($result) && $result === "Unauthorized") {
         return redirect('/userLogin');
     }
 
     // Check if the result is an object with the necessary properties
     if (is_object($result) && isset($result->userEmail, $result->userID)) {
         // Set headers with email and id
         $request->headers->set('email', $result->userEmail);
         $request->headers->set('id', $result->userID);
 
         // Proceed with the next middleware or request handling
         return $next($request);
     }
 
     // Handle unexpected scenarios (e.g., if $result is not as expected)
     return redirect('/userLogin');
    }
}
