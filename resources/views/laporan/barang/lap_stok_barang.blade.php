@extends('layout.master')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Laporan Stok Barang</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Laporan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Stok Barang</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"><i class="fa fa-table"></i> Laporan Stok Barang</h4>
                                <a class="btn btn-primary btn-round ml-auto" href="lap_stok_barang/cetak_stok_barang" target="_blank">
                                    <i class="fa fa-print"></i>
                                    Cetak
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Kategori</th>
                                            <th>Nama Barang</th>
                                            <th>Ukuran</th>
                                            <th>Stok</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($stok_barang as $row)

                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->kode_stok_barang }} </td>
                                            <td>{{ $row->nama_kategori }} </td>
                                            <td>{{ $row->nama_barang }} </td>
                                            <td>{{ $row->ukuran }}</td>
                                            <td>{{ $row->stok }} Unit</td>
                                            <td>Rp. {{ number_format ($row->harga) }}</td>
                                            <td>Rp. {{ number_format ($row->harga_jual) }}</td>
                                        </tr>
                                        @endforeach
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


@endsection