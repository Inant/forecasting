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
                    {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route('user.index') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari Data..." aria-label="Search" name="keyword" aria-describedby="basic-addon2" value="{{Request::get('keyword')}}">
                            <div class="input-group-append">
                            <button class="btn btn-success btn-sm" type="submit">
                                <i class="material-icons">search</i>
                            </button>
                            </div>
                        </div>
                    </form> --}}
                    <form class="navbar-form" action="{{ route('user.index') }}" method="GET">
                        <div class="input-group no-border">
                          <input type="text" value="{{Request::get('keyword')}}" class="form-control form-control-success" placeholder="Search..." name="keyword">
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
                            <h4 class="card-title ">List User</h4>
                            {{-- <p class="card-category">Semua User</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Nama</td>
                                            <td>Email</td>
                                            <td>Opsi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $page = Request::get('page');
                                            $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
                                        @endphp
                                        @foreach ($user as $value)
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$value->nama}}</td>
                                                <td>{{$value->email}}</td>
                                                <td>
                                                    <form action="{{ route('user.destroy', $value) }}" method="post">
                                                        <a href="{{ route('user.edit', $value) }}" rel="tooltip" title="Edit" class="btn btn-white btn-link btn-sm"><i class="material-icons">edit</i></a>
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
                                {{$user->appends(Request::all())->links('vendor.pagination.custom')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
