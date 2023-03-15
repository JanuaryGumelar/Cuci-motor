<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\transaction;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index() {
        return view('kasir.dashboard_kasir', [
            'transaction' => transaction::all()->count()
        ]);
    }

}
