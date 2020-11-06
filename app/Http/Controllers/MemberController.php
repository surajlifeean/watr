<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Order;
use App\Partner;
use App\Test;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:member');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         // dd(Auth());
        $users=User::count();
        $orders=Order::count();
        $partners=Partner::count();
        $tests=Test::count();

        // dd(count($course));


        $var['user']=$users;
        $var['order']=$orders;
        $var['partner']=$partners;
        $var['test']=$tests;
        
        return view('admin.home')->withVar($var);
    }
}
