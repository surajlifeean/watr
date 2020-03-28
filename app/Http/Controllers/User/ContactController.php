<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use Session;


class ContactController extends Controller
{
        public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('contact');
    }
        public function store(Request $request)
    {
        // dd($request);
       $support=new Contact;
       $support->subject   =$request->subject;
       $support->msg   =$request->msg;
       $support->name      =$request->name;
       $support->phone      =$request->phone;
       $support->email     =$request->email;
       // echo"<pre>";
       // print_r($support);
       // dd();
       $support->save();
        session::flash('success', 'The Message Has Been Sent Successfully!');
         return redirect()->route('contact.index');
    }
    // public function index()
    // {
    //     return view('contact');
    // }
}
