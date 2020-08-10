<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Setoran;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;
use App\Exports\SetoranExport;

class laporanController extends Controller
{
    public function transaksiIndex()
    {
        $transaksi = Transaksi::all();
        return view('laporan.transaksi',compact('transaksi'));
    }
    public function exportExcelTransaksi()
    {
        $nama_file = 'laporan_transaksi_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new TransaksiExport, $nama_file);
    }

    public function setoranIndex()
    {
        $setoran = Setoran::all();
        return view('laporan.setoran',compact('setoran'));
    }
    public function exportExcelSetoran()
    {
        $nama_file = 'laporan_setoran_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new SetoranExport, $nama_file);
    }
}
