@extends('layout.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"> Laporan Transaksi</h4>
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
                        <a href="#">Laporan Data</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Transaksi</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                            <h4 class="card-title"><i class="fa fa-table"></i> Laporan Data Transaksi</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCetak3" href="/lap_transaksi/cetak_transaksi">
                                    <i class="fa fa-print"></i>
                                    Cetak
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Kode Transaksi</td>
                                        <td>Tanggal</td>
                                        <td>Keterangan</td>
                                        <td>Masuk</td>
                                        <td>Keluar</td>
                                        <td>Jenis</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($kas as $k)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{$k->kode}}</td>
                                        <td>{{ date('d F Y', strtotime($k->tanggal))}}</td>
                                        <td>{{$k->keterangan}}</td>
                                        <td>
                                            @php
                                            if ($k->type_kas == 'masuk') {
                                            echo "Rp. ".number_format ($k->jumlah);
                                            } else {
                                            echo 0;
                                            }
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                            if ($k->type_kas == 'keluar') {
                                            echo "Rp. ".number_format ($k->jumlah);
                                            } else {
                                            echo 0;
                                            }
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                            if ($k->type_kas == 'masuk') {
                                            echo "<button class='btn btn-success'>Masuk</button> ";
                                            } else {
                                            echo "<button class='btn btn-danger'>Keluar</button> ";
                                            }
                                            @endphp
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tr>
                                    
                                    <td colspan="4">Total Kas Masuk</td>
                                    <td colspan="3">Rp. {{number_format ($totalMasuk) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5">Total Kas Keluar</td>
                                    <td colspan="2">Rp. {{number_format ($totalKeluar)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Saldo</td>
                                    <td colspan="5">Rp. {{number_format ($saldo) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCetak3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cetak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="get" target="_blank" enctype="multipart/form-data" action="/lap_transaksi/cetak_transaksi">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tgl_mulai" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tgl_selesai" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection