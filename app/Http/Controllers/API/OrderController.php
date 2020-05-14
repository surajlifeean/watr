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
			$success['order_id']=$order->order_id;
			return response()->json($success, '200');
			}
			else{
			$success['message'] = "Something Went Wrong";
			$success['ack'] = 0;
			return response()->json($success, '200');
			}
		}   

		 public function OrderListing(Request $request)
    {
    	// dd($request->user()->id);
    	$orders=Order::where('user_id',$request->user()->id)->orderby('created_at','Desc')->get();
    	$orderList=[];
    	$tempList=[];

    	// dd($request->user()->id)

    	foreach ($orders as $key => $order) {
    		# code...
    	
    	$order_id=$order->order_id;
    	$booking_date=date_format($order->created_at,'d/m/Y');
    	$order_status=$order->order_status;
    	$bill_amount=$order->billamt;
    	$tests_booked=$order->tests->pluck('name');
    	// $orderList=['order_id'=>$order_id,'booking_date'=>$booking_date,'order_status'=>$order_status,'bill_amount'=>$bill_amount,'tests_booked'=>$tests_booked];
    	$var=['order_id'=>$order_id,'booking_date'=>$booking_date,'order_status'=>$order_status,'bill_amount'=>$bill_amount,'tests_booked'=>$tests_booked];
    	array_push($tempList, $var);

    }

    	$orderList['orders']=$tempList;
    	$orderList['ack']=1;


    	return response()->json($orderList, '200');
    }


}
