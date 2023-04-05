<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\material;
use App\branch;
use App\test;
use Carbon\Carbon;
use DB;
class materialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('material.view')) {


        $data = material::orderBy('quantity','asc')->paginate(10);
        return view('material.index')->with(['data'=>$data]);
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
        if (Auth::user()->can('material.create')) {


        $test = test::all();
        $branch = branch::all();
        return view('material.create')->with(['test'=>$test,'branch'=>$branch]);
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
            'quantity'=>'required|numeric',
            'test'=>'required|numeric',
            'branch'=>'required|numeric',
        ]);

        try {
            $material = new material();
            
            $material->quantity = $request->quantity;
            $material->test_id = $request->test;
            $material->branch_id = $request->branch; 
            $material->save();
            Session::flash('success','New material successfully Saved');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect('/material');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('material.update')) {

     $test = test::all();
     $branch = branch::all();
     $data = material::findorfail($id);
     return view('material.edit')->with(['data'=>$data,'test'=>$test,'branch'=>$branch]);

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
            'quantity'=>'required|numeric',
            'test'=>'required|numeric',
            'branch'=>'required|numeric', 
        ]);

        try {
            $material = material::findorfail($id);

            $material->quantity = $request->quantity;
            $material->test_id = $request->test;
            $material->branch_id = $request->branch;
            $material->update();
            Session::flash('success','material Data Updated');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        return redirect('/material');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('material.delete')) {

        $data = material::findorfail($id);
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

    public function less()
    {
        $data = material::where('quantity','<',7)->get();
        return view('material.less')->with(['data'=>$data]);
    }

    public function addQuantity(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|numeric',
            'quantity'=>'required|numeric', 
        ]);

        try {
                $material = material::findorfail($request->id);     
                $oldQuantity = $material->quantity;
                $newQuantity = $request->quantity + $oldQuantity;
                $result = DB::table('materials')
                ->where('id', $request->id)
                ->update(['quantity' =>$newQuantity]);
                Session::flash('success','successfully new quantity added');
            } catch (Exception $e) {
                Session::flash('exception',$e->getMessage());    
            }
            return redirect('/material');

    }
}
