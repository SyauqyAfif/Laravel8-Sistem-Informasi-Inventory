@foreach($ajax_barang as $d)

<!-- <div class="form-group">
    <label>Kategori</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
        </div>
        <input type="text" class="form-control" id="nama_kategori" value="{{ $d->nama_kategori }}" readonly required>
    </div>
</div> -->

<div class="form-group">
    <label>Kode Barang</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
        </div>
        <input type="text" class="form-control" id="kode_stok_barang" value="{{ $d->kode_stok_barang }}" readonly required>
    </div>
</div>

<div class="form-group">
    <label>Ukuran</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
        </div>
        <input type="text" class="form-control" id="ukuran" value="{{ $d->ukuran }}" readonly required>
    </div>
</div>

<div class="form-group">
    <label>Harga Beli</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp</span>
        </div>
        <input type="text" class="form-control" id="harga" value="{{ $d->harga }}" readonly required>
    </div>
</div>

@endforeach