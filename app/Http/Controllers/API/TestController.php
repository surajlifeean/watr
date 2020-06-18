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
use App\Order;
use App\Report;

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

		public function getReport(Request $request)
		{

			$uid=$request->user()->id;
			#get all oredr for this user
			$order_ids=Order::where('user_id',$uid)->pluck('id');

			// dd($order_ids);

			#get all report for this order ids
			$reports=Report::whereIn('order_id',$order_ids)->orderby('order_id')->get();
			
			// $reports=Report::whereIn('order_id',$order_ids)->groupby('order_id')->get();


			#write the code to be executed if user has no report




			#create response data
			// dd($reports[0]['test_name']);
			$report_response=[];
			$des=[];
			$prev=$reports[0]['order_id'];
			$current='';

			// dd(end($reports));

			foreach ($reports as $key=>$report) {
				$current=$report['order_id'];
				$report_response[$report['order_id']]['report_file_path']=url('images/'.$report['filename']);


				$report_response[$report['order_id']]['tests'][$report['test_name']][]=['parameter'=>$report['parameter'],'result'=>$report['result']];
				// $k = array_search(end($report_response),$report_response);
				// $report_response[$report['order_id']]['tests'][$report['test_name']][$k]['result']=$report['result'];
				// $cnt=$cnt+1;
				if($prev!=$current)
					{
						// dd($des);
						$report_response[$prev]['description']=join(',',array_unique($des));
						// dd(array_unique($des));

						$prev=$current;
						
					}
				$des[$key]=$report['test_name'];

			}

			$report_response[$prev]['description']=join(',',array_unique($des));
			$des[$key]=$report['test_name'];


		// dd($report_response);
		return response()->json($report_response, '200');

		}

}
