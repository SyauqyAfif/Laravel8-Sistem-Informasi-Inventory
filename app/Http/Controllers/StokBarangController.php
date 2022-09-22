<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokBarang;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Asia/Jakarta');

class StokBarangController extends Controller
{
    public function stok_barang()
    {
        $stok_barang = StokBarang::join('kategori', 'kategori.id', '=', 'stok_barang.id_kategori')
            ->select('stok_barang.*', 'kategori.nama_kategori')
            ->get()->sortBy('kode_stok_barang');
        $kategori = Kategori::all();

        return view('barang.stok_barang', compact('stok_barang', 'kategori'));
    }

    public function store(Request $request)
    {
        StokBarang::create([
            
            'kode_stok_barang'   => $request->kode_stok_barang,
            'id_kategori'   => $request->id_kategori,
            'nama_barang'   => $request->nama_barang,
            'ukuran'        => $request->ukuran,
            'stok'          => $request->stok,
            'harga'         => $request->harga,
            'harga_jual'    => $request->harga_jual,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        return redirect('/stok_barang')->with('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        $stok_barang = StokBarang::find($id);
        
        $stok_barang->kode_stok_barang   = $request->kode_stok_barang;
        $stok_barang->id_kategori   = $request->id_kategori;
        $stok_barang->nama_barang   = $request->nama_barang;
        $stok_barang->ukuran        = $request->ukuran;
        $stok_barang->stok          = $request->stok;
        $stok_barang->harga         = $request->harga;
        $stok_barang->harga_jual    = $request->harga_jual;
        $stok_barang->updated_at    = date('Y-m-d H:i:s');

        $stok_barang->save();

        return redirect('/stok_barang')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $stok_barang = StokBarang::find($id);

        $stok_barang->delete();

        return redirect('/stok_barang')->with('success', 'Data Berhasil Dihapus');
    }
}
