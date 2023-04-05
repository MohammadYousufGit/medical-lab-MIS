<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\branch;
use Illuminate\Support\Facades\Auth;
use Session;

class branchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('branch.view')) {


        $data = branch::paginate(10);
        return view('branch.index')->with(['data'=>$data]);
        }
        return redirect(route('home'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('branch.create')) {


        return view('branch.create');
        }
        return redirect(route('home'));
    }
    public function __construct()
    {
        $this->middleware('auth');
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
        ]);

        try {
            $branch = new branch;
            $branch->name = $request->name;
            $branch->save();
            Session::flash('success','New Branch successfully Saved');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect('/branch');
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
        if (Auth::user()->can('branch.edit')) {

     $data = branch::findorfail($id);
     return view('branch.edit')->with(['data'=>$data]);

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
        ]);

        try {
            $branch = branch::findorfail($id);
            $branch->name = $request->name;
            $branch->save();
            Session::flash('success','Branch Data Updated');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect('/branch');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('branch.delete')) {

        $data = branch::findorfail($id);
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
