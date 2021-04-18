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
                <form class="col-md-12" action="{{ route('peramalan-po') }}" method="GET">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group label-floating @error('alpha')
                      has-error @enderror">
                          <label class="control-label">Variable Alpha (0 s/d 1) *</label>
                              <input type="number" step=".01" value="{{Request::get('alpha')}}" class="form-control @error('alpha') is-invalid @enderror" name="alpha" autocomplete="off" placeholder="example : 0,1" required/>
                              <span class="material-icons form-control-feedback">clear</span>
                              @error('alpha')
                                  <div class="invalid-feedback">
                                      <h6>{{$message}}</h6>
                                  </div>
                              @enderror
                      </div>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" title="Hitung Peramalan" data-toggle="tooltip" class="btn btn-success"><i class="fa fa-calculator"></i></button>
                    </div>
                  </div>
                </form>
                @if (Request::get('alpha'))
                  <div class="col-md-12">
                      @php
                          $smoothing1[0] = $purchaseOrder[0]['qty_po']; //smoothing pertama
                          $smoothing2[0] = $purchaseOrder[0]['qty_po']; //smoothing kedua
                          $smoothing3[0] = $purchaseOrder[0]['qty_po']; //smoothing ketiga
                          $at = array(); //parameter pemulusan trend linier (bt)
                          $bt = array(); //parameter pemulusan trend linier (bt)
                          $ct = array(); //parameter pemulusan trend parabaolik (ct)
                          $peramalan[0] = 0; //peramalan
                          $Xt_Ft[0] = 0;
                          $totalXt_Ft = 0;

                          $label = "";
                          $dataAktual = "";

                          $getMeanRendemen = \App\Models\HasilProduksi::select(\DB::raw('SUM(rendemen) / COUNT(rendemen) AS meanRendemen'))->get()[0]->meanRendemen;

                          $getMeanHargaLog = \App\Models\BahanBaku::select(\DB::raw('SUM(nominal_bahan_baku) / SUM(qty_bahan_baku) AS meanHargaLog'))->get()[0]->meanHargaLog;

                          $getTotalProduksi = \App\Models\HasilProduksi::select(\DB::raw('SUM(hasil_produksi.qty_hasil_produksi) AS ttlBjd'))->get()[0]->ttlBjd;

                          $getTotalPemakaianSp = \App\Models\PemakaianSparepart::select(\DB::raw('SUM(qty_pemakaian) AS ttlPemakaianSp, SUM(nominal_pemakaian) AS ttlNominalPemakaianSp'))->get()[0];

                          // mencari rata rata pemakaian sp untuk 1 m3 barang jadi
                          $meanQtySp = $getTotalPemakaianSp->ttlPemakaianSp / $getTotalProduksi;

                          // mencari rata2 harga sp untuk 1 pcs nya
                          $meanHargaSp = $getTotalPemakaianSp->ttlNominalPemakaianSp / $getTotalPemakaianSp->ttlPemakaianSp;

                          // echo "<pre style='color:white'>";
                          // print_r ($meanQtySp);
                          // echo "</pre>";
                          
                      @endphp
                      <div class="card">
                          <div class="card-header card-header-success">
                              <h4 class="card-title ">Peramalan</h4>
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-hover">
                                      <thead>
                                          <tr>
                                              {{-- <td>#</td> --}}
                                              <td>Bulan</td>
                                              <td>Tahun</td>
                                              <td>Data Aktual</td>
                                              <td>S'</td>
                                              <td>S''</td>
                                              <td>S'''</td>
                                              <td>Parameter Pemulusan (at)</td>
                                              <td>Parameter Pemulusan Trend Linier (bt)</td>
                                              <td>Parameter Pemulusan Trend Parabaolik (ct)</td>
                                              <td>Peramalan</td>
                                              {{-- <td>Xt-Ft/Xt</td> --}}
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @for ($indexPo = 0; $indexPo < count($purchaseOrder); $indexPo++)
                                            @php
                                              if ($indexPo >0) {
                                                // smoothing pertama
                                                $smoothing1[$indexPo] = round($alpha * $purchaseOrder[$indexPo]['qty_po'] + (1 - $alpha) * $smoothing1[$indexPo - 1], 2);
                                                // smoothing kedua
                                                $smoothing2[$indexPo] = round($alpha * $smoothing1[$indexPo] + (1 - $alpha) * $smoothing2[$indexPo - 1], 2);
                                                // smoothing ketiga
                                                $smoothing3[$indexPo] = round($alpha * $smoothing2[$indexPo] + (1 - $alpha) * $smoothing3[$indexPo - 1], 2);
                                              }
                                              // parameter pemulusan (at)
                                              $at[$indexPo] = round(3 * $smoothing1[$indexPo] - 3 * $smoothing2[$indexPo] + $smoothing3[$indexPo],2);
                                              //parameter pemulusan trend linier (bt)
                                              $bt[$indexPo] = round($alpha / (2*pow((1 - $alpha),2)) * ( ( ( 6 - ( 5 * $alpha) ) * $smoothing1[$indexPo] ) - ( ( 10 - (8 * $alpha) ) * $smoothing2[$indexPo] ) + ( (4 - ( 3 * $alpha ) ) * $smoothing3[$indexPo] ) ) , 2);
                                              //parameter pemulusan trend parabaolik (ct)
                                              $ct[$indexPo] = round((pow($alpha, 2) / pow( (1 - $alpha), 2)) * ($smoothing1[$indexPo] - (2 * $smoothing2[$indexPo]) + $smoothing3[$indexPo]), 2);

                                              // peramalan
                                              if ($indexPo > 0) {
                                                $peramalan[$indexPo] = round($at[$indexPo-1] + $bt[$indexPo-1] + 0.5 * $ct[$indexPo-1], 2);
                                                $Xt_Ft[$indexPo] = abs(($purchaseOrder[$indexPo]['qty_po'] - $peramalan[$indexPo] ) / $purchaseOrder[$indexPo]['qty_po']);

                                                $totalXt_Ft += $Xt_Ft[$indexPo];
                                              }
                                              
                                            //   label untuk chart
                                            $label .= $purchaseOrder[$indexPo]['tahun'].'-'.$purchaseOrder[$indexPo]['bulan'].',';
                                              // if ($indexPo <= count($purchaseOrder) + 1) {
                                              // }
                                              // else{
                                              //   if ($purchaseOrder[$indexPo]['bulan'] == 12) {
                                              //     $purchaseOrder[$indexPo]['tahun'] += 1;
                                              //     $purchaseOrder[$indexPo]['bulan'] = 1;
                                              //   }
                                              //   $label .= $purchaseOrder[$indexPo]['tahun'].'-'.$purchaseOrder[$indexPo]['bulan'];
                                              // }
                                              // $indexPo < count($purchaseOrder) -1 ? $label .= $purchaseOrder[$indexPo]['tahun'].'-'.$purchaseOrder[$indexPo]['bulan'].',' : $label .= $purchaseOrder[$indexPo]['tahun'].'-'.$purchaseOrder[$indexPo]['bulan'];
                                              
                                              // echo "<pre style='color:white'>";
                                              // print_r ($label);
                                              // echo "</pre>";
                                              
                                            //   data aktual untuk chart
                                              $indexPo < count($purchaseOrder) -1 ? $dataAktual .= $purchaseOrder[$indexPo]['qty_po'].',' : $dataAktual .= $purchaseOrder[$indexPo]['qty_po'];
                                            @endphp
                                            <tr>
                                              {{-- <td>{{$indexPo + 1}}</td> --}}
                                              <td>{{$purchaseOrder[$indexPo]['bulan']}} </td>
                                              <td>{{$purchaseOrder[$indexPo]['tahun']}}</td>
                                              <td>{{$purchaseOrder[$indexPo]['qty_po']}} M<sup>3</sup></td>
                                              <td>{{$smoothing1[$indexPo]}}</td>
                                              <td>{{$smoothing2[$indexPo]}}</td>
                                              <td>{{$smoothing3[$indexPo]}}</td>
                                              <td>{{$at[$indexPo]}}</td>
                                              <td>{{$bt[$indexPo]}}</td>
                                              <td>{{$ct[$indexPo]}}</td>
                                              <td>{{$peramalan[$indexPo]}} M<sup>3</sup></td>
                                              {{-- <td>{{number_format($Xt_Ft[$indexPo], 2, '.', ',')}}</td> --}}
                                            </tr>
                                        @endfor
                                        @php
                                            // peramalan periode selanjutnya
                                            $nextPeriode = round($at[max(array_keys($at))] + $bt[max(array_keys($bt))] + 0.5 * $ct[max(array_keys($ct))], 2);
                                            // label periode selanjutnya
                                            if ($purchaseOrder[max(array_keys($purchaseOrder))]['bulan'] == 12) {
                                              $nextMonth = 1;
                                              $nextYear = $purchaseOrder[max(array_keys($purchaseOrder))]['bulan'] +1;
                                            }
                                            else{
                                              $nextMonth = $purchaseOrder[max(array_keys($purchaseOrder))]['bulan'] + 1;
                                              $nextYear = $purchaseOrder[max(array_keys($purchaseOrder))]['tahun'];
                                            }
                                            $nextLabel = $nextYear . '-'.$nextMonth;
                                            $label .= $nextLabel;

                                            array_push($peramalan, $nextPeriode);


                                            $mape = $totalXt_Ft / (count($purchaseOrder)) * 100;
                                            $seriesPeramalan = implode(',', $peramalan);

                                            // kebutuhan bahan baku
                                            $kebutuhanBahanBaku = $nextPeriode / $getMeanRendemen * 100;

                                            // kebutuhan sp
                                            $kebutuhanSp = $nextPeriode * $meanQtySp;

                                            // biaya tenaga kerja
                                            $totalBiayaKaryawan = $biayaTenagaKerja->jumlah_karyawan * $biayaTenagaKerja->gaji_per_karyawan;
                                        @endphp
                                      </tbody>
                                  </table>
                                  <h4>Peramalan PO Periode Selanjutnya = {{$nextPeriode}} M<sup>3</sup></h4>
                                  <h4>Mape = {{round($mape, 3)}} %</h4>
                                  <h4>Kebutuhan Bahan Baku = {{number_format($kebutuhanBahanBaku, 2, ',', '.')}} M<sup>3</sup></h4>
                                  <h4>Kebutuhan Biaya Bahan Baku = Rp {{number_format($kebutuhanBahanBaku * $getMeanHargaLog, 2, ',', '.')}}</h4>
                                  <h4>Kebutuhan Bahan Penunjang = {{number_format($kebutuhanSp, 2, ',', '.')}} Pcs</h4>
                                  <h4>Kebutuhan Biaya Bahan Penunjang = Rp {{number_format($kebutuhanSp * $meanHargaSp, 2, ',', '.')}}</h4>
                                  <h4>Kebutuhan Biaya Tenaga Kerja = Rp {{number_format($totalBiayaKaryawan, 2, ',', '.')}}</h4>
                                </div>
                          </div>
                      </div>
                      <br>
                      <div class="col-xl-12 col-lg-12">
                        <div class="card card-chart">
                            <div class="card-header card-header-success">
                            <div class="ct-chart" id="peramalanChart" data-series1="{{$dataAktual}}" data-series2="{{$seriesPeramalan}}" data-label="{{$label}}" style="overflow: auto"></div>
                            </div>
                            <div class="card-body">
                            <h4 class="card-title">Grafik Peramalan</h4>
                            <table>
                                <tr>
                                    <td>
                                        <div id="aktual"></div>
                                    </td>
                                    <td>&nbsp;Data Aktual</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="peramalan"></div>
                                    </td>
                                    <td>&nbsp;Hasil Perhitungan Peramalan</td>
                                </tr>
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
