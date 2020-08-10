@extends('layouts.dashboard')
@section('content')
@section('judul','Barang')

 <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                  <a href="{{route('barang.create')}}" class="btn btn-primary ml-2">Tambah Data</a>
                  </div>
                  <div class="card-body">
        
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nama barang</th>
                            <th>Harga barang</th>
                            <th>Gambar</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach($data as $dat=>$dt)       
                          <tr>
                            <td class="text-center">
                             {{$dat + 1}}
                            </td>
                            <td>{{$dt->namabarang}}</td>
                            <td>{{$dt->hargabarang}}</td>
                            <td><img src="{{asset($dt->gambar)}}" alt="" class="img-fluid" width="100px"></td>
                            <td>
                            <a href="{{route('barang.edit',$dt->id)}}" class="btn btn-warning">Edit</a>
                            <a href="{{route('barang.destroy',$dt->id)}}" class="btn btn-danger btn-hapus">hapus</a>
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