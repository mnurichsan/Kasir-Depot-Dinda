@extends('layouts.dashboard')
@section('judul','Edit barang')
@section('content')
<div class="row">
              <div class="col">
                <div class="card">
                        <form method="POST" enctype="multipart/form-data" action="{{route('barang.update',$data->id)}}">
                        @csrf
                        @method('PUT')
                            <div class="card-header">
                            <h4>Edit Barang</h4>
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
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" name="namabarang" value="{{$data->namabarang}}">
                                </div>


                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="number" class="form-control" name="hargabarang" value="{{$data->hargabarang}}">
                                </div>


                                <div class="form-group">
                                    <label>Gambar</label><br>
                                    <img src="{{asset($data->gambar)}}" alt="" class="img-fluid" width="100px">
                                    <input type="file" class="form-control" name="gambar">
                                </div>
                                
                            <div class="card-footer text-right">
                            <a href="{{route('barang.index')}}" class="btn btn-warning">Back</a>
                            <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>



@endsection