<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class MemberLoginController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest:member',['except'=>['logout']]);
    }    
    public function showLoginForm()
    {
        // dd("show partner login");

    	return view('auth.member-login');
    }

    public function login(Request $request)
    {
    	//validate teh for data

    	$this->validate($request,[
    		'email'=>'required|email',
    		'password'=>'required|min:6'
    	]);

    	//attempt to log the user  in

    	if(Auth::guard('member')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){

    	// if successfull redirect to intended loc

    		return redirect()->intended(route('member'));

    	}

    		return redirect()->back()->withInput($request->only('email','remember'));
    	//not successfull redirect back to login with form data
    }

        public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        return redirect('/member/login');
    }
}
