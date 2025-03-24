<?php

namespace App\Http\Controllers;

use App\Helpers\FormatResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            "name" => 'required|min:5|max:60',
             "email"=> 'required|email|unique:users',
             "password"=> 'required|min:6'
         ]);
  
         if($validator->fails()){
             return FormatResponse::error("Error",422 ,$validator->errors());
         }

        $user = User::create($request->all());
        $token = $user->createToken($request->name);

        return FormatResponse::success(["user"=> $user , "token" => $token->plainTextToken] , "User Signed up successfully" );

    }
    public function login(Request $request){
        
        $validator = Validator::make($request->all(), [
           "email"=> 'required|email|exists:users',
            "password"=> 'required'
        ]);


        if($validator->fails()){
            return FormatResponse::error("Error",422 ,$validator->errors());
        }

        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password , $user->password)){

            return FormatResponse::error("email or password is incorrect" );
        }
        
        $token = $user->createToken($user->name);

        return FormatResponse::success(["user"=> $user , "token" => $token->plainTextToken] , "User login successfully" );
    }
    public function logout(Request $request){

        $request->user()->tokens()->delete();

        return FormatResponse::success([],"User logged out successfuly");
    }
}
