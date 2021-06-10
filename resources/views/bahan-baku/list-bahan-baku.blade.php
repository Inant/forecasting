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
                    <a href="{{$btn['link']}}" class="btn btn-success"><i class="material-icons">add</i> {{$btn['text']}}</a>
                </div>
                <div class="col-auto ml-auto">
                    <form class="navbar-form" action="{{ route('bahan-baku.index') }}" method="GET">
                        <div class="input-group no-border">
                            <select name="month" class="form-control" style="background:transparent;color:white" id="bulan">
                                <option value="" style="color: black">--Bulan--</option>
                                @foreach ($bulan as $item)
                                    <option value="{{$item['bulan']}}" style="color: black" {{Request::get('month') == $item['bulan'] ? 'selected' : '' }} >{{$item['nama']}}</option>
                                @endforeach
                            </select>
                            <select name="year" class="form-control" style="background:transparent;color:white" id="year">
                                <option value="" style="color: black">--Tahun--</option>
                                @foreach ($year as $item)
                                    <option value="{{$item->tahun}}" style="color: black" {{Request::get('year') == $item->tahun ? 'selected' : '' }}>{{$item->tahun}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-success btn-sm btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-success">
                            <h4 class="card-title ">List Pemakaian Bahan Baku</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Bulan</td>
                                            <td>Tahun</td>
                                            <td>Quantity</td>
                                            <td>Nominal Pemakaian Bahan Baku</td>
                                            <td>Opsi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $page = Request::get('page');
                                            $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
                                        @endphp
                                        @foreach ($bahanBaku as $value)
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$value->bulan}}</td>
                                                <td>{{$value->tahun}}</td>
                                                <td>{{number_format($value->qty_bahan_baku,2, ',','.')}} M<sup>3</sup></td>
                                                <td>Rp{{number_format($value->nominal_bahan_baku, 2, ',', '.')}}</td>
                                                <td>
                                                    <form action="{{ route('bahan-baku.destroy', $value) }}" method="post">
                                                        <a href="{{ route('bahan-baku.edit', $value) }}" rel="tooltip" title="Edit" class="btn btn-white btn-link btn-sm"><i class="material-icons">edit</i></a>
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" rel="tooltip" title="Hapus" class="btn btn-white btn-link btn-sm" onclick="confirm('{{ __("Apakah anda yakin ingin menghapus?") }}') ? this.parentElement.submit() : ''">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </form>  
                                                </td>
                                            </tr>
                                            @php
                                                $no++
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$bahanBaku->appends(Request::all())->links('vendor.pagination.custom')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
