<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Partner;
use App\Member;
use Hash;

class PartnerController extends Controller
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
        $member_id=Partner::find($id);
        // dd($member_id['member_id']);
        $member=Member::find($member_id['member_id']);
        


        if(is_null($member)){
                    $lab=$member_id['labname'];
        $mid = strtolower(str_replace(' ', '_', $lab)).$member_id['member_id'].'@watr.com';
        $data['lab']=$lab;
        $data['id']=$mid;
        $data['partner_id']=$id;
                $data['password']='partner123';
                $data['member_id']=99999;
            }
        else{
                $data['password']='**********';
                $data['lab']=$member['company_name'];
                $data['id']=$member['email'];
                $data['member_id']=$member['id'];
                $data['partner_id']=$id;
            }



        return view('admin.partner.profile')->withData($data);
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
        $flag=0;

        if($id==99999){
            #this means that the member is new create a new entry in member table
            $member=new Member;
            $member->password=Hash::make($request['password']);
        }
        else{
            #update the existing entry
            $member=Member::find($id);
            if(!$request['password']=="**********");
            {# save the new password else do nothing
            $member->password=Hash::make($request['password']);
            }
            $flag=1;
        }
            $member->company_name=$request['company_name'];
            $member->email=$request['email'];

            $member->save();
            if($flag){
                 $partner=Partner::find($request['partner_id']);
                 $partner->member_id=$id;
            }

            $request->session()->flash('success', 'Partner credentials updated successfully.');
            return redirect('/admin/partner');
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
