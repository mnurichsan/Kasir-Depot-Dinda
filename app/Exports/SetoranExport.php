<?php

namespace App\Exports;

use App\Setoran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SetoranExport implements FromView
{
    
     public function view(): View
    {
        return view('laporan.listSetoran', [
            'setoran' => Setoran::all()
        ]);
    }
}
