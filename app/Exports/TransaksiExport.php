<?php

namespace App\Exports;

use App\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{
    
     public function view(): View
    {
        return view('laporan.listTransaksi', [
            'transaksi' => Transaksi::all()
        ]);
    }
}
