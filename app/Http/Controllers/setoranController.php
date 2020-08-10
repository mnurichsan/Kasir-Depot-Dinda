<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setoran;
use App\Pegawai;
use App\transaksi;
use Redirect,Response;

class setoranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Setoran::with('transaksi')->where('tanggal_setoran',date("Y-m-d"))->get();
        $pegawai = Pegawai::where('status','Aktif')->get();

        return view('setoran.index',compact('data','pegawai'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
                'tanggal_setoran' => 'required',
                'pegawai' => 'required'
            ]);

            $data_setoran = [
                'kode_setoran' => $request->kode_setoran,
                'tanggal_setoran' => $request->tanggal_setoran,
                'id_pegawai' => $request->pegawai,
                'total_bayar' => 0,
                'total_setoran' => 0,
                'kembalian' =>0
            ];

            Setoran::create($data_setoran);
            \Session::flash('sukses','Data berhasil di tambah');
            return redirect()->back();
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
        $t = Transaksi::with('barang')->where('id_setoran',$id)->get();
        return Response::json($t);
        // dd();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $kembalian = $request->total_setoran - $request->total_bayar;

        $data_setoran = [
            'total_bayar' => $request->total_bayar,
            'total_setoran' => $request->total_setoran,
            'kembalian' => $kembalian,
        ];

        Setoran::findOrFail($id)->update($data_setoran);
        return redirect()->back();
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
            Setoran::findOrFail($id)->delete();
            \Session::flash('sukses','Data berhasil di hapus');
            return redirect()->back();
        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage());
            return redirect()->back();
        }
    }
}
