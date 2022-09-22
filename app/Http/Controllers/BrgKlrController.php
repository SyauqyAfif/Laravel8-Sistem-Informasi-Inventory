<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Models\BrgKlr;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Asia/Jakarta');

class BrgKlrController extends Controller
{
    public function index()
    {
        $brg_klr = BrgKlr::join('stok_barang', 'stok_barang.id', '=', 'brg_klr.id_stok_barang')
            ->join('kategori', 'kategori.id', '=', 'stok_barang.id_kategori')
            ->select('brg_klr.*', 'kategori.nama_kategori', 'stok_barang.ukuran', 'stok_barang.stok', 'stok_barang.harga', 'stok_barang.nama_barang','stok_barang.harga_jual')
            ->get();
        $stok_barang = StokBarang::all();
        $kategori = Kategori::all();

        return view('barang.brg_klr.brg_klr', compact('stok_barang', 'brg_klr'));
    }

    public function create()
    {
        $stok_barang = StokBarang::all();

        $q = DB::table('brg_klr')->select(DB::raw('MAX(RIGHT(no_brg_klr,4)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd  = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        return view('barang.brg_klr.add', compact('stok_barang','kd'));
    }

    public function ajax(Request $request)
    {
        $id_stok_barang['id_stok_barang'] = $request->id_stok_barang;

        $ajax_barang  = StokBarang::where('id', $id_stok_barang)->get();

        return view('barang.brg_klr.ajax', compact('ajax_barang'));
    }

    public function store(Request $request)
    {

        $stok_barang = StokBarang::find($request->id_stok_barang);

        if ($stok_barang->stok < $request->jml_brg_klr) {
            return redirect('/brg_klr/create')->with('error', 'Jumlah Barang Melebihi Stok');
        } else {

            BrgKlr::create([
                'no_brg_klr'      => $request->no_brg_klr,
                'id_stok_barang'  => $request->id_stok_barang,
                'id_user'         => $request->id_user,
                'tgl_brg_klr'     => $request->tgl_brg_klr,
                'jml_brg_klr'     => $request->jml_brg_klr,
                'total'           => $request->total,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ]);
            
            $stok_barang->stok   -= $request->jml_brg_klr;
            $stok_barang->save();

            return redirect('/brg_klr')->with('success', 'Data Berhasil Disimpan');
        }
    }
}
