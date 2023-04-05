<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\test;
use App\department;
use App\testparameter;
use Carbon\Carbon;
class testController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = test::orderBy('created_at','desc')->paginate(10);
        return view('test.index')->with(['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('test.create')) {


        $department = department::all();
        return view('test.create')->with(['department'=>$department]);
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
            'fee'=>'required|numeric',
            'code'=>'required',
            'department'=>'required|numeric',
        ]);

        try {
            $test = new test();
            $test->name = $request->name;
            $test->fee = $request->fee;
            $test->comment = $request->comment;
            $test->code = $request->code;
            $test->department_id = $request->department; 
            $test->save();
            Session::flash('success','New test successfully Saved');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect('/test');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data=testparameter::where('test_id',$id)->get();
      $test = test::findorfail($id);
      return view('test.detail')->with(['data'=>$data,'test'=>$test]);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('test.update')) {


     $department = department::all();
     $data = test::findorfail($id);
     return view('test.edit')->with(['data'=>$data,'department'=>$department]);
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
            'fee'=>'required|numeric',
            'code'=>'required',
            'department'=>'required|numeric', 
        ]);

        try {
            $test = test::findorfail($id);
            $test->name = $request->name;
            $test->fee = $request->fee;
            $test->comment = $request->comment;
            $test->code = $request->code;
            $test->department_id = $request->department;
            $test->save();
            Session::flash('success','test Data Updated');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect('/test');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('test.delete')) {

        $data = test::findorfail($id);
        try {
            $data->delete();
            Session::flash('success','successfully Deleted');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect()->back();

        }
        return redirect(route('home'));
    }
}
