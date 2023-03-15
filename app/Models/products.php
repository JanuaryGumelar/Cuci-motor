<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['jenis_cuci','harga'];

    public function log(){
        return $this->hasMany(log::class);
    }

    public function transaction() 
    {
        return $this->hasOne(transaction::class, 'id', 'id_produk');
    }
}
