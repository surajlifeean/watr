<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\About;
use Image;
use Session;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about=About::all();
        return view('admin.about.index')->withAbout($about);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $about=new About;
        $variable=$request->toArray();
        foreach ($variable as $key => $value) {
           if($key!='_token' & $key!='image_name')
            $about->$key=$value;
        }

        $image=$request->file('image_name');
        //if($request->hasFile('image_name')){
        //dd($image);
        $filename='about'.'-'.rand().time().'.'.$image->getClientOriginalExtension();//part of image intervention library
        $location=public_path('/images/'.$filename);

        // use $location='images/'.$filename; on a server

        Image::make($image)->resize(800,400)->save($location);
        $about->image=$filename;
        $about->save();        

        session::flash('success', 'The About Image Has Been Added Successfully!');
        return redirect()->route('aboutus.index');

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
        //
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
