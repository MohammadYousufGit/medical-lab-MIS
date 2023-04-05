<?php

namespace App\Http\Controllers;

use App\branch;
use App\role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('user.create')) {

            return redirect(route('register'));
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
        $this->validate($request,['name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user =new User;
        try{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->branch_id = $request->branch_id;
            $user->password = bcrypt($request->password);

            Session::flash('success','New Branch successfully Saved');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }
        $user->roles()->sync($request->role);

        return redirect(route('user.index'));
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
        if (Auth::user()->can('user.update')) {
            $user = User::find($id);
            $roles = role::all();
            return view('user.edit', compact('user', 'roles'));
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

        $this->validate($request,['name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255'

        ]);

        try{
            $user = User::where('id',$id)->update($request->except('_token','_method','role'));
            User::find($id)->roles()->sync($request->role);
            Session::flash('success','The user successfully updated');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }

        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            User::find($id)->delete();
            Session::flash('success','successfully Deleted');
        } catch (Exception $e) {
            Session::flash('exception',$e->getMessage());
        }

        return redirect()->back();
    }
}
