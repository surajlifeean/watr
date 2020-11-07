<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use App\Order;
use App\Partner;
use Session;
use PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.report.report');

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
        public function __construct()
    {
        $this->middleware('auth');
    }


    public function show($id)
    {
        // dd($id);
        $order=Order::find($id);
        $partner=Partner::get();
        $report=Report::where('order_id',$id)->get();

        // dd($report);

        return view('admin.report.show')->withOrder($order)->withPartners($partner)->withReports($report);

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

        $rep=Report::where('order_id',$id)->get();

        foreach ($rep as $k => $v) {
            
            $v->delete();
        }

        foreach ($request['test']['test'] as $key => $value) {
            
        $report=new Report;
        $report->note=$request['note'];
        $report->lab_id=$request['partner'];
        $report->order_id=$id;
        $report->test_name=$value;
        $report->parameter=$request['test']['parameter'][$key];
        $report->mcl=$request['test']['mcl'][$key];
        $report->mdl=$request['test']['mdl'][$key];
        $report->result=$request['test']['result'][$key];
        $report->outcome=$request['test']['outcome'][$key];

        $report->save();

        }

        session::flash('success', 'The Report Has Been Updated Successfully!');
        return redirect()->route('order.index');

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

    public function pdfReport($id)
    {

        $order=Order::find($id);
        $reports=Report::where('order_id',$id)->get();

        $labid=Report::where('order_id',$id)->distinct('lab_id')->pluck('lab_id');
        
        $partner=Partner::where('id',$labid)->first();

        $data['reports']=$reports;
        $data['partner']=$partner;


        $pdf = \PDF::loadView('admin.report.report', compact('data'));

        $filename='report'.'-'.$labid[0].'-'.time().'.pdf';
        $path=public_path('/images/reports/'.$filename);
        $pdf->save($path);


        foreach ($reports as $r) {
            $rep=Report::find($r->id);
            $rep->filename=$filename;
            $rep->save();
        }



        // return view('admin.report.report')->withOrder($order)->withData($data);
        session::flash('success', 'The Report Has Been Generated Successfully!');
        return redirect()->route('report.show',$id);


    }


}
