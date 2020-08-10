<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setoran;
use App\Barang;
use App\Transaksi;

class transaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $harga_barang = Barang::where('id',$request->id_barang)->first();
        $data_transaksi = [
            'alamat' => $request->alamat,
            'id_setoran' =>$request->id_setoran,
            'id_barang' =>$request->id_barang,
            'jumlah_pembelian' =>$request->jumlah_pembelian,
            'total_harga' => $harga_barang->hargabarang * $request->jumlah_pembelian,
        ];

        Transaksi::create($data_transaksi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode,$id)
    {
        $data = Setoran::findOrFail($id)->where('kode_setoran',$kode)->first();
        $barang = Barang::all();
        $transaksi = Transaksi::where('id_setoran',$id)->get();
        
        return view('transaksi.index',compact('data','barang','transaksi'));
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
        $harga_barang = Barang::where('id',$request->id_barang)->first();
        $data_transaksi = [
            'alamat' => $request->alamat,
            'id_setoran' =>$request->id_setoran,
            'id_barang' =>$request->id_barang,
            'jumlah_pembelian' =>$request->jumlah_pembelian,
            'total_harga' => $harga_barang->hargabarang * $request->jumlah_pembelian,
        ];

        Transaksi::findOrFail($id)->update($data_transaksi);
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
        Transaksi::findOrFail($id)->delete();
        \Session::flash('sukses','data berhasil di hapus');
        return redirect()->back();
    }

}
