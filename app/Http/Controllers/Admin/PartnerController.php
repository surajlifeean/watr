<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Partner;


class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partner=Partner::all();
    
        return view('admin.partner.index')->withPartners($partner);
 
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
        $partner=Partner::find($id);
        return view('admin.partner.show')->withPartner($partner);
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

    public function delete($id,Request $request)
    {   
        $partner=Partner::find($id);
        $partner->delete();
        $request->session()->flash('success', 'The Partner Details Has Been Deleted.');
        return redirect('/admin/partner');
        
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
