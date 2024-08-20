<?php 
namespace App\Helper;
use Firebase\JWT\JWT;
use Exception;
use Firebase\JWT\Key;

  class JWTToken{
 
     public static function CreateToken($userEmail):string
     {
         $key=env('JWT_KEY');
        $payload=[
             'iss'=>'laravel-token',
             'iat'=>time(),
             'exp'=>time()+60*60,
             'userEmail'=>$userEmail
        ];
        return JWT::encode($payload,$key,'HS256');
     }

     public static function VerfyToken($token) :string {
        try {
          if($token==null){
            return 'Unauthorized'
          }else{

            $key=env('JWT_KEY');
            $decode=JWT::decode($token, new key($key,'HS256'));
            return $decode->userEmail;
          }
          }
           catch (Exception $e) {
            
            return "Unauthorized";
          }
        }
   
        
       public static function CreateTokenForSetPassword($userEmail):string
       {
          //function_body
          $key=env('JWT_KEY');
          $payload=[
            'iss'=>'laravel_token',
            'iat'=>time(),
            'exp'=>time()+60*20,
            "userEmail"=>$userEmail
          ];
          return JWT::encode($payload, $key,'HS256');

       }
      
  }

?>