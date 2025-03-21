<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use ResponseTrait;

    public function register(Request $request){

        // $fields =$request->validate([
        //     "name" => 'required|max:255',
        //     "email"=> 'required|email|unique:users',
        //     "password"=> 'required|confirmed'
        // ]);

        // $user = User::create($fields);

        // $token = $user->createToken($request->name);


        // return response()->json([
        //     'user'=> $user,
        //     'token'=> $token->plainTextToken
        // ]);

        // throw new Exception("Hi");

        return $this->formatResponse([
            'message' => 'error'
        ], 501);
        
        


    }
    public function login(Request $request){
        $request->validate([
            
            "email"=> 'required|email|exists:users',
            "password"=> 'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password , $user->password)){

            return [
                "message" => "credentials are incorrect"
            ];
        }
        
        $token = $user->createToken($user->name);

        return [
            "message" => "user login successfully",
            "token" => $token->plainTextToken
        ];
    }
    public function logout(Request $request){

        $request->user()->tokens()->delete();
        return [
            'message' => 'user logged out successfuly'
        ];
    }
}
