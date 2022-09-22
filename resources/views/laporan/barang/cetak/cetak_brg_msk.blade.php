<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Barang Masuk</title>
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
                        Laporan Data Barang Masuk
                    </p>
                    <p align="center">
                        Periode Tanggal  {{ date('d F Y', strtotime ($tgl_mulai)) }} s/d {{ date('d F Y', strtotime ($tgl_selesai)) }}
                    </p>
                    </hr>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Barang Masuk</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Nama Barang</th>
                                        <th>Ukuran</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Stok</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                @if ($sum_total == 0)
                                    <tr>
                                        <td colspan="10"><center><b>Data Tidak ada Pada Periode Tgl {{ date('d F Y', strtotime($tgl_mulai)) }} s/d {{ date('d F Y', strtotime($tgl_selesai)) }}</b></center></td>
                                    </tr>
                                    @else
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($brg_msk as $row)
                                        
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->no_brg_msk }} </td>
                                            <td>{{ $row->nama_kategori }} </td>
                                            <td>{{ date('d F Y', strtotime($row->tgl_brg_msk))}}</td>
                                            <td>{{ $row->nama_barang }} </td>
                                            <td>{{ $row->ukuran }}</td>
                                            <td>Rp. {{ number_format ($row->harga) }}</td>
                                            <td>{{ $row->jml_brg_msk }} Unit</td>
                                            <td>{{ $row->stok }} Unit</td>
                                            <td>Rp. {{ number_format ($row->total) }}</td>
                                            
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="9">Total Harga</td>
                                            <td>Rp {{ number_format ($sum_total) }}</td>
                                        </tr>
                                    </tbody>
                                    @endif
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>