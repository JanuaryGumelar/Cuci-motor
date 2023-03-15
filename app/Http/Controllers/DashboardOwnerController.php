<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\products;
use App\Models\transaction;
use Illuminate\Http\Request;

class DashboardOwnerController extends Controller
{
    public function index() {
        return view('owner.dashboard_owner', [
            'total_users' => User::all()->count(),
            'total_products' => products::all()->count(),
            'total_transactions' => transaction::all()->count()

        ]);
    }
}
