<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PartnerAssistant;

class AssistanceController extends Controller
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
        $assistant=PartnerAssistant::get();
        
        return view('admin.assistance.index')->withAssistance($assistant);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $partner=PartnerAssistant::find($id);
        return view('admin.assistance.show')->withAssistance($partner);
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
    
    public function statuschange($id,Request $request)
    {   //dd($id);
        $partner =PartnerAssistant::find($id);
        if($partner->status == 'A'){
            $partner->status = 'N';
            if($partner->save()){
                $request->session()->flash('success', 'Partner Status Set To New Successfully.');
                return redirect('/admin/assistance');
            }
        } else {
            $partner->status = 'A';
            if($partner->save()){
                $request->session()->flash('success', 'Partner Status Set To Responded Successfully.');
                return redirect('/admin/assistance');
            }
        }
    }

}
