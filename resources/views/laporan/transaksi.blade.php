@extends('layouts.dashboard')
@section('content')
@section('judul','Laporan Transaksi')

 <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                  <a href="{{route('export.transaksi')}}" class="btn btn-success ml-2">Export Excel</a>
                  </div>
                  <div class="card-body">
        
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Tanggal Transaksi</th>
                            <th>alamat</th>
                            <th>Nama barang</th>
                            <th>Harga Barang</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach($transaksi as $dat=>$dt)       
                          <tr>
                            <td class="text-center">
                             {{$dat + 1}}
                            </td>
                            <td>{{$dt->created_at->format('d M Y')}}</td>
                            <td>{{$dt->alamat}}</td>
                            <td>{{$dt->barang->namabarang}}</td>
                            <td>{{$dt->barang->hargabarang}}</td>
                            <td>{{$dt->total_harga}}</td>
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