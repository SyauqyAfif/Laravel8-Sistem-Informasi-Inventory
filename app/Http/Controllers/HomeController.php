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
        $user = User::count();
        $stok_barang = StokBarang::count();
        $kategori = Kategori::count();
        $transaksi = Kas::count();
        $brg_msk = BrgMsk::count();
        $brg_klr = BrgKlr::count();
        $type_kas = Kas::count();
        return view('home', compact('user','stok_barang','kategori','transaksi','brg_msk','brg_klr','type_kas'));
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
