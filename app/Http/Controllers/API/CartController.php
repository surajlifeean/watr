<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;

class CartController extends Controller
{
        public function addtocart(Request $request)
    {
    	$added_to_cart=0;
    	#fetch user details using the token
    	$user_id=$request->user()->id;
    	#check if the user id is in cart table 
    	$userhasacart=Cart::where('user_id',$user_id)->first();
    	// dd($userhasacart);
    	$ids=$request->ids;
    	if(isset($userhasacart))
    	{
        	$userhasacart->tests()->sync($ids);        
        	// $userhasacart->save();
        	$added_to_cart=1;
		}
		else
		{
			$cart=new Cart;
			$cart->user_id=$user_id;
			$cart->save();
        	$cart->tests()->sync($ids);        
        	$added_to_cart=1;

		}
		if($added_to_cart=1)
		{
			$success['message'] = "Cart Updated";
			$success['ack'] = 1;
			return response()->json($success, '200');
		}
		else
		{
			$error['message'] = "Something Went Wrong";
			$error['ack'] = 0;
			return response()->json($error, '200');
		}
    }
}
