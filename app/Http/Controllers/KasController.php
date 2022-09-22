<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Kas;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Asia/Jakarta');

class KasController extends Controller
{
    public function index()
    {
        $totalMasuk = DB::table("kas")->where('type_kas', '=', 'masuk')->get()->sum("jumlah");
        $totalKeluar = DB::table("kas")->where('type_kas', '=', 'keluar')->get()->sum("jumlah");
        $saldo = $totalMasuk - $totalKeluar;

        // return view
        return view('home', [
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'saldo' => $saldo
        ]);
    }

    public function kas($type)
    {
        $kas = DB::table('kas')
            ->select('id', 'kode', 'tanggal', 'keterangan', 'jumlah')
            ->where('type_kas', '=', $type)
            ->get();

        $total = DB::table("kas")->where('type_kas', '=', $type)->get()->sum("jumlah");


        return view('kas.kas', ['kas' => $kas, 'type' => $type, 'total' => $total]);
    }

    public function Store(Request $request)
    {
        $kas = new Kas();
        $kas->kode        = $request->kode;
        $kas->tanggal     = $request->tanggal;
        $kas->keterangan  = $request->keterangan;
        $kas->jumlah      = $request->jumlah;
        $kas->type_kas    = $request->type_kas;
        $kas->save();
        return redirect('kas/' . $request->type_kas)->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $kas = Kas::find($id);
        return view('kas.kasedit', ['kas' => $kas]);
    }

    public function update(Request $request, $id)
    {
        $a = Kas::findOrFail($id);
        $a->tanggal    = $request->get('tanggal');
        $a->keterangan = $request->get('keterangan');
        $a->jumlah     = $request->get('jumlah');
        $a->save();

        $type_kas      = Kas::find($id)->type_kas;

        return redirect('kas/' . $type_kas) ->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $type_kas = Kas::find($id)->type_kas;

        $hapus = Kas::findOrFail($id);
        $hapus->delete();

        return redirect('kas/' . $type_kas) ->with('success', 'Data Berhasil Dihapus');
    }

    public function transaksi()
    {
        $kas = DB::table('kas')
            ->select('id', 'kode', 'tanggal', 'keterangan', 'jumlah', 'type_kas')
            ->get();
        $totalMasuk = DB::table("kas")->where('type_kas', '=', 'masuk')->get()->sum("jumlah");
        $totalKeluar = DB::table("kas")->where('type_kas', '=', 'keluar')->get()->sum("jumlah");
        $saldo = $totalMasuk - $totalKeluar;

        return view('kas.transaksi', [
            'kas' => $kas,
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'saldo' => $saldo
        ]);
    }
}
