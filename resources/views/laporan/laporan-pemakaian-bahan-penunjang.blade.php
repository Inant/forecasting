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
                <form class="col-md-12" action="" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group label-floating @error('tahun') has-error @enderror">
                                <label class="control-label">Tahun</label>
                                <select name="tahun" class="form-control" required>
                                    <option value="" style="color: black">-- Pilih Tahun --</option>
                                    @foreach ($year as $item)
                                        <option value="{{$item->tahun}}" style="color: black" {{Request::get('tahun') == $item->tahun ? 'selected' : '' }}>{{$item->tahun}}</option>
                                    @endforeach
                                </select>
                                @error('tahun')
                                    <div class="invalid-feedback">
                                        <h6>{{$message}}</h6>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" title="Filter Laporan" data-toggle="tooltip" class="btn btn-success"><i class="fas fa-filter"></i></button>
                        </div>
                    </div>
                </form>
                @if (Request::get('tahun'))
                    <div class="col-md-12">
                        
                        <div class="card">
                            <div class="card-header card-header-success">
                                <h4 class="card-title ">Laporan Pemakaian Bahan Penunjang Tahun {{Request::get('tahun')}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th>Quantity</th>
                                                <th>Nominal Pemakaian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalQty = 0;
                                                $totalNominal = 0;
                                                $qty = "";
                                                // $nominal = "";
                                                $label = "";
                                            @endphp
                                            @foreach ($laporan as $value)
                                                @php
                                                    $totalQty += $value->qty_pemakaian;
                                                    $totalNominal += $value->nominal_pemakaian;

                                                    $loop->iteration < count($laporan) ? $qty .= $value->qty_pemakaian.',' : $qty .= $value->qty_pemakaian;
                                                    
                                                    // $loop->iteration < count($laporan) ? $nominal .= $value->nominal_pemakaian.',' : $nominal .= $value->nominal_pemakaian;

                                                    $loop->iteration < count($laporan) ? $label .= $value->bulan.',' : $label .= $value->bulan;
                                                @endphp
                                                <tr>
                                                    <td>{{$value->bulan}}</td>
                                                    <td>{{$value->tahun}}</td>
                                                    <td>{{number_format($value->qty_pemakaian, 2, ',', '.')}} M<sup>3</sup></td>
                                                    <td>Rp{{number_format($value->nominal_pemakaian, 2, ',', '.')}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" style="text-align: center">Total</th>
                                                <th>{{number_format($totalQty, 2, ',', '.')}} M<sup>3</sup></th>
                                                <th>Rp{{number_format($totalNominal, 2, ',', '.')}}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card card-chart">
                                <div class="card-header card-header-success">
                                <div class="ct-chart" id="laporanPemakaianSpChart" data-series1="{{$qty}}" data-label="{{$label}}" style="overflow: auto;"></div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Grafik Pemakaian Bahan Penunjang Tahun {{Request::get('tahun')}}</h4>
                                    <table>
                                        <tr>
                                            <td>
                                                <div id="aktual"></div>
                                            </td>
                                            <td>&nbsp;Quantity Pemakaian Bahan Penunjang</td>
                                        </tr>
                                        {{-- <tr>
                                            <td>
                                                <div id="peramalan"></div>
                                            </td>
                                            <td>&nbsp;Hasil Perhitungan Peramalan</td>
                                        </tr> --}}
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        {{-- <i class="material-icons">access_time</i> updated 4 minutes ago --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
