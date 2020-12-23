<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function about()
    {
        $about=About::where('type','about')->orderby('created_at','desc')->first();
        $service=About::where('type','service')->orderby('created_at','desc')->get();

        $product=About::where('type','product')->orderby('created_at','desc')->get();

        $founder=About::where('type','founder')->orderby('created_at','desc')->get();

        $carrier=About::where('type','career')->orderby('created_at','desc')->get();


        // dd($about);
        return view('about')->withAbout($about)->withService($service)->withProduct($product)->withFounder($founder)->withCarrier($carrier);
    }
}
