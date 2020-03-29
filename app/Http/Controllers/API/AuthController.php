<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use App\otp;

class AuthController extends ResponseController
{
    //create user
    public function signup(Request $request)
    {
    	// dd($request['email']);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|',
            'email' => 'required|string|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'otp'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

    	$otp=otp::where('email',$request['email'])->orderby('created_at','desc')->first();
		

    	if($otp->otp==$request['otp']){
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        if($user){
            $success['token'] =  $user->createToken('token')->accessToken;
            $success['message'] = "Registration successfull..";
            return $this->sendResponse($success);
        }
        else{
            $error = "Sorry! Registration is not successfull.";
            return $this->sendError($error, 401); 
        }
       }
       else{
       	    $error = "Hey! Please enter a valid OTP.";
            return $this->sendError($error, 401); 
       }

        
    }
    
    //login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            $error = "Unauthorized";
            return $this->sendError($error, 401);
        }
        $user = $request->user();
        $success['token'] =  $user->createToken('token')->accessToken;
        return $this->sendResponse($success);
    }

    //logout
    public function logout(Request $request)
    {
        
        $isUser = $request->user()->token()->revoke();
        if($isUser){
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        }
        else{
            $error = "Something went wrong.";
            return $this->sendResponse($error);
        }
            
        
    }

    //getuser
    public function getUser(Request $request)
    {
        //$id = $request->user()->id;
        $user = $request->user();
        if($user){
            return $this->sendResponse($user);
        }
        else{
            $error = "user not found";
            return $this->sendResponse($error);
        }
    }


        public function getAllUser()
    {

    	$user=User::all();

        if(!$user){
            $error = "Something Went Wrong";
            return $this->sendError($error, 401);
        }
        return $this->sendResponse($user);
    }


}