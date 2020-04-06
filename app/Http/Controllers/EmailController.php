<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Mail;
use App\otp;
use DateTime;

class EmailController extends Controller
{
    //
    public function sendOtp($email)
    {
    	$status=0;
    	$data['email']=$email;
    	$data['otp']=rand(1000,9999);
    	// $data['title'] = "This is Test Mail Tuts Make";

    	$checkRecentAttempt=otp::where('email',$email)->orderby('created_at','desc')->first();
		// if the otp ages more than 5 in then create a new one else send a status to use the existing
		$minMins=date('i', mktime(0,0,300));
		if(isset($checkRecentAttempt)){
		$diff=date_diff(new \DateTime(date('Y-m-d H:i:s e')),$checkRecentAttempt->created_at);
			if($diff->format('%i')<=$minMins){
			$response = [
		        'message' =>'Please use the OTP you have already received a moment ago',
		    ];
		    return response()->json($response, '200');
			}
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
				];
				return response()->json($response, '400');
				}

        else{
				$response = [
				'message' =>'Please enter the OTP we have sent',
				];
				return response()->json($response, '200');
			}

        }

    
}
