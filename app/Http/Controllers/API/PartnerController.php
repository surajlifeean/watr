<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;
use App\Partner;


class PartnerController extends Controller
{
    public function addPartner(Request $request)
    {

	foreach ($request->request as $key => $value) {
	// echo $value;
	}      
	$partner=new Partner;
	$ob=json_decode($value, true);
	$partner->labname=$ob['labname'];
	$partner->contactperson=$ob['contactperson'];
	$partner->number=$ob['number'];
	$partner->designation=$ob['designation'];
	$partner->panno=$ob['panno'];
	$partner->gstno=$ob['gstno'];
	$partner->status='A';
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
	   $data=[2=>['cost'=>0],7=>['cost'=>6]];
	   // dd($data);
	   $list=[];
	   foreach ($ob['tests'] as $key => $value) {
	   	$list[$value['id']]=['cost'=>$value['cost']];
	   }
	   if($partner->tests()->sync($list)){
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

}
	