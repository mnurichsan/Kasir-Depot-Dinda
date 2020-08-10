<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Barang;
use App\Pegawai;
use App\Setoran;
Use App\Transaksi;
use App\Charts\PemasukanChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $barang = Barang::count();
        $pegawai = Pegawai::all();
        $setoran = Setoran::orderBy('created_at','DESC')->take(5)->get();
        $transaksi = Transaksi::select('id')->count();

        $suspects = Setoran::all();
        foreach ($suspects as $value) {
            $labels[] = $value->tanggal_setoran->format('d m Y');
        }
        $data   = $suspects->pluck('total_bayar');

        $chart = new PemasukanChart;
        $chart->labels($labels);
        $chart->dataset('Data Pemasukan', 'bar', $data)->backgroundColor('blue');
        return view('home',compact('barang','pegawai','setoran','transaksi','chart'));
    }

    
}
