<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class barangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::all();

        return view('barang.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.tambah');
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
            'namabarang' => 'required|min:3',
            'hargabarang' => 'required',
            'gambar' => 'required'
        ]);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $data_barang = [
            'namabarang' => $request->namabarang,
            'hargabarang' => $request->hargabarang,
            'gambar' => 'public/uploads/barangs/'.$new_gambar
        ];

        Barang::create($data_barang);
        $gambar->move('public/uploads/barangs/',$new_gambar);
        \Session::flash('sukses','Data barang berhasil di tambah');

        return redirect()->route('barang.index');

        } catch (Expection $e) {
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
        $data = Barang::findOrFail($id);
        return view('barang.edit',compact('data'));
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
                'namabarang' => 'required|min:3',
                'hargabarang' => 'required',
            ]);

            if($request->has('gambar'))
            {
                $gambar = $request->gambar;
                $new_gambar = time().$gambar->getClientOriginalName();

                $data_barang = [
                'namabarang' => $request->namabarang,
                'hargabarang' => $request->hargabarang,
                'gambar' => 'public/uploads/barangs/'.$new_gambar
                ];

                $gambar->move('public/uploads/barangs/',$new_gambar);


            }else {
                $data_barang = [
                'namabarang' => $request->namabarang,
                'hargabarang' => $request->hargabarang
                ];
                
            }

            Barang::findOrFail($id)->update($data_barang);
            \Session::flash('sukses','Data barang berhasil di edit');

            return redirect()->route('barang.index');
            

        } catch (Exception $e) {
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
            $data = Barang::findOrFail($id)->delete();
            \Session::flash('sukses','Data barang berhasil di hapus');
            return redirect()->route('barang.index');
        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage());
            return redirect()->back();
        }
        
    }

   
}
