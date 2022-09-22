<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data transaksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body style="background-color:white;" onload="window.print()">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table style="width: 100%;">
                        <tr>
                            <td align="center">
                                <span style="line-height: 1.6; font-weight: bold;">
                                    SISTEM INFORMASI INVENTORY DAN CASHFLOW
                                    <br>
                                    ZACK JERSEY
                                    <br>
                                    Jl. A. DAMYATI RT. 007 RW. 006 KELURAHAN SUKARASA KECAMATAN TANGERANG KOTA TANGERANG
                                    <br>
                                    TANGERANG, 15118
                                </span>
                            </td>
                        </tr>
                    </table>
                    <hr class="line-title">
                    <p align="center">
                        Laporan Data Transaksi
                    </p>
                    <p align="center">
                    Periode Tanggal {{ date('d F Y', strtotime ($tgl_mulai)) }} s/d {{ date('d F Y', strtotime ($tgl_selesai)) }}
                    </p>
                    </hr>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Kode</td>
                                        <td>Tanggal</td>
                                        <td>Keterangan</td>
                                        <td>Masuk</td>
                                        <td>Keluar</td>
                                        <td>Jenis</td>
                                    </tr>
                                </thead>

                                @if ($sum_total == 0)
                                <tr>
                                    <td colspan="7">
                                    <center><b>Data Tidak ada Pada Periode Tgl {{ date('d F Y', strtotime($tgl_mulai)) }} s/d {{ date('d F Y', strtotime($tgl_selesai)) }}</b></center>
                                    </td>
                                </tr>
                                @else
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>