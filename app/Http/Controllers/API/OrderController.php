<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
		{

			$order=new Order;
			$tests=$request->tests;
			$variable=$request->toArray();
			// dd($variable['tests']);
			// dd($variable['pickup_time']);
			foreach ($variable as $key => $value) {
			if($key!='_token' && $key!='pickup_time' && $key!='tests')
			$order->$key=$value;
			}

			$time_arr=explode("-", $variable['pickup_time']);
			$order->pickupst_time=$time_arr[0];
			$order->pickupend_time=$time_arr[1];
			$order->order_status=1;
			$order->user_id=$request->user()->id;
			
			if($order->save()){
			$order->order_id=date('dmY',strtotime($order->created_at)).$order->id;
			$order->save();
			$order->tests()->sync($tests);
			$success['message'] = "Your Order Has Been Placed";
			$success['ack'] = 1;
			return response()->json($success, '200');
			}
			else{
			$success['message'] = "Something Went Wrong";
			$success['ack'] = 0;
			return response()->json($success, '200');
			}
		}   

}
