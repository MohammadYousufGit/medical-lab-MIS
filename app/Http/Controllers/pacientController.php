<?php

namespace App\Http\Controllers;
use App\pacient_test;
use App\pacienttestresult;
use Illuminate\Http\Request;
use App\pacient;
use App\test;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\doctor;
use App\pacienttest;

class pacientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $bill = pacienttestresult::all();


         $haveTest = pacient_test::whereNotIn('id',$bill->pluck('pacienttest_id'))->get();


        if (Auth::user()->branch_id== 49) $data = pacient::whereIn('id',$haveTest->pluck('pacient_id'))->orderBy('created_at','desc')->get();
        else
        $data = pacient::where('branch_id',Auth::user()->branch_id)->whereIn('id',$haveTest->pluck('pacient_id'))->orderBy('created_at','desc')->get();
        return view('pacient.index')->with(['data'=>$data, 'haveTest',$haveTest]);
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for Creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('pacient.create')) {
            $tests = test::all();
            $doctor = doctor::all();
            return view('pacient.create')->with(['doctor'=>$doctor,'tests'=>$tests]);
        }
        return redirect(route('home'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required|string',
            'phone'=>'required|numeric',
            'age'=>'required|numeric',
            'doctor'=>'required|numeric',
            'total'=>'required|numeric',
            'grant'=>'required|numeric',
            'gender'=>'required|numeric',
            'address'=>'required|string',
        ]);
        try {
            $pacient = new pacient;
            $pacient->name = $request->name;
            $pacient->phone = $request->phone;
            $pacient->age = $request->age;
            $pacient->gender = $request->gender;
            $pacient->doctor_id = $request->doctor;
            $pacient->address = $request->address;
            $pacient->total_amount = $request->grant;
            $pacient->discount = $request->discount;
            $pacient->branch_id = Auth::user()->branch_id;
            $pacient->save();
            $pid = $pacient->id;
            $pacient->tests()->sync($request->tests);
            $pacient = pacient::findOrFail($pid);

            return redirect(route('edit.pacient',$pid));

            Session::flash('success','New pacient successfully Saved');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
            return redirect(route('pacient.index'));
        }

    }
    public function edit_pacient($id)
    {
    	$pacient = pacient::findOrFail($id);

            $tests = test::all();
            $doctor = doctor::all();
            return view('pacient.receipt',compact('pacient','tests','doctor'));
    }
    public function PrintBill($id){

        $pacient = pacient::findOrFail($id);
        $pacienttest = pacient_test::where('pacient_id',$id)->get();


        $test = test::whereIn('id',$pacienttest->pluck('test_id'))->get();
        return view('pacient.showbill',compact('pacient','test','pacienttest'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $pacient = pacient::findorfail($id);
        // $testadded = pacienttest::where('pacient_id',$id)->get();
        // $test = test::whereNotIn('id',$testadded->pluck('test_id'))->get();
        // return view('pacienttest.index')->with(['pacient'=>$pacient,'testadded'=>$testadded,'test'=>$test]);


    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (Auth::user()->can('pacient.update')) {
            $doctor = doctor::all();
            $pacient = pacient::findorfail($id);
            

             $pacienttest = pacient_test::where('pacient_id',$pacient->id)->get();
             $tests = test::whereIn('id',$pacienttest->pluck('test_id'))->get();

            $pacienttests = pacient_test::where('pacient_id',$pacient->id)->get();
             $pacienttestresults = pacienttestresult::where('pacienttest_id',$pacienttests->pluck('id'))->get();
            return view('pacient.edit')->with(['pacient'=>$pacient,'doctor'=>$doctor,'pacienttestresults'=>$pacienttestresults,'pacienttests'=>$pacienttests,'tests'=>$tests]);

        }
        return redirect(route('home'));

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
        $this->validate($request,[
           'name'=>'required|string',
            'phone'=>'required|numeric',
            'age'=>'required|numeric',
            'doctor'=>'required|numeric',
            'gender'=>'required|numeric',
            'address'=>'required|string', 
        ]);

        try {
            $pacient = pacient::findOrFail($id);
            $pacient->name = $request->name;
            $pacient->phone = $request->phone;
            $pacient->age = $request->age;
            $pacient->gender = $request->gender;
            $pacient->doctor_id = $request->doctor;
            $pacient->address = $request->address;
            $pacient->total_amount = $request->grant;
            $pacient->discount = $request->discount;

            $pacient->branch_id = Auth::user()->branch_id;

            $pacient->update();

            $pacient->tests()->sync($request->tests);
            $pacient = pacient::findOrFail($id);

            $tests = test::all();
            $doctor = doctor::all();
            Session::flash('success','New pacient successfully updated');
            return view('pacient.receipt',compact('pacient','tests','doctor'));

        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
            return redirect(route('pacient.index'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = pacient::findorfail($id);
        try {
            $data->delete();
            Session::flash('success','successfully Deleted');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect()->back();
    }
}
