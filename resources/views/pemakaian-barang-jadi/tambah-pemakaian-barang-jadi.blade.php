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
                            <h4 class="card-title ">Tambah Data Pemakaian Barang Jadi</h4>
                            {{-- <p class="card-category">Semua User</p> --}}
                        </div>
                        <div class="card-body">
                                <form method="POST" action="{{ route('pemakaian-barang-jadi.store') }}">
                                    @csrf
                                    <div class="row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group label-floating @error('bulan')
                                            has-error @enderror">
                                                <label class="control-label">Bulan *</label>
                                                <select name="bulan" id="bulan" class="form-control" required>
                                                    <option value="" style="color: black">--Bulan--</option>
                                                    @foreach ($bulan as $item)
                                                        <option value="{{$item['bulan']}}" style="color: black" {{old('bulan') == $item['bulan'] ? 'selected' : '' }}>{{$item['nama']}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="material-icons form-control-feedback">clear</span>
                                                @error('bulan')
                                                    <div class="invalid-feedback">
                                                        <h6>{{$message}}</h6>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group label-floating @error('tahun')
                                            has-error @enderror">
                                                <label class="control-label">Tahun *</label>
                                                <select name="tahun" id="tahun" class="form-control" required>
                                                    <option value="" style="color: black">--Tahun--</option>
                                                    @for ($y = 2018; $y <= date('Y'); $y++)
                                                        <option value="{{$y}}" style="color: black" {{old('tahun', date('Y')) == $y ? 'selected' : '' }}>{{$y}}</option>
                                                    @endfor
                                                </select>
                                                <span class="material-icons form-control-feedback">clear</span>
                                                @error('tahun')
                                                    <div class="invalid-feedback">
                                                        <h6>{{$message}}</h6>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group label-floating @error('qty_pemakaian')
                                            has-error @enderror">
                                                <label class="control-label">Quantity Pemakaian Barang Jadi *</label>
                                                <div class="input-group">
                                                    <input type="number" step=".01" value="{{old('qty_pemakaian')}}" class="form-control @error('qty_pemakaian') is-invalid @enderror" name="qty_pemakaian" autocomplete="off" />
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            M<sup>3</sup>
                                                        </span>
                                                    </div>
                                                    <span class="material-icons form-control-feedback">clear</span>
                                                    @error('qty_pemakaian')
                                                        <div class="invalid-feedback">
                                                            <h6>{{$message}}</h6>
                                                        </div>
                                                    @enderror
                                                </div>
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
