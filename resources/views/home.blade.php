@extends('layouts.dashboard')
@section('content')
@section('judul','dashboard')
   <div class="row">
            <div class="col-lg-4 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                  <i class="fas fa-boxes"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Barang</h4>
                  </div>
                  <div class="card-body">
                    {{$barang}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pemasukan</h4>
                  </div>
                  <div class="card-body">
                    @php $totalBayar = 0; @endphp
                    @foreach($setoran as $dt)
                    @php $totalBayar += $dt->total_bayar; @endphp
                    @endforeach
                   {{'Rp.'.number_format($totalBayar)}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-handshake"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jumlah Transaksi</h4>
                  </div>
                  <div class="card-body">
                    {{$transaksi}}
                  </div>
                </div>
              </div>
            </div>
   </div>

    <div class="row">
            <div class="col-md-7">
              <div class="card">
                <div class="card-header">
                  <h4>5 Setoran Terbaru</h4>
                  <div class="card-header-action">
                    <a href="{{route('setoran.laporan')}}" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>#</th>
                        <th>Kode Setoran</th>
                        <th>Pegawai</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                      </tr>
                      @foreach($setoran as $set=>$s)
                      <tr>
                        <td>{{$set + 1}}</td>
                        <td><a href="{{route('transaksi.show',[$s->kode_setoran,$s->id])}}">{{$s->kode_setoran}}</a></td>
                        <td class="font-weight-600">{{$s->pegawai->nama}}</td>
                        <td>{{$s->tanggal_setoran->format("d-m-Y")}}</td>
                        <td>
                          <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-show" data-setoran="{{$s->kode_setoran}}" data-tanggal="{{$s->tanggal_setoran->format('d-m-Y')}}" data-id="{{$s->id}}"><i class="fas fa-eye"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                  <h4 class="d-inline">Status Pegawai</h4>
                </div>
                <div class="card-body">             
                  <ul class="list-unstyled list-unstyled-border">
                  @foreach($pegawai as $p)
                    <li class="media">
                      <img src="{{asset($p->gambar)}}" alt="" class="img-fluid mr-2" width="50px">
                      <div class="media-body">
                       @if($p->status == "Aktif")<div class="badge badge-pill badge-success mb-1 float-right">{{$p->status}}</div> 
                       @else<div class="badge badge-pill badge-warning mb-1 float-right">{{$p->status}}</div>@endif 
                        <h6 class="media-title">{{$p->nama}}</h6>
                        <div class="text-small text-muted">No.hp : {{$p->nohp}}</div>
                      </div>
                    </li>
                  @endforeach
                  </ul>
                </div>
            </div>
          </div>
          
          </div>
  <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Grafik Pemasukan</h4>
                  </div>
                  <div class="card-body">
                     {!! $chart->container() !!}
                  </div>
                </div>
              </div>
    </div>
  
                    {!! $chart->script() !!}
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

    <!-- Invoice items table -->

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
        <!-- <tr>
            <td>
            </td>
            <td></td>
            <td class="font-weight-bold align-middle text-right text-nowrap"></td>
        </tr> -->
            </table>

            <!-- Thank you note -->

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
