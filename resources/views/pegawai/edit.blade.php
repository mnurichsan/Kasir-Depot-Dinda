@extends('layouts.dashboard')
@section('judul','Edit Pegawai')
@section('content')
<div class="row">
              <div class="col">
                <div class="card">
                        <form method="POST" enctype="multipart/form-data" action="{{route('pegawai.update',$data->id)}}">
                        @csrf
                        @method('PUT')
                            <div class="card-header">
                            <h4>Edit Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <p>  
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </p>
                                <div class="form-group">
                                    <label>Nama </label>
                                    <input type="text" class="form-control" name="nama" value="{{$data->nama}}">
                                </div>


                                <div class="form-group">
                                    <label>Umur</label>
                                    <input type="number" class="form-control" name="umur" value="{{$data->umur}}" >
                                </div>

                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                      <select class="form-control select2" name="jeniskelamin">
                                      <option value="" holder>-Jenis Kelamin-</option>
                                            <option value="Pria" @if($data->jeniskelamin == "Pria") selected @endif</option>Pria</option>
                                            <option value="Wanita" @if($data->jeniskelamin == "Wanita") selected @endif>Wanita</option>
                                     </select>
                                 </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" >{{$data->alamat}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>No.hp</label>
                                    <input type="text" class="form-control" name="nohp" value="{{$data->nohp}}">
                                </div>

                                 <div class="form-group">
                                    <label>Status</label>
                                      <select class="form-control select2" name="status">
                                      <option value="" holder>-Status-</option>
                                            <option value="Aktif" @if($data->status == "Aktif") selected @endif>Aktif</option>
                                            <option value="Tidak Aktif"  @if($data->status != "Aktif") selected @endif>Tidak Aktif</option>
                                     </select>
                                 </div>

                                <div class="form-group">
                                    <label>Foto</label><br>
                                    <img src="{{asset($data->gambar)}}" alt="" class="img-fluid" width="100px">
                                    <input type="file" class="form-control" name="gambar">
                                </div>
                                
                            <div class="card-footer text-right">
                            <a href="{{route('pegawai.index')}}" class="btn btn-warning">Back</a>
                            <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>



@endsection