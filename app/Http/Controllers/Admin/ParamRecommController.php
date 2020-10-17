<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recommendation;
use App\Parameter;
use App\Test;
use Session;
use App\Paramrecom;

class ParamRecommController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     $test= Test::all();
     $param=Parameter::all();
     $recommends=Recommendation::pluck('id','recommendations');

     // dd($recommends);
     // dd($test);

     return view('admin.recommendation.show')->withParam($param)->withRecommends($recommends);
         // return view('admin.recommendation.show');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);

        $collection = Paramrecom::get();

            foreach($collection as $c) {

            $c->delete();

        }


        foreach ($request['parameters'] as $key => $value) {
            
        //     ##check if the data exists?
            foreach ($value as $k => $v) {
                
                if($k=='High'){
                    $pr=new Paramrecom;
                    $pr->parameter_id=$key;
                    $pr->recommendation_id=$v;
                    $pr->outcome='High';
                    $pr->save();
                }
                    // $pr=Paramrecom::where([['parameter_id','=',$key],['outcome','=','High'],['recommendation_id','=',$v]])->get();
                if($k=='Low'){
                    $pr=new Paramrecom;
                    $pr->parameter_id=$key;
                    $pr->recommendation_id=$v;
                    $pr->outcome='Low';
                    $pr->save();
                }
                    // $pr=Paramrecom::where([['parameter_id','=',$key],['outcome','=','Low'],['recommendation_id','=',$v]])->get();
              }

        }

        session::flash('success', 'The Parameters Has Been Mapped to Recommendations Successfully!');
        return redirect()->route('param-recomm.index');

        // $recom=new Recommendation;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
