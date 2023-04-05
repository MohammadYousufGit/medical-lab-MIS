<?php

namespace App\Http\Controllers;

use App\pacient;
use App\pacient_test;
use App\pacienttest;
use App\pacienttestresult;
use App\test;
use App\material;
use App\testparameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class testresultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bill = pacienttestresult::all();


        $data = pacienttest::whereNotIn('id',$bill->pluck('pacienttest_id'))->get();
        return view('testresult.index')->with(['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //pa
    }

    public function PrintBill($id){

        $pacient = pacient::findOrFail($id);
        $pacienttests = pacient_test::where('pacient_id',$id)->get();
           $pacienttestresults = pacienttestresult::whereIn('pacienttest_id',$pacienttests->pluck('id'))->get();
        $test = test::whereIn('id',$pacienttests->pluck('test_id'))->get();

        return view('testresult.detail',compact('pacient','test','pacienttests','pacienttestresults'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,pacient $id)
    {

        $user_id = Auth::user()->id;
        $branch_id = Auth::user()->branch_id;


        $pacienttest = pacient_test::where('pacient_id',$request->pid)->get();


            $tests = test::whereIn('id',$pacienttest->pluck('test_id'))->get();


        for ($i=0;$i<count($request->testResult);$i++){

            $pacienttestresult = new pacienttestresult;
            $pacienttestresult->pacienttest_id = $request->pacienttest_id[$i];
            $pacienttestresult->user_id = $user_id;
            $pacienttestresult->parameter_id = $request->parameter_id[$i];
            $pacienttestresult->result =$request->testResult[$i] ;
            $pacienttestresult->save();

        }
        foreach ($tests as $test) {
           $materials = material::where('test_id',$test->id)->where('branch_id',$branch_id)->get();
            foreach ($materials as $material) {
                $quantity = $material->quantity;
           $material->quantity = $quantity-1;
           $material->update();

            }
           

        }
        return redirect(route('showAllPacientlist'));



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

//        return $request->parameter_id;
        $user_id = Auth::user()->id;

        $this->validate($request,[
            'name'=>'required|string',
            'phone'=>'required|numeric',
            'age'=>'required|numeric',
            'doctor'=>'required|numeric',
            'gender'=>'required|numeric',
            'address'=>'required|string',
        ]);


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
        for ($i=0;$i<count($request->testResult);$i++){


            $pacienttestresult = pacienttestresult::where([
                ['pacienttest_id','=',$request->pacienttest_id[$i]],
                ['parameter_id','=',$request->parameter_id[$i]]
            ])->firstOrFail();
            $pacienttestresult->pacienttest_id = $request->pacienttest_id[$i];
            $pacienttestresult->user_id = $user_id;
            $pacienttestresult->parameter_id = $request->parameter_id[$i];
            $pacienttestresult->result =$request->testResult[$i] ;
            $pacienttestresult->update();
        }

        return redirect(route('print_result',$id));

    }


    public function showAllPacientlist(){
        $bill = pacienttestresult::all();

         $haveTest = pacient_test::whereIn('id',$bill->pluck('pacienttest_id'))->get();
        if (Auth::user()->branch_id== 49)
            $data = pacient::whereIn('id',$haveTest->pluck('pacient_id'))->orderBy('created_at','desc')->get();
            else
         $data = pacient::where('branch_id',Auth::user()->branch_id)->whereIn('id',$haveTest->pluck('pacient_id'))->orderBy('created_at','desc')->get();

        return view('testresult.showAllPacients')->with(['data'=>$data]);
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
    public function saveResult($id){

        if (Auth::user()->can('add_test')) {


        $pacient = pacient::findOrFail($id);
        $pacienttests = pacient_test::where('pacient_id',$id)->get();


         $parameters = testparameter::whereIn('test_id',$pacienttests->pluck('test_id'))->get();
        return view('testresult.add',compact('parameters','pacient','pacienttests'));
        }
        return redirect(route('home'));


    }
}
