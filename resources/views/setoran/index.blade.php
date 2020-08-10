@extends('layouts.dashboard')
@section('content')
@section('judul','Setoran')

<div class="row">
  <div class="col-lg-6 col-md-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-primary">
        <i class="fas fa-donate"></i>
      </div>
      <div class="card-wrap text-center">
        <div class="card-header">
          <h4>Total Setoran hari ini</h4>
        </div>
        <div class="card-body">
          {{count($data)}}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-success">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <div class="card-wrap text-center">
        <div class="card-header">
          <h4>Total Pemasukan hari ini</h4>
        </div>
        <div class="card-body">
          @php $totalBayar = 0; @endphp
          @foreach($data as $dt)
          @php $totalBayar += $dt->total_bayar; @endphp
          @endforeach
          {{'Rp.'.number_format($totalBayar)}}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card">
      <form method="POST" enctype="multipart/form-data" action="{{route('setoran.store')}}">
        @csrf
        <div class="card-header">
          <h4>Tambah Setoran</h4>
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
          <?php
          date_default_timezone_set('Asia/Jakarta');
          $nomor = date("dmYhis");
          ?>
          <div class="form-group">
            <label>Kode Setoran</label>
            <input type="text" class="form-control" name="kode_setoran" value="INV-{{$nomor}} " readonly>
          </div>

          <div class="form-group">
            <label>Tanggal Setoran</label>
            <input type="date" class="form-control" name="tanggal_setoran">
          </div>

          <div class="form-group">
            <label>Pegawai</label>
            <select class="form-control select2" name="pegawai">
              <option value="" holder>--Pegawai--</option>
              @foreach($pegawai as $p)
              <option value="{{$p->id}}">{{$p->nama}}</option>
              @endforeach
            </select>
          </div>

          <div class="card-footer text-right">
            <button class="btn btn-primary">Submit</button>
          </div>
      </form>
    </div>
  </div>
</div>
<div class="col-lg-8 col-md-6 col-12">
  <div class="card">
    <div class="card-header">
      <h4>Setoran hari ini {{date("d-m-Y")}}</h4>
      <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-striped" id="table-1">
          <thead>
            <tr class="text-center">
              <th>
                #
              </th>
              <th>Kode Setoran</th>
              <th>Tanggal</th>
              <th>Pegawai</th>
              <th>Total</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            @foreach($data as $dat=>$dt)
            <tr class="text-center">
              <td>
                {{$dat + 1}}
              </td>
              <td>{{$dt->kode_setoran}}</td>
              <td>{{$dt->tanggal_setoran->format("d-m-Y")}}</td>
              <td>{{$dt->pegawai->nama}}</td>
              <td>{{$dt->total_bayar}}</td>
              <td>
                <div>
                  <a href="{{route('transaksi.show',[$dt->kode_setoran,$dt->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Transaksi</a>
                  <a href="javascript:void(0)" class="btn btn-success btn-sm btn-show" data-setoran="{{$dt->kode_setoran}}" data-tanggal="{{$dt->tanggal_setoran->format('d-m-Y') }}" data-id="{{$dt->id}}"><i class="fas fa-eye"></i></a>
                  <a href="{{route('setoran.destroy',$dt->id)}}" class="btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i></a>
                </div>
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
</div>

@section('modal')

<div class="modal fade" tabindex="-1" role="dialog" id="showSetoraninvModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Show Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td class="border-0">
                <div class="row">
                  <div class="col-md text-center text-md-left mb-md-0">
                    <h4 class="mb-0">Depot Dinda</h4>
                    Taman Sudiang Indah Blok L7/32<br>
                    082187389101<br><br>
                    <p>Kode Setoran : </p>
                    <h5 id="kode"></h5>
                  </div>
                  <div class="col text-center text-md-right">

                    <!-- Dont' display Bill To on mobile -->
                    <span class="d-none d-md-block">
                      <h5 class="mb-0 mt-3" id="tanggal"></h5>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>


        <table class="table">
          <thead>
            <tr>
              <th>Alamat</th>
              <th>barang</th>
              <th>Jumlah</th>
              <th class="text-right">Harga</th>
            </tr>
          </thead>
          <tbody id="records_table">
            </tr>
        </table>

        <h5>
          Subtotal :
          <p id="subtotal" class="float-right"></p>
        </h5>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>

    </div>
  </div>
</div>
@endsection


@endsection