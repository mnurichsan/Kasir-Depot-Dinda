<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;

class pegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pegawai::all();

        return view('pegawai.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.tambah');
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
            //code...
            $this->validate($request, [
                'nama' => 'required|min:3',
                'umur' => 'required',
                'jeniskelamin' => 'required',
                'alamat' => 'required',
                'nohp' => 'required',
                'status' => 'required',
                'gambar' => 'required'
            ]);

            $gambar = $request->gambar;
            $new_gambar = time() . $gambar->getClientOriginalName();


            $data_pegawai = [
                'nama' => $request->nama,
                'umur' => $request->umur,
                'jeniskelamin' => $request->jeniskelamin,
                'alamat' => $request->alamat,
                'nohp' => $request->nohp,
                'status' => $request->status,
                'gambar' => 'public/uploads/pegawai/' . $new_gambar
            ];

            Pegawai::create($data_pegawai);
            $gambar->move('public/uploads/pegawai', $new_gambar);
            \Session::flash('sukses', 'Data berhasil di tambah');

            return redirect()->route('pegawai.index');
        } catch (Exception $e) {
            \Session::flash('gagal', $e);
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
        $data = Pegawai::findOrFail($id);

        return view('pegawai.edit', compact('data'));
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
            //code...
            $this->validate($request, [
                'nama' => 'required|min:3',
                'umur' => 'required',
                'jeniskelamin' => 'required',
                'alamat' => 'required',
                'nohp' => 'required',
                'status' => 'required'
            ]);

            if ($request->has('gambar')) {

                $gambar = $request->gambar;
                $new_gambar = time() . $gambar->getClientOriginalName();


                $data_pegawai = [
                    'nama' => $request->nama,
                    'umur' => $request->umur,
                    'jeniskelamin' => $request->jeniskelamin,
                    'alamat' => $request->alamat,
                    'nohp' => $request->nohp,
                    'status' => $request->status,
                    'gambar' => 'public/uploads/pegawai/' . $new_gambar
                ];

                $gambar->move('public/uploads/pegawai', $new_gambar);
            } else {

                $data_pegawai = [
                    'nama' => $request->nama,
                    'umur' => $request->umur,
                    'jeniskelamin' => $request->jeniskelamin,
                    'alamat' => $request->alamat,
                    'nohp' => $request->nohp,
                    'status' => $request->status
                ];
            }
            Pegawai::findOrFail($id)->update($data_pegawai);
            \Session::flash('sukses', 'Data berhasil di edit');
            return redirect()->route('pegawai.index');
        } catch (\Exception $e) {
            \Session::flash('gagal', $e->getMessage());
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
            Pegawai::findOrFail($id)->delete();
            \Session::flash('sukses', 'Data berhasil di hapus');
        } catch (\Exception $e) {
            \Session::flash('gagal', $e->getMessage());
            return redirect()->back();
        }
    }
}
