<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Session;
use App\Partner;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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

        // for listin of orders assigned to a partner
        if(Auth::guard('member')->check()){
            $member_id=Auth::guard('member')->user()->id;
            $partner=Partner::where('member_id',$member_id)->first();
            if(isset($partner))
                $order=$partner->orders;
            else
                $order=null;
            // dd($order);
            // $order=Order
        }
        else{
            $order=Order::all();
        }

        
        return view('admin.order.index')->withOrders($order);
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
        $order=Order::find($id);
        $partner=Partner::get();
        return view('admin.order.show')->withOrder($order)->withPartners($partner);
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
        

// dd($request['test']);

        // execute when the request is from member 
        if(Auth::guard('member')->check()){
        $order=Order::find($id);
        $order->order_status=$request->status;
        $order->save();
}
else{
        // execute when the request is from admin 
        $order=Order::find($id);
        $order->order_status=$request->status;
        $order->save();
        $order->partners()->sync($request->partner);
}



        session::flash('success', 'Order Status Has Been Updated Successfully!');
        return redirect()->route('order.index');

        // return view('admin.order.show')->withOrder($order);
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
