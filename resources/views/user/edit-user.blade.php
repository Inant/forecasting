@extends('layouts.template')
@section('content')
    <div class="content">
        <div class="container-fluid">
            @if (session('status'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>
                                {{ session('status') }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>
                                {{ session('error') }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-2">
                    <a href="{{$btn['link']}}" class="btn btn-success"><i class="material-icons">arrow_back</i> {{$btn['text']}}</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-success">
                            <h4 class="card-title ">Tambah User</h4>
                            {{-- <p class="card-category">Semua User</p> --}}
                        </div>
                        <div class="card-body">
                                <form method="POST" action="{{ route('user.update', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group label-floating @error('nama')
                                            has-error @enderror">
                                                <label class="control-label">Nama *</label>
                                                <input type="text" value="{{old('nama', $user->nama)}}" class="form-control @error('nama') is-invalid @enderror" name="nama" autocomplete="off" />
                                                <span class="material-icons form-control-feedback">clear</span>
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        <h6>{{$message}}</h6>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group label-floating @error('email')
                                            has-error @enderror">
                                                <label class="control-label">Email *</label>
                                                <input type="email" value="{{old('email', $user->email)}}" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="off" />
                                                <span class="material-icons form-control-feedback">clear</span>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        <h6>{{$message}}</h6>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <div class="clearfix"></div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
