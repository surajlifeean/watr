<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{


	public function __construct()
    {
        $this->middleware('guest:admin');
    }    
    public function showLoginForm()
    {
    	return view('auth.admin-login');
    }

    public function login(Request $request)
    {
    	//validate teh for data

    	$this->validate($request,[
    		'email'=>'required|email',
    		'password'=>'required|min:6'
    	]);

    	//attempt to log the user  in

    	if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){

    	// if successfull redirect to intended loc

    		return redirect()->intended(route('admin'));

    	}


    		return redirect()->back()->withInput($request->only('email','remember'));
    	//not successfull redirect back to login with form data
    }
}
