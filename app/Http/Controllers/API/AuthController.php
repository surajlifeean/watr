<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use App\otp;
use App\Details;
use App\vrdl;


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
        	
        	$error['message'] = $validator->errors()->first('email');
            $error['ack']=0;
            return $this->sendResponse($error);    

            // return $this->sendResponse($validator->errors());       
        }

    	$otp=otp::where('email',$request['email'])->orderby('created_at','desc')->first();
		
		if(!isset($otp))
			{
			$error['message'] = "Sorry, OTP did not match";
			$error['ack'] = 0;
            return $this->sendResponse($error, 200); 
			}

    	if($otp->otp==$request['otp']){
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        if($user){
            $success['token'] =  $user->createToken('token')->accessToken;
            $success['message'] = "Registration successfull..";
            $success['ack'] = 1;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            $success['number'] = $user->number;
            return $this->sendResponse($success);
        }
        else{
            $error['message'] = "Sorry! Registration is not successfull.";
            $error['ack'] = 0;
            return $this->sendResponse($error, 200); 
        }
       }

       else{
            $error['message'] = "Enter a Valid OTP";
            $error['ack'] = 0;
            return $this->sendResponse($error, 200); 
       }

        
    }
    
    //login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

       // $validator->error();

        if($validator->fails()){
        	// $validator->getMessageBag()->add('ack',0); 
        	$error['message'] = $validator->errors()->first('email');
            $error['ack']=0;
            return $this->sendResponse($error);       
        }

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            $error['message'] = "Unauthorized";
            $error['ack']="0";
            return $this->sendResponse($error, 200);
        }

        $user = $request->user();
        $success['token'] =  $user->createToken('token')->accessToken;
        $success['ack'] = 1;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['number'] = $user->number;
        $success['dob'] = $user->dob;
        $success['gender'] = $user->gender;
        $success['state'] = $user->state;
        $success['city'] = $user->city;
        $success['address'] = $user->address;
        $success['pincode'] = $user->pincode;

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


    public function gettestcenters($state){

        $testcenter=vrdl::where('state','LIKE',"%{$state}%")->orWhere('name','LIKE',"%{$state}%")->get();
        $test['center']=$testcenter;
        if(count($testcenter)==0)
            $test['status']='No Centers Availble in Records';
        else
            $test['status']='Success';
        return $this->sendResponse($test);

    }

    public function Profile(Request $request)
    {
        //$id = $request->user()->id;
        $id = $request->user()->id;
        // dd($id);
        $user = User::find($id);
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->number=$request['number'];
        $user->dob=$request['dob'];
        $user->gender=$request['gender'];
        $user->state=$request['state'];
        $user->city=$request['city'];
        $user->address=$request['address'];
        $user->pincode=$request['pincode'];

        if($user->save()){
            $success['ack'] = 1;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            $success['number'] = $user->number;
            $success['dob'] = $user->dob;
            $success['gender'] = $user->gender;
            $success['state'] = $user->state;
            $success['city'] = $user->city;
            $success['address'] = $user->address;
            $success['pincode'] = $user->pincode;
            $success['message'] = "Details Updated";


            return $this->sendResponse($success);
        }
        else{
            $error['message'] = "Sorry Something Went Wrong";
            $error['ack']="0";
            return $this->sendResponse($error);
        }
    }

}