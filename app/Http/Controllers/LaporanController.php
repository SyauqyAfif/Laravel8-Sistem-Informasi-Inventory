<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokBarang;
use App\Models\Kategori;
use App\Models\BrgKlr;
use App\models\BrgMsk;
use App\Models\Kas;
use Illuminate\Support\Facades\DB;
use app\Models\User;

class LaporanController extends Controller
{
    // Laporan User
    public function lap_user()
    {
        $user = User::all();
        return view('laporan.user.lap_user', compact('user'));
    }
    public function cetak_user()
    {
        $user = User::all();
        return view('laporan.user.cetak_user', compact('user'));
    }
    // Laporan Kategori
    public function lap_kategori()
    {
        $kategori = Kategori::all();
        return view('laporan.barang.lap_kategori', compact('kategori'));
    }
    public function cetak_kategori()
    {
        $kategori = Kategori::all();
        return view('laporan.barang.cetak.cetak_kategori', compact('kategori'));
    }
    // Laporan Stok Barang
    public function lap_stok_barang()
    {
        $stok_barang = StokBarang::join('kategori', 'kategori.id', '=', 'stok_barang.id_kategori')
            ->select('stok_barang.*', 'kategori.nama_kategori')
            ->get();
        $kategori = Kategori::all();
        return view('laporan.barang.lap_stok_barang', compact('stok_barang', 'kategori'));
    }
    public function cetak_stok_barang()
    {
        $stok_barang = StokBarang::join('kategori', 'kategori.id', '=', 'stok_barang.id_kategori')
            ->select('stok_barang.*', 'kategori.nama_kategori')
            ->get();
        $kategori = Kategori::all();
        return view('laporan.barang.cetak.cetak_stok_barang', compact('stok_barang', 'kategori'));
    }
    // Laporan Barang Masuk
    public function lap_brg_msk()
    {
        $brg_msk = BrgMsk::join('stok_barang', 'stok_barang.id', '=', 'brg_msk.id_stok_barang')
            ->join('kategori', 'kategori.id', '=', 'stok_barang.id_kategori')
            ->select('brg_msk.*', 'kategori.nama_kategori', 'stok_barang.ukuran', 'stok_barang.stok', 'stok_barang.harga', 'stok_barang.nama_barang')
            ->get();

        return view('laporan.barang.lap_brg_msk', compact('brg_msk'));
    }
    public function cetak_brg_msk(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        if ($tgl_mulai and $tgl_selesai) {
            $brg_msk = BrgMsk::join('stok_barang', 'stok_barang.id', '=', 'brg_msk.id_stok_barang')
                ->join('kategori', 'kategori.id', '=', 'stok_barang.id_kategori')
                ->select('brg_msk.*', 'kategori.nama_kategori', 'stok_barang.ukuran', 'stok_barang.stok', 'stok_barang.harga', 'stok_barang.nama_barang')
                ->whereBetween('brg_msk.tgl_brg_msk', [$tgl_mulai, $tgl_selesai])
                ->get();
            $sum_total = BrgMsk::whereBetween('tgl_brg_msk', [$tgl_mulai, $tgl_selesai])
                ->sum('total');
        } else {
            $brg_msk = BrgMsk::join('stok_barang', 'stok_barang.id', '=', 'brg_msk.id_stok_barang')
                ->join('kategori', 'kategori.id', '=', 'stok_barang.id_kategori')
                ->select('brg_msk.*', 'kategori.nama_kategori', 'stok_barang.ukuran', 'stok_barang.stok', 'stok_barang.harga', 'stok_barang.nama_barang')
                ->get();
        }
        return view('laporan.barang.cetak.cetak_brg_msk', compact('brg_msk', 'sum_total', 'tgl_mulai', 'tgl_selesai'));
    }
    // Laporan Barang Keluar
    public function lap_brg_klr()
    {
        $brg_klr = BrgKlr::join('stok_barang', 'stok_barang.id', '=', 'brg_klr.id_stok_barang')
            ->join('kategori', 'kategori.id', '=', 'stok_barang.id_kategori')
            ->select('brg_klr.*', 'kategori.nama_kategori', 'stok_barang.ukuran', 'stok_barang.stok', 'stok_barang.harga', 'stok_barang.nama_barang')
            ->get();

        return view('laporan.barang.lap_brg_klr', compact('brg_klr'));
    }
    public function cetak_brg_klr(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        if ($tgl_mulai and $tgl_selesai) {
            $brg_klr = BrgKlr::join('stok_barang', 'stok_barang.id', '=', 'brg_klr.id_stok_barang')
                ->join('kategori', 'kategori.id', '=', 'stok_barang.id_kategori')
                ->select('brg_klr.*', 'kategori.nama_kategori', 'stok_barang.ukuran', 'stok_barang.stok', 'stok_barang.harga', 'stok_barang.nama_barang')
                ->whereBetween('brg_klr.tgl_brg_klr', [$tgl_mulai, $tgl_selesai])
                ->get();
            $sum_total = BrgKlr::whereBetween('tgl_brg_klr', [$tgl_mulai, $tgl_selesai])
                ->sum('total');
        } else {
            $brg_klr = BrgKlr::join('stok_barang', 'stok_barang.id', '=', 'brg_klr.id_stok_barang')
                ->join('kategori', 'kategori.id', '=', 'stok_barang.id_kategori')
                ->select('brg_klr.*', 'kategori.nama_kategori', 'stok_barang.ukuran', 'stok_barang.stok', 'stok_barang.harga', 'stok_barang.nama_barang')
                ->get();
        }
        return view('laporan.barang.cetak.cetak_brg_klr', compact('brg_klr', 'sum_total', 'tgl_mulai', 'tgl_selesai'));
    }
    // Laporan transaksi
    public function lap_transaksi()
    {
        $kas = DB::table('kas')
            ->select('id', 'kode', 'tanggal', 'keterangan', 'jumlah', 'type_kas')
            ->get();
        $totalMasuk = DB::table("kas")->where('type_kas', '=', 'masuk')->get()->sum("jumlah");
        $totalKeluar = DB::table("kas")->where('type_kas', '=', 'keluar')->get()->sum("jumlah");
        $saldo = $totalMasuk - $totalKeluar;

        return view('laporan.kas.transaksi.lap_transaksi', [
            'kas' => $kas,
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'saldo' => $saldo
        ]);
    }
    public function cetak_transaksi(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;
        if ($tgl_mulai and $tgl_selesai) {
            $kas = DB::table('kas')
                ->select('id', 'kode', 'tanggal', 'keterangan', 'jumlah', 'type_kas')
                ->whereBetween('kas.tanggal', [$tgl_mulai, $tgl_selesai])
                ->get();
            $sum_total = Kas::whereBetween('tanggal', [$tgl_mulai, $tgl_selesai])
                ->sum('jumlah');

            $totalMasuk = DB::table("kas")->where('type_kas', '=', 'masuk')->get()->sum("jumlah");
            $totalKeluar = DB::table("kas")->where('type_kas', '=', 'keluar')->get()->sum("jumlah");
            $saldo = $totalMasuk - $totalKeluar;
        } else {
            $kas = DB::table('kas')
                ->select('id', 'kode', 'tanggal', 'keterangan', 'jumlah', 'type_kas')
                ->get();
        }
        return view('laporan.kas.transaksi.cetak_transaksi', compact('kas', 'totalMasuk', 'totalKeluar', 'saldo', 'sum_total', 'tgl_mulai', 'tgl_selesai'));
    }
    // Laporan Kas Masuk
    public function lap_kas_msk()
    {
        $kas = DB::table('kas')
            ->select('id', 'kode', 'tanggal', 'keterangan', 'jumlah')
            ->where('type_kas', '=', 'masuk')
            ->get();
        $total = DB::table("kas")->where('type_kas', '=', 'masuk')->get()->sum("jumlah");
        return view('laporan.kas.kas_msk.lap_kas_msk', compact('kas', 'total'));
    }
    public function cetak_kas_msk(Request $request)
    {
        
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        if ($tgl_mulai and $tgl_selesai) {
            $kas = DB::table('kas')
                ->select('id', 'kode', 'tanggal', 'keterangan', 'jumlah')
                ->where('type_kas', '=', 'masuk')
                ->whereBetween('kas.tanggal', [$tgl_mulai, $tgl_selesai])
                ->get();
            $sum_total = Kas::whereBetween('tanggal', [$tgl_mulai, $tgl_selesai])
                ->sum('jumlah');

            $total = DB::table("kas")->where('type_kas', '=', 'masuk')->get()->sum("jumlah");
        } else {
            $kas = DB::table('kas')
                ->select('id', 'kode', 'tanggal', 'keterangan', 'jumlah')
                ->where('type_kas', '=', 'masuk')
                ->get();
        }
        return view('laporan.kas.kas_msk.cetak_kas_msk', compact('kas', 'total', 'sum_total', 'tgl_mulai', 'tgl_selesai'));
    }


    // Laporan Kas Keluar
    public function lap_kas_klr()
    {
        $kas = DB::table('kas')
            ->select('id', 'kode', 'tanggal', 'keterangan', 'jumlah')
            ->where('type_kas', '=', 'keluar')
            ->get();
        $total = DB::table("kas")->where('type_kas', '=', 'keluar')->get()->sum("jumlah");
        return view('laporan.kas.kas_klr.lap_kas_klr', compact('kas', 'total'));
    }
    public function cetak_kas_klr(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        if ($tgl_mulai and $tgl_selesai) {
            $kas = DB::table('kas')
                ->select('id', 'kode', 'tanggal', 'keterangan', 'jumlah')
                ->where('type_kas', '=', 'keluar')
                ->whereBetween('kas.tanggal', [$tgl_mulai, $tgl_selesai])
                ->get();
            $sum_total = Kas::whereBetween('tanggal', [$tgl_mulai, $tgl_selesai])
                ->sum('jumlah');

            $total = DB::table("kas")->where('type_kas', '=', 'keluar')->get()->sum("jumlah");
        } else {
            $kas = DB::table('kas')
                ->select('id', 'kode', 'tanggal', 'keterangan', 'jumlah')
                ->where('type_kas', '=', 'keluar')
                ->get();
        }
        return view('laporan.kas.kas_klr.cetak_kas_klr', compact('kas', 'total', 'sum_total', 'tgl_mulai', 'tgl_selesai'));
    }

}
