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
			// dd($reports->count());

			#write the code to be executed if user has no report
			$report_response=[];

			if($reports->count()==0){
			$report_response=['ack'=>0,'msg'=>'No Reports Availble'];
			return response()->json($report_response, '200');

		}

			#create response data
			// dd($reports[0]['test_name']);
			// $report_response=[];
			$des=[];
			$prev=$reports[0]['order_id'];
			$current='';


			foreach ($reports as $key=>$report) {
				$current=$report['order_id'];
				$report_response[$report['order_id']]['report_file_path']=url('/public/images/reports/'.$report['filename']);


				$report_response[$report['order_id']]['tests'][$report['test_name']][]=['parameter'=>$report['parameter'],'result'=>$report['result']];



				if($prev!=$current)
					{
						
						$report_response[$prev]['description']=join(',',array_unique($des));
						
						$des=[];

						$prev=$current;
						
					}

			$des[$key]=$report['test_name'];


			}

			$report_response[$prev]['description']=join(',',array_unique($des));
			$des[$key]=$report['test_name'];


		// dd($report_response);

		// return response()->json($report_response, '200');



			$cleansed=['ack'=>1];

			foreach ($report_response as $key => $value) {

				$cleansed['data'][]=['description'=>$value['description'],'file_path'=>$value['report_file_path'],'tests'=>$value['tests']];
					
			}
			// $report_response['ack']=1;

		return response()->json($cleansed, '200');


		}

		public function getRecom(Request $request)
		{

			$uid=$request->user()->id;
			#get all oredr for this user
			$order_ids=Order::where('user_id',$uid)->pluck('id');	
			#get all report for this order ids
			$reports=Report::whereIn('order_id',$order_ids)->select('parameters.id','reports.test_name','reports.parameter','reports.result','reports.outcome','reports.order_id','recommendations.recommendations')
						->join('parameters', 'parameters.name', '=', 'reports.parameter')
						->join("parameter_recommendation",function($join){
							$join->on('parameters.id','=','parameter_recommendation.parameter_id')
							->on('reports.outcome','=','parameter_recommendation.outcome');
						})
						->join('recommendations','parameter_recommendation.recommendation_id','=','recommendations.id')
						->orderby('order_id')
						->get();


			// dd($reports);
			// return response()->json($reports, '200');



			$report_response=[];

			if($reports->count()==0){
			$report_response=['ack'=>0,'msg'=>'No Recommendations Availble'];
			return response()->json($report_response, '200');
			}

			$prev=$reports[0]['order_id'];
			$current='';



			foreach ($reports as $key=>$report) {

					$current=$report['order_id'];

					$report_response[$current][$report['test_name']][]=$report['recommendations'];

			}	


			$cleansed=['ack'=>1];

			foreach ($report_response as $key => $value) {

				// $cleansed['data'][]=$value;
				// $temp=array();
				$temp=array();
				foreach ($value as $k => $v) {
					
					$temp[$k]=array_unique($v);

				}
				$cleansed['data'][]=$temp;
			

			}


			return response()->json($cleansed, '200');

			
		}

}

