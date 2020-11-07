<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Parameter;
use Session;


class ParameterManagementController extends Controller
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
        $parameter=Parameter::all();
        return view('admin.parameter.index')->withParameters($parameter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.parameter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $parameter=new Parameter;

        $variable=$request->toArray();
        foreach ($variable as $key => $value) {
        if($key!='_token')
        $parameter->$key=$value;
        }

        $parameter->save();        

        session::flash('success', 'The Parameter Has Been Added Successfully!');
        return redirect()->route('parameter.index');

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
        $parameter=Parameter::find($id);
        return view("admin.parameter.edit")->withParameter($parameter);
    
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
        
        $parameter=Parameter::find($id);

        $variable=$request->toArray();
        foreach ($variable as $key => $value) {
           if($key!='_token' & $key!='_method')
            $parameter->$key=$value;
        }

        $parameter->save();        

        session::flash('success', 'The Parameters Has Been Updated Successfully!');
        return redirect()->route('parameter.index');

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
        $parameter=Parameter::find($id);
        $parameter->delete();
        $request->session()->flash('success', 'The Parameter Has Been Deleted.');
        return redirect('/admin/parameter');
        
        // dd($request); 
    }

     public function statuschange($id,Request $request)
    {   //dd($id);
        $partner =Partner::find($id);
        if($partner->status == 'A'){
            $partner->status = 'I';
            if($partner->save()){
                $request->session()->flash('success', 'Partner deactivated successfully.');
                return redirect('/admin/partner');
            }
        } else {
            $partner->status = 'A';
            if($partner->save()){
                $request->session()->flash('success', 'Partner activated successfully.');
                return redirect('/admin/partner');
            }
        }
    }



}
