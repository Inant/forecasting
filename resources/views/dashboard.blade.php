@extends('layouts.template')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="fas fa-tree"></i>
                    </div>
                    <p class="card-category">Pemakaian Bahan Baku</p>
                    <h4 class="card-title">{{number_format($bahanBaku->qty_bahan_baku, 2, ',', '.')}}
                        <small>M<sup>3</sup></small>
                    </h4>
                    </div>
                    <div class="card-footer">
                        <span style="color: #8b92a9">Periode : {{getNamaBulan($bahanBaku->bulan) . ' - ' . $bahanBaku->tahun}}</span>
                        <div class="stats">
                            {{-- <i class="material-icons text-warning">warning</i> --}}
                            <a href="{{ url('bahan-baku') }}" class="warning-link"><b>Detail</b></a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-fw fa-tools"></i>
                        </div>
                        <p class="card-category">Pemakaian Bahan Penunjang</p>
                        <h4 class="card-title">{{number_format($sparepart->qty_pemakaian, 2, ',', '.')}}
                        </h4>
                    </div>
                    <div class="card-footer">
                        <span style="color: #8b92a9">Periode : {{getNamaBulan($sparepart->bulan) . ' - ' . $sparepart->tahun}}</span>
                        <div class="stats">
                            {{-- <i class="material-icons text-warning">warning</i> --}}
                            <a href="{{ url('pemakaian-sparepart') }}" class="success-link"><b>Detail</b></a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-fw fa-box"></i>
                        </div>
                        <p class="card-category">Produksi Barang Jadi</p>
                        <h4 class="card-title">{{number_format($produksi->qty_hasil_produksi, 2, ',', '.')}}
                            <small>M<sup>3</sup></small>
                        </h4>
                    </div>
                    <div class="card-footer">
                        <span style="color: #8b92a9">Periode : {{getNamaBulan($produksi->bulan) . ' - ' . $produksi->tahun}}</span>
                        <div class="stats">
                            {{-- <i class="material-icons text-warning">warning</i> --}}
                            <a href="{{ url('hasil-produksi') }}" class="primary-link"><b>Detail</b></a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-fw fa-cash-register"></i>
                        </div>
                        <p class="card-category">Permintaan Purchase Order</p>
                        <h4 class="card-title">{{number_format($purchaseOrder->qty_po, 2, ',', '.')}}
                            <small>M<sup>3</sup></small>
                        </h4>
                    </div>
                    <div class="card-footer">
                        <span style="color: #8b92a9">Periode : {{getNamaBulan($purchaseOrder->bulan) . ' - ' . $purchaseOrder->tahun}}</span>
                        <div class="stats">
                            {{-- <i class="material-icons text-warning">warning</i> --}}
                            <a href="{{ url('purchase-order') }}" class="info-link"><b>Detail</b></a>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card card-chart">
                        <div class="card-header card-header-info">
                        <div class="ct-chart" id="dashboardChart" data-series1="{{$qty}}" data-label="{{$label}}" style="overflow: auto;"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Grafik Purchase Order</h4>
                            <table>
                                <tr>
                                    <td>
                                        <div id="aktual"></div>
                                    </td>
                                    <td>&nbsp;Quantity Purchase Order</td>
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
        </div>
    </div>
    <!-- Charting library -->
    {{-- <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <script>
        const chart = new Chartisan({
          el: '#po_chart',
          url: "@chart('po_chart')",
          hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
            // .legend({position:'bottom', color:'white'})
            .legend({ position: 'bottom' })
            // .title('This is a sample chart using chartisan!')
            .datasets([{ type: 'line', fill: false }, 'line'])
            .tooltip(),
            });
      </script> --}}
@endsection
