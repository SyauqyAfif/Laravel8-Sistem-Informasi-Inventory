<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    protected $table = 'stok_barang';

    protected $fillable = [
        'kode_stok_barang',
        'id_kategori',
        'nama_barang',
        'ukuran',
        'stok',
        'harga',
        'harga_jual',
        'created_at',
        'updated_at',

    
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}