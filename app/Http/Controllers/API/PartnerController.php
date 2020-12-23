<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;
use App\Partner;
use App\Parameter;
use App\PartnerAssistant;
use DB;

class PartnerController extends Controller
{
    public function addPartner(Request $request)
    {


// dd($request);
// return response()->json($request, '200');

	foreach ($request->request as $key => $value) {
	// echo $value;
	}      


	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
// $txt = "John Doe\n";
	fwrite($myfile, $value);

	

	$partner=new Partner;
	// dd($value);
	$ob=json_decode($value, true);
	$partner->labname=$ob['labname'];
	$partner->contactperson=$ob['contactperson'];
	$partner->number=$ob['number'];
	$partner->designation=$ob['designation'];
	$partner->panno=$ob['panno'];
	$partner->gstno=$ob['gstno'];
	$partner->address=$ob['address'];
	$partner->pincode=$ob['pincode'];
	$partner->city=$ob['city'];
	$partner->state=$ob['state'];
	$partner->long=$ob['long'];
	$partner->lat=$ob['lat'];

	$partner->status='A';

	$checkPartnerExists=Partner::where('gstno',$partner->gstno)->first();
			if(isset($checkPartnerExists)){
		
			$response = [
		        'message' =>'You are already registered on '.date('d-m-Y',strtotime($checkPartnerExists->created_at)).'. We will reachout shortly',
		        'ack'=>0
		    ];
		    return response()->json($response, '200');

		}

	##block the entry and show partner exists for GST or Pan or Contact no
	  $file=$request->file('panfile');
      $filename='pan-'.rand().time().$file->getClientOriginalName();
      // $extension=$file->getClientOriginalExtension();
      $destinationPath = public_path('images/partner/pan');
      $file->move($destinationPath,$filename);

	  $partner->panfile=$filename;


   	  $file=$request->file('gstfile');
      $filename='gst-'.rand().time().$file->getClientOriginalName();
      // $extension=$file->getClientOriginalExtension();
      $destinationPath = public_path('images/partner/gst');
      $file->move($destinationPath,$filename);

	  $partner->gstfile=$filename;


      $file=$request->file('chequefile');
      $filename='cheque-'.rand().time().$file->getClientOriginalName();
      // $extension=$file->getClientOriginalExtension();
      $destinationPath = public_path('images/partner/cheque');
      $file->move($destinationPath,$filename);

   	   $partner->chequefile=$filename;

	   $partner->save();
	   // $data=[2=>['cost'=>0],7=>['cost'=>6]];
	   // dd($data);
	   $list=[];
	   foreach ($ob['tests'] as $key => $value) {
	   	$list[$value['id']]=['cost'=>$value['cost']];
	   }
	   if($partner->parameters()->sync($list)){
	   		$success['message'] = "Details Submitted! We will get back to you soon";
			$success['ack'] = 1;
			return response()->json($success, '400');
	   }
	   else{
	   		$success['message'] = "Something went wrong, Please try again";
			$success['ack'] = 0;
			return response()->json($success, '200');

	   }

    }

    public function testfile(Request $request)
    {

  //       $destinationPath = public_path('images');

		// $path = $request->file('chequefile')->move($destinationPath,'test.pdf');

		// return response()->json($path,'200');
			// foreach ($request->request as $key => $value) {
	// echo $value;
	// }      
	// $partner=new Partner;
	// $ob=json_decode($value, true);
	// $partner->labname=$ob['labname'];
	// $partner->contactperson=$ob['contactperson'];
	// $partner->number=$ob['number'];
	// $partner->designation=$ob['designation'];
	// $partner->panno=$ob['panno'];
	// $partner->gstno=$ob['gstno'];
	// $partner->status='A';
	// $partner->save();
$response = array();
// $upload_dir = 'public/images/';
$upload_dir=public_path('images');
$server_url = 'http://127.0.0.1/watr/';
if($_FILES['avatar'])
{
    $avatar_name = $_FILES["avatar"]["name"];
    $avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
    $error = $_FILES["avatar"]["error"];

    if($error > 0){
        $response = array(
            "status" => "error",
            "error" => true,
            "message" => "Error uploading the file!"
        );
    }else 
    {
        $random_name = rand(1000,1000000)."-".$avatar_name;
        $upload_name = $upload_dir.'/'.strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);

                // "url" => $server_url."/".$upload_name

        if(move_uploaded_file($avatar_tmp_name , $upload_name)) {
            $response = array(
                "status" => "success",
                "error" => false,
                "message" => "File uploaded successfully",
                "url" => $upload_name
              );
        }else
        {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "Error uploading the file!"
            );
        }
    }    

}else{
    $response = array(
        "status" => "error",
        "error" => true,
        "message" => "No file was sent!"
    );
}

echo json_encode($response);


    }

    public function allParameters(Request $request)
    {
		// dd("hi");
    	$parameters=Parameter::select('id','name')->get();
		if(!isset($parameters)){
		$error['message'] = "Something Went Wrong";
		$error['ack'] = 0;
		return response()->json($error, '200');
		}
		$param['ack']=1;
		$param['parameters']=$parameters;
		return response()->json($param,'200');

    }


    public function assistance(Request $request)
		{

			$assistance=new PartnerAssistant;
			// $assistance=$request->tests;
			$variable=$request->toArray();
			// dd($variable['tests']);
			// dd($variable['pickup_time']);
			foreach ($variable as $key => $value) {
			if($key!='_token')
			$assistance->$key=$value;
			}

			if($assistance->save()){
				$success['message'] = "You Details Are Posted! We We Get Back To You Shortly.";
				$success['ack'] = 1;
				return response()->json($success, '200');
			}
			else{
				$success['message'] = "Something Went Wrong";
				$success['ack'] = 0;
				return response()->json($success, '200');
			}
		}

	public function nearestLabs(Request $request)
		{
			$lat = $request->query('lat');
			$long = $request->query('long');

			// dd($lat);

			$lat = $request->lat;
			$long = $request->long;
			$pincode=$request['pincode'];
			// $pincode="700587";
			// dd($pincode);
			$dictrictCode=substr($pincode,0,3);
			$nearestLabs=Partner::select('labname',DB::raw("CONCAT(address,',',city,',',pincode,',',state) AS complete_address"))->where([
				['pincode','like',"%{$dictrictCode}%"],
				['status','A']
			])->get();
			$response['labs']=$nearestLabs;
			$response['ack']=1;
			return response()->json($response,'200');
		}


}
	