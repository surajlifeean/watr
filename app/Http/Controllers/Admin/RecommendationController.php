<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recommendation;
use App\Parameter;
use App\Test;
use Session;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
     
     $recom=Recommendation::all();
     // $test= Test::all();
     #$param=Parameter::all();

     // dd($test);

     #return view('admin.recommendation.show')->withRecom($recom)->withParam($param);
     return view('admin.recommendation.index')->withRecoms($recom);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('admin.recommendation.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->name);

        $recom=new Recommendation;

        $recom->recommendations=$request->name;
        $recom->save();        

        session::flash('success', 'The Recommendation Has Been Added Successfully!');
        return redirect()->route('recommendation.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recom=Recommendation::find($id);
        return view("admin.recommendation.edit")->withRecom($recom);
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
      
        $recom=Recommendation::find($id);
        $recom->recommendations=$request->name;
        $recom->save();        

        session::flash('success', 'The Recommendation Has Been Updated Successfully!');
        return redirect()->route('recommendation.index');


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


    public function delete($id,Request $request)
    {   
        $recom=Recommendation::find($id);
        $recom->delete();
        $request->session()->flash('success', 'The recommendation Has Been Deleted.');
        return redirect('/admin/recommendation');
        
    }



}
