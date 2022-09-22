<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Models\BrgMsk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Asia/Jakarta');


class BrgMskController extends Controller
{
    public function index()
    {
        $brg_msk = BrgMsk::join('stok_barang', 'stok_barang.id', '=', 'brg_msk.id_stok_barang')
            ->join('kategori', 'kategori.id', '=', 'stok_barang.id_kategori')
            ->select('brg_msk.*', 'kategori.nama_kategori', 'stok_barang.ukuran', 'stok_barang.stok', 'stok_barang.harga', 'stok_barang.nama_barang')
            ->get();
        $stok_barang = StokBarang::all();
        $kategori = Kategori::all();

        return view('barang.brg_msk.brg_msk', compact('stok_barang', 'brg_msk'));
    }

    public function create()
    {
        $stok_barang = StokBarang::all();

        $q = DB::table('brg_msk')->select(DB::raw('MAX(RIGHT(no_brg_msk,4)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd  = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        return view('barang.brg_msk.add', compact('stok_barang','kd'));
    }

    public function ajax(Request $request)
    {
        $id_stok_barang['id_stok_barang'] = $request->id_stok_barang;

        $ajax_barang            = StokBarang::where('id', $id_stok_barang)->get();

        return view('barang.brg_msk.ajax', compact('ajax_barang'));
    }

    public function store(Request $request)
    {
        BrgMsk::create([
            'no_brg_msk'      => $request->no_brg_msk,
            'id_stok_barang'  => $request->id_stok_barang,
            'id_user'         => $request->id_user,
            'tgl_brg_msk'     => $request->tgl_brg_msk,
            'jml_brg_msk'     => $request->jml_brg_msk,
            'total'           => $request->total,
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s'),
        ]);

        $stok_barang = StokBarang::find($request->id_stok_barang);

        $stok_barang->stok   += $request->jml_brg_msk;

        $stok_barang->save();

        return redirect('/brg_msk')->with('success', 'Data Berhasil Disimpan');
    }
}
