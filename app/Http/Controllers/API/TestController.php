<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Test;
use Validator;

class TestController extends Controller
{
		public function getAllTests()
		{

		$tests=Test::where('status','A')->withCount('parameters')->get();
		foreach ($tests as $test) {
			$test=$test->parameters;

		}
		$tests['ack']=1;
		// dd($tests);
		if(!$tests){
		$error['message'] = "Something Went Wrong";
		$error['ack'] = 0;
		return response()->json($error, '200');
		}
		return response()->json($tests, '200');
		// return $this->sendResponse($test);
		}

   
}
