@extends('layouts.dashboard')
@section('content')
@section('judul','Transaksi')
 <div class="row">
                <div class="col-4">
                                <div class="card">
                                        
                                            <div class="card-header">
                                            <h4>Informasi Setoran</h4>
                                            </div>
                                            <div class="card-body">
                                        
                                                <div class="form-group">
                                                    <label>Kode Setoran : </label>
                                                    <h5>{{$data->kode_setoran}}</h5>
                                                </div>

                                                <div class="form-group">
                                                    <label>Tanggal Setoran</label>
                                                    <h5>{{date($data->tanggal_setoran->format("d-m-Y"))}}</h5>
                                                </div>

                                                <div class="form-group">
                                                    <label>Nama Pegawai</label>
                                                    <h5>{{$data->pegawai->nama}}</h5>
                                                </div>
                                                <div class="form-group">
                                                    <label>No HP</label>
                                                    <h5>{{$data->pegawai->nohp}}</h5>
                                                </div>
                                    </div>
                                </div>
                </div>
                <div class="col-8">
                    <div class="card">
                    <div class="card-header">
                    <a href="{{route('setoran.index')}}" class="btn btn-danger"><< Back</a>
                    <button class="btn btn-warning btn-refresh ml-2"><i class="fa fa-refresh"></i> Refresh</button>
                    <button class="btn btn-primary ml-2" data-toggle="modal" data-target="#transaksiModal">Tambah Data</button>
                    </div>
                    <div class="card-body">
            
                        <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>                                 
                            <tr>
                                <th class="text-center">
                                #
                                </th>
                                <th>Alamat</th>
                                <th>Nama barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php 
                                $totalBayar=0; 
                            @endphp
                            @foreach($transaksi as $tr=>$t)
                            <tr>
                                <td class="text-center">
                                {{$tr + 1}}
                                </td>
                                <td>{{$t->alamat}}</td>
                                <td>{{$t->barang->namabarang}}</td>
                                <td>{{$t->barang->hargabarang}}</td>
                                <td>{{number_format($t->jumlah_pembelian)}}</td>
                                <td>{{number_format($t->total_harga)}} </td>
                                <td>
                                <a href="javascript:void(0)" class="btn btn-sm btn-warning edit-btn" data-id="{{$t->id}}" data-alamat="{{$t->alamat}}" data-nama="{{$t->id_barang}}" data-jumlah="{{$t->jumlah_pembelian}}"><i class="fas fa-edit"></i></a>
                                <a href="{{route('transaksi.destroy',$t->id)}}" class="btn btn-sm btn-danger btn-hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @php
                             $totalBayar += $t->total_harga;
                            @endphp

                            @endforeach
                            </tbody>
                        </table>
                        <h4>Subtotal : {{number_format($totalBayar)}} </h4>
                        </div>
                    </div>
                    </div>
                     <div class="card">
                     <form method="POST" enctype="multipart/form-data" action="{{route('setoran.update',$data->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                    <label>Total Bayar</label>
                                    <input type="number" class="form-control" name="total_bayar"  value="{{$totalBayar}}" readonly>
                            </div>
                            <div class="form-group">
                                    <label>Jumlah Setoran</label>
                                    <input type="number" class="form-control" name="total_setoran" value="{{$data->total_setoran}}">
                            </div>
                              <div class="form-group">
                                    <label>Kembalian</label>
                                    <input type="number" class="form-control" name="kembalian" value="{{$data->kembalian}}" readonly>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Hitung</button>
                        </div>
                     </form>
                    </div>
                </div>

                
 </div>

@section('modal')

  <div class="modal fade" tabindex="-1" role="dialog" id="transaksiModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="formTransaksi">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                            <input type="hidden" class="form-control" name="id_setoran" value="{{$data->id}}" readonly>
                    </div>
                    <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{old('alamat')}}">
                    </div>
                     
                    <div class="form-group">
                            <label>Barang</label>   
                                <select class="form-control" name="id_barang">
                                    <option value="" holder>--Barang--</option>
                                    @foreach($barang as $b)
                                    <option value="{{$b->id}}">{{$b->namabarang}}</option>
                                    @endforeach
                                </select>
                    </div>

                    <div class="form-group">
                            <label>Jumlah beli</label>
                            <input type="number" class="form-control" name="jumlah_pembelian" value="{{old('jumlah_pembelian')}}">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="editTransaksiModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="editTransaksi">
                <div class="modal-body">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="form-group">
                            <input type="hidden" class="form-control" name="id_transaksi" id="id" readonly>
                    </div>
                    <div class="form-group">
                            <input type="hidden" class="form-control" name="id_setoran" value="{{$data->id}}" readonly>
                    </div>
                    <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" value="{{old('alamat')}}">
                    </div>
                     
                    <div class="form-group">
                            <label>Barang</label>   
                                <select class="form-control" name="id_barang" id="idbarang">
                                    <option value="" holder>--Barang--</option>
                                    @foreach($barang as $b)
                                    <option value="{{$b->id}}">{{$b->namabarang}}</option>
                                    @endforeach
                                </select>
                    </div>

                    <div class="form-group">
                            <label>Jumlah beli</label>
                            <input type="number" class="form-control" name="jumlah_pembelian" id="jumlah" value="{{old('jumlah_pembelian')}}">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
    </div>


@endsection


@endsection
