@extends('layout.master')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Barang Keluar</h4>
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
                        <a href="#">Data</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Barang Keluar</a>
                    </li>
                </ul>
            </div>
            <div class="row">


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"><i class="fa fa-table"></i> Data Barang Keluar</h4>
                                <a class="btn btn-primary btn-round ml-auto" href="/brg_klr/create">
                                    <i class="fa fa-plus"></i>
                                    Tambah Barang Keluar
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang Keluar</th>
                                            <th>Kategori</th>
                                            <th>Tanggal Barang Keluar</th>
                                            <th>Nama Barang</th>
                                            <th>Ukuran</th>
                                            <th>Harga Jual</th>
                                            <th>Jumlah</th>
                                            <th>Stok</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($brg_klr as $row)

                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->no_brg_klr }} </td>
                                            <td>{{ $row->nama_kategori }} </td>
                                            <td>{{ date('d F Y', strtotime($row->tgl_brg_klr))}}</td>
                                            <td>{{ $row->nama_barang }} </td>
                                            <td>{{ $row->ukuran }}</td>
                                            <td>Rp. {{ number_format ($row->harga_jual) }}</td>
                                            <td>{{ $row->jml_brg_klr }} Unit</td>
                                            <td>{{ $row->stok }} Unit</td>
                                            <td>Rp. {{ number_format ($row->total) }}</td>
                                            
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