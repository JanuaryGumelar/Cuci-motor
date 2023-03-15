<?php

namespace App\Models;

use App\Models\products;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log extends Model
{
   
    use HasFactory;
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo(User::class , 'id_user');
    }

    public function products()
    {
        return $this->belongsTo(products::class , 'id_product');
    }
}

