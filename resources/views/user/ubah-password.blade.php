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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-success">
                            <h4 class="card-title ">Ubah Password</h4>
                            {{-- <p class="card-category">Semua User</p> --}}
                        </div>
                        <div class="card-body">
                                <form method="POST" action="{{ url('user/save-password', auth()->user()->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group label-floating @error('old_password')
                                            has-error @enderror">
                                                <label class="control-label">Password Lama *</label>
                                                <input type="password" value="" class="form-control @error('old_password') is-invalid @enderror" name="old_password" autocomplete="off" />
                                                <span class="material-icons form-control-feedback">clear</span>
                                                @error('old_password')
                                                    <div class="invalid-feedback">
                                                        <h6>{{$message}}</h6>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group label-floating @error('new_password')
                                            has-error @enderror">
                                                <label class="control-label">Password Baru *</label>
                                                <input type="password" value="{{old('new_password')}}" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="off" />
                                                <span class="material-icons form-control-feedback">clear</span>
                                                @error('new_password')
                                                    <div class="invalid-feedback">
                                                        <h6>{{$message}}</h6>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                          <div class="form-group label-floating @error('confirm_password')
                                          has-error @enderror">
                                              <label class="control-label">Konfirmasi Password Baru *</label>
                                              <input type="password" value="{{old('confirm_password')}}" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" autocomplete="off" />
                                              <span class="material-icons form-control-feedback">clear</span>
                                              @error('confirm_password')
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
