<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Parameter;
use App\Test;
use Session;

class TestManagementController extends Controller
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
        $tests=Test::orderby('type','asc')->get();
    
        return view('admin.test.index')->withTests($tests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parameters=Parameter::where('status','A')->pluck('id','name');
        // dd($parameters);

        return view('admin.test.create')->withParameters($parameters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $test=new Test;

        $variable=$request->toArray();
        foreach ($variable as $key => $value) {
        if($key!='_token' & $key!='parameters')
        $test->$key=$value;
        }

        $test->save();

        $test->parameters()->sync($request->parameters,false);        

        session::flash('success', 'The Test Has Been Added Successfully!');
        return redirect()->route('test.index');
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
        $test=Test::find($id);
        $parameters=Parameter::where('status','A')->pluck('id','name');
        return view("admin.test.edit")->withTest($test)->withParameters($parameters);
  
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
        $test=Test::find($id);

        $variable=$request->toArray();
        foreach ($variable as $key => $value) {
        if($key!='_token' & $key!='parameters' & $key!='_method')
        $test->$key=$value;
        }

        $test->save();

        $test->parameters()->sync($request->parameters);        

        session::flash('success', 'The Test Has Been updated Successfully!');
        return redirect()->route('test.index');
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
        $test=Test::find($id);
        $test->delete();
        $request->session()->flash('success', 'The Test Has Been Deleted.');
        return redirect('/admin/test');
        
        // dd($request); 
    }

}
