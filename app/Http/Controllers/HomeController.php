<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\StokBarang;
use App\Models\Kategori;
use App\Models\BrgKlr;
use App\models\BrgMsk;
use App\Models\Kas;
use app\Models\User;
use DB; 

class HomeController extends Controller
{
    public function home()
    {
        $date = date('Y-m-d');

        $user = User::count();
        $stok_barang = StokBarang::count();
        $kategori = Kategori::count();
        $transaksi = Kas::count();
        $brg_msk = BrgMsk::count();
        $brg_klr = BrgKlr::count();
        $totalMasuk =  Kas::count();
        $totalKeluar =  Kas::count();

        $masuk_jan = BrgMsk::whereMonth('tgl_brg_msk', '01')->count();
        $masuk_feb = BrgMsk::whereMonth('tgl_brg_msk', '02')->count();
        $masuk_mar = BrgMsk::whereMonth('tgl_brg_msk', '03')->count();
        $masuk_apr = BrgMsk::whereMonth('tgl_brg_msk', '04')->count();
        $masuk_mei = BrgMsk::whereMonth('tgl_brg_msk', '05')->count();
        $masuk_jun = BrgMsk::whereMonth('tgl_brg_msk', '06')->count();
        $masuk_jul = BrgMsk::whereMonth('tgl_brg_msk', '07')->count();
        $masuk_agu = BrgMsk::whereMonth('tgl_brg_msk', '08')->count();
        $masuk_sep = BrgMsk::whereMonth('tgl_brg_msk', '09')->count();
        $masuk_okt = BrgMsk::whereMonth('tgl_brg_msk', '10')->count();
        $masuk_nov = BrgMsk::whereMonth('tgl_brg_msk', '11')->count();
        $masuk_des = BrgMsk::whereMonth('tgl_brg_msk', '12')->count();

        $keluar_jan = BrgKlr::whereMonth('tgl_brg_klr', '01')->count();
        $keluar_feb = BrgKlr::whereMonth('tgl_brg_klr', '02')->count();
        $keluar_mar = BrgKlr::whereMonth('tgl_brg_klr', '03')->count();
        $keluar_apr = BrgKlr::whereMonth('tgl_brg_klr', '04')->count();
        $keluar_mei = BrgKlr::whereMonth('tgl_brg_klr', '05')->count();
        $keluar_jun = BrgKlr::whereMonth('tgl_brg_klr', '06')->count();
        $keluar_jul = BrgKlr::whereMonth('tgl_brg_klr', '07')->count();
        $keluar_agu = BrgKlr::whereMonth('tgl_brg_klr', '08')->count();
        $keluar_sep = BrgKlr::whereMonth('tgl_brg_klr', '09')->count();
        $keluar_okt = BrgKlr::whereMonth('tgl_brg_klr', '10')->count();
        $keluar_nov = BrgKlr::whereMonth('tgl_brg_klr', '11')->count();
        $keluar_des = BrgKlr::whereMonth('tgl_brg_klr', '12')->count();

        return view('home', compact('user','stok_barang','kategori','transaksi','brg_msk','brg_klr','totalMasuk', 'totalKeluar',
        
        'masuk_jan','masuk_feb','masuk_mar','masuk_apr','masuk_mei','masuk_jun','masuk_jul','masuk_agu','masuk_sep','masuk_okt','masuk_nov','masuk_des',

        'keluar_jan','keluar_feb','keluar_mar','keluar_apr','keluar_mei','keluar_jun','keluar_jul','keluar_agu','keluar_sep','keluar_okt','keluar_nov','keluar_des'
    
    ));
    }

    //Ganti Password
    public function ganti_password()
    {
        return view('user.ganti_password');
    }
    public function ganti_password_aksi(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with("error", "Password Sekarang Tidak Sesuai!");
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->back()->with("error", "Password baru tidak boleh sama dengan password sekarang!");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        $user = Auth::user();
        $user-> password = bcrypt($request->get('new-password'));
        $user-> save();
        return redirect()->back()->with("sukses", "Password berhasil diganti!");
        
    }
}
