@extends('layouts.dashboard')
@section('judul','Tambah barang')
@section('content')
<div class="row">
              <div class="col">
                <div class="card">
                        <form method="POST" enctype="multipart/form-data" action="{{route('barang.store')}}">
                        @csrf
                            <div class="card-header">
                            <h4>Tambah Barang</h4>
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
                                    <input type="text" class="form-control" name="namabarang" value="{{old('namabarang')}}">
                                </div>


                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="number" class="form-control" name="hargabarang" value="{{old('hargabarang')}}">
                                </div>


                                <div class="form-group">
                                    <label>Gambar</label>
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