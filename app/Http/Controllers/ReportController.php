<?php

namespace App\Http\Controllers;

use App\branch;
use App\doctor;
use App\material;
use App\pacient;
use App\test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    public function showTodayReport(){
        if (Auth::user()->can('')) {


        if (Auth::user()->branch_id== 49) {
            $materials = material::whereDate('created_at', '>=', Carbon::now()->startOfDay())->orWhereDate('updated_at', '>=', Carbon::now()->startOfDay())->get();
            $pacients = pacient::where('created_at', '>=', Carbon::now()->startOfDay())->get();
        }
        else{
            $materials = material::where('branch_id',Auth::user()->branch_id)->whereDate('created_at', '>=', Carbon::now()->startOfDay())->orWhereDate('updated_at', '>=', Carbon::now()->startOfDay())->get();
            $pacients = pacient::where('branch_id',Auth::user()->branch_id)->where('created_at', '>=', Carbon::now()->startOfDay())->get();

        }
        return view('report.index',compact('materials','pacients'));
        }
        return redirect(route('home'));

    }

    public function tabularForm(){
    if (Auth::user()->can('tabular_report')) {


        $doctors = doctor::all();
        $branches = branch::all();
        $tests = test::all();
        return view('report.form' ,compact('branches','doctors','tests'));
    }
    return redirect(route('home'));
    }
public function ssForm(){

if (Auth::user()->can('sale_summary')) {


        $branches = branch::all();

        return view('report.ssform' ,compact('branches'));
}
return redirect(route('home'));
    }

    public function showTabularForm(Request $request){

        $from = $request->from;
        $to = $request->to;
        $testPacients = [];
        if ($request->test_id != null) {
            $testPacients = test::whereBetween('created_at', [$from, $to])->find($request->test_id);
            $materials = material::whereBetween('created_at', [$from, $to])->orWhereBetween('updated_at', [$from, $to])->get();
        }

        else {
            $testPacients = test::whereBetween('created_at', [$from, $to])->get();
            $materials = material::whereBetween('created_at', [$from, $to])->orWhereBetween('updated_at', [$from, $to])->get();
        }
        $pacients = '';

        /**
         * create patients report and check if admin checks or others
         *
         *
         */
if (Auth::user()->branch_id == 49) {

    if ($request->doctor == null && $request->branch == null)
         $pacients = pacient::whereBetween('created_at', [$from, $to])->get();

    elseif ($request->doctor == null)
        $pacients = pacient::where([
            ['branch_id', '=', $request->branch],

        ])->whereBetween('created_at', [$from, $to])->get();


    elseif ($request->branch == null)
        $pacients = pacient::where([
            ['doctor_id', '=', $request->doctor],
        ])->whereBetween('created_at', [$from, $to])->get();

    else
        $pacients = pacient::where([
            ['doctor_id', '=', $request->doctor],
            ['branch_id', '=', $request->branch],

        ])->whereBetween('created_at', [$from, $to])->get();
}
else{

    if ($request->doctor == null && $request->branch == null)
        $pacients = pacient::where('branch_id',Auth::user()->branch_id)->whereBetween('created_at', [$from, $to])->get();

    elseif ($request->doctor == null)
        $pacients = pacient::where('branch_id',Auth::user()->branch_id)->where([
            ['branch_id', '=', $request->branch],

        ])->whereBetween('created_at', [$from, $to])->get();


    elseif ($request->branch == null)
        $pacients = pacient::where('branch_id',Auth::user()->branch_id)->where([
            ['doctor_id', '=', $request->doctor],
        ])->whereBetween('created_at', [$from, $to])->get();

    else
        $pacients = pacient::where('branch_id',Auth::user()->branch_id)->where([
            ['doctor_id', '=', $request->doctor],
            ['branch_id', '=', $request->branch],

        ])->whereBetween('created_at', [$from, $to])->get();
    }
        return view('report.tabular',compact('materials','pacients','testPacients','from','to'));

    }
    public function showssForm(Request $request){

        $from = $request->from;
        $to = $request->to;


        $pacients = '';

        /**
         * create patients report and check if admin checks or others
         *
         *
         */
if (Auth::user()->branch_id == 49) {

if ($request->branch_id != null)
         $pacients = pacient::where(['branch_id','=',$request->branch_id])->whereBetween('created_at', [$from, $to])->get();
else
         $pacients = pacient::whereBetween('created_at', [$from, $to])->get();


}
else{


        $pacients = pacient::where('branch_id',Auth::user()->branch_id)->whereBetween('created_at', [$from, $to])->get();


    }

        return view('report.ss',compact('pacients','from','to'));

    }
}
