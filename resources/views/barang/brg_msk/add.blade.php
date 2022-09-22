@extends('layout.master')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Tambah Barang Masuk</h4>
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
                        <a href="#">Tambah</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Barang Masuk</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah Barang Masuk</div>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="/brg_msk/store">
                            @csrf
                            <div class="card-body">

                                <input type="hidden" value="{{ Auth::user()->id }}" name="id_user" required>

                                <div class="form-group">
                                    <label>Kode Barang Masuk</label>
                                    <input type="text" class="form-control" readonly="" value="{{ 'KBM-'.$kd  }}" name="no_brg_msk" placeholder="No Barang Masuk ... " required>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Barang Masuk</label>
                                    <input type="date" class="form-control" name="tgl_brg_msk"  required>
                                </div>


                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <select class="form-control" name="id_stok_barang" id="id_stok_barang" required>
                                        <option value="" hidden="">-- Pilih Barang --</option>
                                        @foreach ($stok_barang as $d )
                                        <option value="{{ $d->id }}">{{ $d->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="detail_barang"></div>

                                <div class="form-group">
                                    <label>Jumlah barang</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Jumlah barang ..." id="jml_brg_msk" name="jml_brg_msk" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Unit</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Total</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                        </div>
                                        <input type="text" readonly class="form-control" id="total" placeholder="Total ..." name="total" required>
                                    </div>
                                </div>

                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                                <a href="/brg_msk" class="btn btn-danger"> <i class="fa fa-undo"></i> Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/core/jquery.3.2.1.min.js"></script>

<!-- Ajax menghitung total Harga -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#jml_brg_msk").keyup(function() {
            var jml_brg_msk = $("#jml_brg_msk").val();
            var harga = $("#harga").val();

            var total = parseInt(harga) * parseInt(jml_brg_msk);
            $("#total").val(total);
        });
    });
</script>

<!-- Ajax Csrf Token -->
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<!-- Ajax Menampilkan Kategori
<script type="text/javascript">
    $("#id_kategori").change(function() {
        var id_kategori = $("#id_kategori").val();
        $.ajax({
            type: "GET",
            url: "/brg_msk/ajax",
            data: "id_kategori=" + id_kategori,
            cache: false,
            success: function(data) {
                $('#detail_barang').html(data);
            }
        });
    });
</script> -->

<!-- Ajax Menampilkan Stok Barang -->
<script type="text/javascript">
    $("#id_stok_barang").change(function() {
        var id_stok_barang = $("#id_stok_barang").val();
        $.ajax({
            type: "GET",
            url: "/brg_msk/ajax",
            data: "id_stok_barang=" + id_stok_barang,
            cache: false,
            success: function(data) {
                $('#detail_barang').html(data);
            }
        });
    });
</script>
@endsection