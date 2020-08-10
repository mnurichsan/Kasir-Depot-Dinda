@extends('layouts.dashboard')
@section('judul','Edit user')
@section('content')
<div class="row">
              <div class="col">
                <div class="card">
                        <form method="POST" enctype="multipart/form-data" action="{{route('user.update',$data->id)}}">
                        @csrf
                        @method('PUT')
                            <div class="card-header">
                            <h4>Edit User</h4>
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
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" value="{{$data->name}}">
                                </div>


                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$data->email}}">
                                </div>
                                
                            <div class="card-footer text-right">
                            <a href="{{route('user.index')}}" class="btn btn-warning">Back</a>
                            <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>



@endsection