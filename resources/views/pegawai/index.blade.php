@extends('layouts.dashboard')
@section('content')
@section('judul','Pegawai')

 <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                  <a href="{{route('pegawai.create')}}" class="btn btn-primary ml-2">Tambah Data</a>
                  </div>
                  <div class="card-body">
        
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr class="text-center">
                            <th>
                              #
                            </th>
                            <th>Nama Pegawai</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                             @foreach($data as $dat=>$dt)
                          <tr class="text-center">
                            <td >
                             {{$dat + 1}}
                            </td>
                            <td>{{$dt->nama}}</td>
                            <td>{{$dt->umur}}</td>
                            <td>{{$dt->jeniskelamin}}</td>
                            <td>{{$dt->alamat}}</td>
                            <td>{{$dt->nohp}}</td>
                            <td>@if($dt->status == "Aktif")  <span class="badge badge-success">{{$dt->status}}</span> @else <span class="badge badge-warning">{{$dt->status}}</span> @endif </td>
                            <td><img src="{{asset($dt->gambar)}}" alt="" class="img-fluid" width="100px"></td>
                            <td>
                            <!-- <a href="" class="btn btn-primary">Detail</a> -->
                            <a href="{{route('pegawai.edit',$dt->id)}}" class="btn btn-warning">Edit</a>
                            <a href="{{route('pegawai.destroy',$dt->id)}}" class="btn btn-danger btn-hapus">hapus</a>
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