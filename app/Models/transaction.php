<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'id_produk',
        'nomer_unik',
        'nama_pelanggan',
        'jenis_cuci',
        'plat_nomer',
        'total_harga',
        'uang_bayar',
        'uang_kembali'
    ];
    
    public function products()
    {
        return $this->belongsTo(products::class, 'id_produk');
    }
}
