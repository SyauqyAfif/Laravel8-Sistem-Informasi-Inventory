@extends('layout.master')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Stok Barang</h4>
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
                        <a href="#">Stok Barang</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"><i class="fa fa-table"></i> Data Stok Barang</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalAddBarang">
                                    <i class="fa fa-plus"></i>
                                    Tambah Barang
                                </button>
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
                                            <th>Brand Barang</th>
                                            <th>Ukuran</th>
                                            <th>Stok</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Action</th>
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
                                            <td>
                                                <a href="#modalEditBarang{{ $row->id }}" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="#modalHapusBarang{{ $row->id }}" data-toggle="modal" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
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


<!-- Modal Tambah Barang -->
<div class="modal fade" id="modalAddBarang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/stok_barang/store">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control" id="kode_stok_barang" value="{{ 'KSB-'  }}" name="kode_stok_barang" placeholder="Kode Barang ... " required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control" required>
                            <option value="" hidden="">-- Pilih Kategori --</option>

                            @foreach ($kategori as $p )
                            <option value="{{ $p->id }}">{{ $p->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Brand Barang</label>
                        <input type="text" class="form-control" name="nama_barang" placeholder="Nama ..." required>
                    </div>

                    <div class="form-group">
                        <label>Ukuran</label>
                        <select name="ukuran" id="" class="form-control" required>
                            <option value="" hidden="">-- Pilih Ukuran --</option>
                            <option>Small</option>
                            <option>Medium</option>
                            <option>Large</option>
                            <option>Extra Large</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Stok ..." name="stok">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">Unit</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Harga Beli</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="number" class="form-control" placeholder="Harga ..." name="harga" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Harga Jual</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="number" class="form-control" placeholder="Harga ..." name="harga_jual" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Barang -->
@foreach ($stok_barang as $d )
<div class="modal fade" id="modalEditBarang{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/stok_barang/{{ $d->id }}/update">
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $d->id }}" name="id" required>

                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" value="{{ $d->kode_stok_barang }}"  class="form-control" name="kode_stok_barang" placeholder="Kode Barang ... " required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control" required>
                            <option value="{{ $d->id_kategori }}">-- Pilih Kategori --</option>
                            @foreach ($kategori as $p )
                            <option value="{{ $p->id }}">{{ $p->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Brand Barang</label>
                        <input type="text" value="{{ $d->nama_barang }}" class="form-control" name="nama_barang" placeholder="Nama ..." required>
                    </div>

                    <div class="form-group">
                        <label>Ukuran</label>
                        <select name="ukuran" id="" class="form-control" required>
                            <option value="" hidden="">-- Pilih Ukuran --</option>
                            <option>Small</option>
                            <option>Medium</option>
                            <option>Large</option>
                            <option>Extra Large</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <div class="input-group mb-3">
                            <input type="number" value="{{ $d->stok }}" class="form-control" placeholder="Stok ..." name="stok">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">Unit</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Harga Beli</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="number" value="{{ $d->harga }}" class="form-control" placeholder="Harga ..." name="harga" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Harga Jual</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="number" value="{{ $d->harga_jual }}" class="form-control" placeholder="Harga Jual ..." name="harga_jual" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
@endforeach


<!-- Modal Hapus Barang -->
@foreach ($stok_barang as $g )
<div class="modal fade" id="modalHapusBarang{{ $g->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Hapus Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="get" enctype="multipart/form-data" action="/stok_barang/{{ $d->id }}/destroy">
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $d->id }}" name="id" required>

                    <div class="form-group">
                        <h4>Apakah Anda Ingin Menghapus Data Ini ?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"> <i class="fa fa-trash"></i> Hapus</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endforeach
@endsection