<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect,Response,DB,Config;
use Mail;
use App\otp;
use DateTime;
use App\User;
use App\Contact;

class EmailController extends Controller
{
        public function sendOtp($email)
    {
    	// validate email id
    	
    	$data['email']=$email;
    	$data['otp']=rand(1000,9999);
    	// $data['title'] = "This is Test Mail Tuts Make";

    	$checkRecentAttempt=otp::where('email',$email)->orderby('created_at','desc')->first();

    	$checkUserRegistered=User::where('email',$email)->first();

    	// dd($checkUserRegistered);
		// if the otp ages more than 5 in then create a new one else send a status to use the existing
		$minMins=date('i', mktime(0,0,300));

		if(isset($checkRecentAttempt)){
		
			$response = [
		        'message' =>'You are already registered please try to sign in',
		        'ack'=>0
		    ];
		    return response()->json($response, '200');

		}

		if(isset($checkRecentAttempt)){
		$diff=date_diff(new \DateTime(date('Y-m-d H:i:s e')),$checkRecentAttempt->created_at);
			if($diff->format('%i')<=$minMins){
			$response = [
		        'message' =>'Please use the OTP you have already received a moment ago',
		        'ack'=>1
		    ];
		    return response()->json($response, '200');
			}
		}

		if(!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $email)){
				$response = [
				'message' =>'Invalid Email ID',
				'ack'=>0
				];
				return response()->json($response, '200');
				}


        $rgst=new otp;
        $rgst->email=$email;
        $rgst->otp=$data['otp'];
        $rgst->save();

 		Mail::send('email.otp', $data, function($message) use($email){
 			$message->from('automailer@watrtechnologies.com', 'Watr Technologies');

            $message->to($email,'New User')
 
                    ->subject('Watr registration OTP');
        });
 
        if (Mail::failures()) {
				$response = [
				'message' =>'Sorry! Something went wrong while sending OTP. Try after some time',
				'ack'=>0
				];
				return response()->json($response, '200');
				}

        else{
				$response = [
				'message' =>'Please enter the OTP we have sent',
				'ack'=>1
				];
				return response()->json($response, '200');
			}

        }
        public function contact(Request $request)
       {
       	// dd($request->request);

			$contact=new Contact;

			$variable=$request->toArray();
			foreach ($variable as $key => $value) {
			if($key!='_token')
			$contact->$key=$value;
			}

			     
		if ($contact->save()) {
				$response = [
				'message' =>'You Query Has Been Submitted Successfully',
				'ack'=>1
				];
				return response()->json($response, '200');
				}

        else{
				$response = [
				'message' =>'Something Went Wrong',
				'ack'=>0
				];
				return response()->json($response, '200');
			}



       }

}
