<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Test;
use App\Cart_Test;
use Validator;

class TestController extends Controller
{
		public function getAllTests(Request $request)
		{
		$test_in_cart=[];
		$user_id=$request->user()->id;
		// dd($user_id);
		if($request->user()->carts)
		{
			$test_in_cart=Cart_Test::where('cart_id',$request->user()->carts->id)->pluck('test_id')->toArray();
			// dd($tic);
		}

		$tests=Test::where('status','A')->withCount('parameters')->orderby('type')->get();
		foreach ($tests as $key=>$test) {
		
		// foreach($test->carts->pluck('user_id') as $k=>$val)


			// echo($test['name']);
			$search_str=$test['name'];
			$in_cart='N';
			if(in_array($test['id'],$test_in_cart))
				$in_cart='Y';
				
			// $test->carts
			$test=$test->parameters;
			$sum=0;
			foreach ($test as $param) {
				$sum=$sum+$param->cost;
				$search_str=$search_str.$param->name;
			}
			// echo($key.'-'.$test);
			$tests[$key]['total_cost']=$sum;
		    $tests[$key]['search_str']=$search_str;
		    $tests[$key]['in_cart']=$in_cart;


		}
		// return response()->json($tests, '200');
		// dd("hi");
		$res['tests']=array($tests);		
		$res['ack']=1;
		// dd($tests);
		if(!$tests){
		$error['message'] = "Something Went Wrong";
		$error['ack'] = 0;
		return response()->json($error, '200');
		}
		return response()->json($res, '200');
		return $this->sendResponse($test);
		}   

}
