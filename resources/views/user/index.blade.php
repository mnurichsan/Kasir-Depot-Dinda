@extends('layouts.dashboard')
@section('content')
@section('judul','User')

 <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                  <a href="{{route('user.create')}}" class="btn btn-primary ml-2">Tambah Data</a>
                  </div>
                  <div class="card-body">
        
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach($data as $dat=>$dt)       
                          <tr>
                            <td class="text-center">
                             {{$dat + 1}}
                            </td>
                            <td>{{$dt->name}}</td>
                            <td>{{$dt->email}}</td>
                            <td>
                            <a href="{{route('user.edit',$dt->id)}}" class="btn btn-warning">Edit</a>
                            <a href="{{route('user.destroy',$dt->id)}}" class="btn btn-danger btn-hapus">hapus</a>
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