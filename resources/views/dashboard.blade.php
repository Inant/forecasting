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
                    <h4 class="card-title">{{number_format($bahanBaku->qty_bahan_baku, 2, '.', ',')}}
                        <small>M<sup>3</sup></small>
                    </h4>
                    </div>
                    <div class="card-footer">
                        <span style="color: #8b92a9">Periode : {{$bahanBaku->bulan . ' - ' . $bahanBaku->tahun}}</span>
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
                        <h4 class="card-title">{{number_format($sparepart->qty_pemakaian, 2, '.', ',')}}
                        </h4>
                    </div>
                    <div class="card-footer">
                        <span style="color: #8b92a9">Periode : {{$sparepart->bulan . ' - ' . $sparepart->tahun}}</span>
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
                        <h4 class="card-title">{{number_format($produksi->qty_hasil_produksi, 2, '.', ',')}}
                            <small>M<sup>3</sup></small>
                        </h4>
                    </div>
                    <div class="card-footer">
                        <span style="color: #8b92a9">Periode : {{$produksi->bulan . ' - ' . $produksi->tahun}}</span>
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
                        <h4 class="card-title">{{number_format($purchaseOrder->qty_po, 2, '.', ',')}}
                            <small>M<sup>3</sup></small>
                        </h4>
                    </div>
                    <div class="card-footer">
                        <span style="color: #8b92a9">Periode : {{$purchaseOrder->bulan . ' - ' . $purchaseOrder->tahun}}</span>
                        <div class="stats">
                            {{-- <i class="material-icons text-warning">warning</i> --}}
                            <a href="{{ url('purchase-order') }}" class="info-link"><b>Detail</b></a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-5 col-lg-12">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">
                        <div class="ct-chart" id="dailySalesChart"></div>
                        </div>
                        <div class="card-body">
                        <h4 class="card-title">Daily Sales</h4>
                        <p class="card-category">
                            <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-5 col-lg-12">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">
                            <div id="po_chart" style="height: 200px"></div>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div> --}}

                <div class="col-xl-4 col-lg-12">
                <div class="card card-chart">
                    <div class="card-header card-header-warning">
                    <div class="ct-chart" id="websiteViewsChart"></div>
                    </div>
                    <div class="card-body">
                    <h4 class="card-title">Email Subscriptions</h4>
                    <p class="card-category">Last Campaign Performance</p>
                    </div>
                    <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> campaign sent 2 days ago
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                <div class="card card-chart">
                    <div class="card-header card-header-danger">
                    <div class="ct-chart" id="completedTasksChart"></div>
                    </div>
                    <div class="card-body">
                    <h4 class="card-title">Completed Tasks</h4>
                    <p class="card-category">Last Campaign Performance</p>
                    </div>
                    <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> campaign sent 2 days ago
                    </div>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                    <h4 class="card-title">Employees Stats</h4>
                    <p class="card-category">New employees on 15th September, 2016</p>
                    </div>
                    <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead class="text-warning">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>Country</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dakota Rice</td>
                            <td>$36,738</td>
                            <td>Niger</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Minerva Hooper</td>
                            <td>$23,789</td>
                            <td>Curaçao</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Sage Rodriguez</td>
                            <td>$56,142</td>
                            <td>Netherlands</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Philip Chaney</td>
                            <td>$38,735</td>
                            <td>Korea, South</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
                <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-warning">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                        <span class="nav-tabs-title">Tasks:</span>
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                            <a class="nav-link active" href="#profile" data-toggle="tab">
                                <i class="material-icons">bug_report</i> Bugs
                                <div class="ripple-container"></div>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#messages" data-toggle="tab">
                                <i class="material-icons">code</i> Website
                                <div class="ripple-container"></div>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#settings" data-toggle="tab">
                                <i class="material-icons">cloud</i> Server
                                <div class="ripple-container"></div>
                            </a>
                            </li>
                        </ul>
                        </div>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                                </td>
                                <td>Sign contract for "What are conference organizers afraid of?"</td>
                                <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">close</i>
                                </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                                </td>
                                <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">close</i>
                                </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                                </td>
                                <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                </td>
                                <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">close</i>
                                </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                                </td>
                                <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">close</i>
                                </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="tab-pane" id="messages">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                                </td>
                                <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                </td>
                                <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">close</i>
                                </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                                </td>
                                <td>Sign contract for "What are conference organizers afraid of?"</td>
                                <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">close</i>
                                </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="tab-pane" id="settings">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                                </td>
                                <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">close</i>
                                </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                                </td>
                                <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                </td>
                                <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">close</i>
                                </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                                </td>
                                <td>Sign contract for "What are conference organizers afraid of?"</td>
                                <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                                    <i class="material-icons">close</i>
                                </button>
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
