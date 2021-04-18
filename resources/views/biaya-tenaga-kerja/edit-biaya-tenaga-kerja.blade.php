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
                            <h4 class="card-title ">Edit Biaya Tenaga Kerja</h4>
                            {{-- <p class="card-category">Semua User</p> --}}
                        </div>
                        <div class="card-body">
                                <form method="POST" action="{{ route('biaya-tenaga-kerja.update', $biayaTenagaKerja->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group label-floating @error('jumlah_karyawan')
                                            has-error @enderror">
                                                <label class="control-label">Jumlah Tenaga Kerja *</label>
                                                <div class="input-group">
                                                    <input type="number" step=".01" value="{{old('jumlah_karyawan', $biayaTenagaKerja->jumlah_karyawan)}}" class="form-control @error('jumlah_karyawan') is-invalid @enderror" name="jumlah_karyawan" autocomplete="off" />
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            M<sup>3</sup>
                                                        </span>
                                                    </div>
                                                    <span class="material-icons form-control-feedback">clear</span>
                                                    @error('jumlah_karyawan')
                                                        <div class="invalid-feedback">
                                                            <h6>{{$message}}</h6>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group label-floating @error('gaji_per_karyawan')
                                            has-error @enderror">
                                                <label class="control-label">Gaji Per Tenaga Kerja *</label>
                                                <input type="number" step=".01" value="{{old('gaji_per_karyawan', $biayaTenagaKerja->gaji_per_karyawan)}}" class="form-control @error('gaji_per_karyawan') is-invalid @enderror" name="gaji_per_karyawan" autocomplete="off" />
                                                <span class="material-icons form-control-feedback">clear</span>
                                                @error('gaji_per_karyawan')
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
