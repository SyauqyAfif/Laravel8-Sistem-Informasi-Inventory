@extends('layout.master')

@section('content')

<form action="" method="POST">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Ubah Data Kas</h4>
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
                            <a href="#">Ubah Data Kas</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title"><i class="fa "></i>Ubah Data</h4>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">

                                        <div class="col-md-12">
                                            <label for="kode">Kode</label>
                                            <input class="form-control" type="text" name="kode" value="{{$kas->kode}}" readonly>
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <label for="tanggal">Tanggal</label>
                                            <input class="form-control" type="date" name="tanggal" value="{{$kas->tanggal}}">
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <label for="keterangan">Keterangan</label>
                                            <input class="form-control" type="text" name="keterangan" value="{{$kas->keterangan}}">
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <label for="jumlah">Jumlah</label>
                                            <input class="form-control" type="number" name="jumlah" value="{{$kas->jumlah}}">
                                        </div>
                                        <br>
                                </div>
                                <div class="col-md-12" align="center">
                                    <input type="submit" class="btn btn-success btn-send" value="Ubah">
                                    <button type="button" onclick="history.back();" class="btn btn-primary">Kembali</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection