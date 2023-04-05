<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\doctor;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;

class doctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('doctor.view')) {

        $data = doctor::paginate(10);
        return view('doctor.index')->with(['data'=>$data]);

        }
        return redirect(route('home'));
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('doctor.create') && Auth::user()->can('doctor.view')) {

        return view('doctor.create');

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
        ]);

        try {
            $doctor = new doctor();
            $doctor->name ='Dr. '. $request->name;
            $doctor->phone = $request->phone;
            $doctor->save();
            Session::flash('success','New doctor successfully Saved');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect('/doctor');
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
        if (Auth::user()->can('doctor.update')) {

     $data = doctor::findorfail($id);
     return view('doctor.edit')->with(['data'=>$data]);

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
        ]);

        try {
            $doctor = doctor::findorfail($id);
            $doctor->name ='Dr. '. $request->name;
            $doctor->phone = $request->phone;
            $doctor->save();
            Session::flash('success','doctor Data Updated');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect('/doctor');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('doctor.delete')) {

        $data = doctor::findorfail($id);
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
