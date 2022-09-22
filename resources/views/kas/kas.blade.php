@extends('layout.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"> Data Kas {{$type}}</h4>
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
                        <a href="#">Kas {{$type}}</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"><i class="fa "></i> Data Kas {{$type}}</h4>
                                <button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Kode</td>
                                        <td>Tanggal</td>
                                        <td>Keterangan</td>
                                        <td>Jumlah</td>
                                        <td>Aksi</td>
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
                                        <td>Rp. {{number_format($k->jumlah)}}</td>
                                        <td>
                                            <a href="{{ route('kas-edit', ['id' => $k->id ] ) }}"> <button class="btn btn-primary  btn-xs">Edit</button></a>
                                            <a href="{{ route('kas-hapus', ['id' => $k->id ] ) }}"> <button class="btn btn-danger btn-xs">Hapus</button></a>
                                        </td>
                                    </tr>
                                    @endforeach 
                                </tbody>
                                <tr>
                                    <td colspan="4">Total Kas {{$type}}</td>
                                    <td colspan="4">Rp. {{number_format($total)}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf

                    <div class="form-group" hidden>
                        <input type="text" class="form-control" name="type_kas" value="{{$type}}">
                    </div>

                    <div class="form-group">
                        <label for="">Kode</label>
                        <input type="text" class="form-control" name="kode"  required>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>

                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" required>
                    </div>

                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection