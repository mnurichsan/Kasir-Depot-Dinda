@extends('layouts.dashboard')
@section('content')
@section('judul','Laporan Setoran')

 <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                  <a href="{{route('export.setoran')}}" class="btn btn-success ml-2">Export Excel</a>
                  </div>
                  <div class="card-body">
        
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Kode Setoran</th>
                            <th>Tanggal Setoran</th>
                            <th>Pegawai</th>
                            <th>Total Bayar</th>
                            <th>Total Setoran</th>
                            <th>Kembalian</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach($setoran as $dat=>$dt)       
                          <tr>
                            <td class="text-center">
                             {{$dat + 1}}
                            </td>
                            <td>{{$dt->kode_setoran}}</td>
                            <td>{{$dt->tanggal_setoran->format('d M Y')}}</td>
                            <td>{{$dt->pegawai->nama}}</td>
                            <td>{{$dt->total_bayar}}</td>
                            <td>{{$dt->total_setoran}}</td>
                            <td>{{$dt->kembalian}}</td>
                            <td><a href="{{route('transaksi.show',[$dt->kode_setoran,$dt->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Transaksi</a>
                                <a href="{{route('setoran.destroy',$dt->id)}}" class="btn btn-sm btn-danger btn-hapus"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>


@endsection