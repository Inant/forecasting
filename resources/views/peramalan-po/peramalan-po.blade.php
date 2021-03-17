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
                          // echo "<pre style='color:white'>";
                          // print_r ($purchaseOrder);
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
                                              <td>Xt-Ft/Xt</td>
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
                                                $peramalan[$indexPo] = round($at[$indexPo] + $bt[$indexPo] + 0.5 * $ct[$indexPo], 2);
                                                $Xt_Ft[$indexPo] = abs(($purchaseOrder[$indexPo]['qty_po'] - $peramalan[$indexPo] ) / $purchaseOrder[$indexPo]['qty_po']);

                                                $totalXt_Ft += $Xt_Ft[$indexPo];
                                              }
                                            @endphp
                                            <tr>
                                              {{-- <td>{{$indexPo + 1}}</td> --}}
                                              <td>{{$purchaseOrder[$indexPo]['bulan']}}</td>
                                              <td>{{$purchaseOrder[$indexPo]['tahun']}}</td>
                                              <td>{{$purchaseOrder[$indexPo]['qty_po']}}</td>
                                              <td>{{$smoothing1[$indexPo]}}</td>
                                              <td>{{$smoothing2[$indexPo]}}</td>
                                              <td>{{$smoothing3[$indexPo]}}</td>
                                              <td>{{$at[$indexPo]}}</td>
                                              <td>{{$bt[$indexPo]}}</td>
                                              <td>{{$ct[$indexPo]}}</td>
                                              <td>{{$peramalan[$indexPo]}}</td>
                                              <td>{{number_format($Xt_Ft[$indexPo], 2, '.', ',')}}</td>
                                            </tr>
                                        @endfor
                                        @php
                                            $mape = $totalXt_Ft / 26 * 100;
                                        @endphp
                                      </tbody>
                                  </table>
                                  <h4>Mape = {{round($mape, 3)}} %</h4>
                              </div>
                          </div>
                      </div>
                  </div>
                @endif
            </div>
        </div>
    </div>
@endsection