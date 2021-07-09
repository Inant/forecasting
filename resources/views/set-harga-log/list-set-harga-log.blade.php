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
                            <h4 class="card-title ">Harga Log Per M<sup>3</sup></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>Jumlah Tenaga Kerja</td>
                                            <td>Gaji Per Tenaga Kerja</td>
                                            <td>Opsi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$biayaTenagaKerja->jumlah_karyawan}}</td>
                                            <td>Rp{{number_format($biayaTenagaKerja->gaji_per_karyawan, 2, ',', '.')}}</td>
                                            <td>Rp{{number_format($biayaTenagaKerja->jumlah_karyawan * $biayaTenagaKerja->gaji_per_karyawan, 2, ',', '.')}}</td>
                                            <td>
                                                <a href="{{ route('biaya-tenaga-kerja.edit', $biayaTenagaKerja) }}" rel="tooltip" title="Edit" class="btn btn-white btn-link btn-sm"><i class="material-icons">edit</i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
