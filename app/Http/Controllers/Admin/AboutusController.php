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
        public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $about=About::orderby('type','asc')->get();
        // dd($about);
        if(count($about)>0)
            return view('admin.about.edit')->withAbout($about);
        else
            return view('admin.about.create');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $about=About::orderby('type','asc')->get();
        // dd($about);

        if(count($about)>0)
            return view('admin.about.edit')->withAbout($about);
        else
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

            // dd($request->file('image_name')[0]);

        // About::truncate();
        // $test->delete()


        // dd($request);
        foreach ($request['title'] as $key => $value) {

            $about=new About;
            $about->title=$value;
            $about->text=$request['text'][$key];
            $about->type=$request['type'][$key];
            
            $image=$request->file('image_name')[$key];
            $filename='about'.'-'.rand().time().'.'.$image->getClientOriginalExtension();//part of image intervention
            $location=public_path('/images/about/'.$filename);
            // use $location='images/'.$filename; on a server
            if($request['type'][$key]=='about')
                Image::make($image)->resize(800,400)->save($location);
            else
                Image::make($image)->resize(400,400)->save($location);

            $about->image=$filename;
            $about->save();        
        }

            session::flash('success', 'The About data Has Been Added Successfully!');
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
        // if id values exits then update that record else insert a new record

        // dd($request);

        foreach ($request['title'] as $key => $value) {

            if(isset($request['id'][$key])){
                // echo "edit";
            $about=About::find($request['id'][$key]);
            $about->title=$value;
            $about->text=$request['text'][$key];
            $about->type=$request['type'][$key];     
            if(isset($request->file('image_name')[$key])){

                // echo($key."change existing image<br>");

                $image=$request->file('image_name')[$key];
                $filename='about'.'-'.rand().time().'.'.$image->getClientOriginalExtension();//part of image intervention
                $location=public_path('/images/about/'.$filename);
                if($request['type'][$key]=='about')
                    Image::make($image)->resize(800,400)->save($location);
                else
                    Image::make($image)->resize(400,400)->save($location);

                $about->image=$filename;
                }
                // echo($key."do not change existing image<br>");
                $about->save();

            }
            else{

                // echo "add";
            $about=new About;
            $about->title=$value;
            $about->text=$request['text'][$key];
            $about->type=$request['type'][$key];
            $image=$request->file('image_name')[$key];
            $filename='about'.'-'.rand().time().'.'.$image->getClientOriginalExtension();//part of image intervention
            $location=public_path('/images/about/'.$filename);
            // use $location='images/'.$filename; on a server
            if($request['type'][$key]=='about')
                Image::make($image)->resize(800,400)->save($location);
            else
                Image::make($image)->resize(400,400)->save($location);

            $about->image=$filename;
            $about->save();
            }
        
        }

            session::flash('success', 'The About data Has Been Added Successfully!');
            return redirect()->route('aboutus.index');


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
