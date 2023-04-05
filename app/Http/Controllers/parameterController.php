<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\test;
use App\testparameter;
use Carbon\Carbon;
class parameterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $test = test::all();
        return view('testparameter.create')->with(['test'=>$test]);
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
            'test'=>'required|numeric',
        ]);

        try {
            $testparameter = new testparameter();
            $testparameter->name = $request->name;
            $testparameter->normal = $request->normal;
            $testparameter->unit = $request->unit;
            $testparameter->test_id = $request->test;
            $testparameter->save();
            Session::flash('success','New Test Parameter successfully Saved');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect(route('test.show',$request->test));
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
        $test = test::all();
        $data = testparameter::findorfail($id);
        return view('testparameter.edit')->with(['data'=>$data,'test'=>$test]);
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
            'test'=>'required|numeric',
        ]);

        try {
            $testparameter = testparameter::findorfail($id);
            $testparameter->name = $request->name;
            $testparameter->normal = $request->normal;
            $testparameter->unit = $request->unit;
            $testparameter->test_id = $request->test;
            $testparameter->save();
            Session::flash('success','testparameter Data Updated');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect('test/'.$request->test);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = testparameter::findorfail($id);
        try {
            $data->delete();
            Session::flash('success','successfully Deleted');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect()->back();
    }
}
