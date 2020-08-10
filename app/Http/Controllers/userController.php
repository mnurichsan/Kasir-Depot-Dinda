<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

        return view('user.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request,[
                'name' => 'required|min:3',
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $data_user = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Hash::make($request->password)
            ];

            User::create($data_user);
            \Session::flash('sukses','Data berhasil ditambah');
            return redirect()->route('user.index');
        } catch (Exception $e) {
            \Session::flash('gagal',$e);
            return redirect()->back();
        }
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
        $data = User::findOrFail($id);

        return view('user.edit',compact('data'));
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
        try {
             $this->validate($request,[
                'name' => 'required|min:3',
                'email' => 'required|email',
            ]);

            $data_user = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            User::findORfail($id)->update($data_user);
            \Session::flash('sukses','Data berhasil di edit');
            return redirect()->route('user.index');
        } catch (Exception $e) 
        {
            \Session::flash('gagal',$e);
            return redirect()->back();
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
        try {
            User::findOrFail($id)->delete();
            \Session::flash('sukses','data berhasil di hapus');
            return redirect()->route('user.index');
        } catch (Exception $e) 
        {
            \Session::flash('gagal',$e);
            return redirect()->back();
        }
    }
}
