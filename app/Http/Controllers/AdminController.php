<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\products;
use App\Models\User;

class AdminController extends Controller
{
 
    public function index() {
        return view('admin', [
            'total' => User::all()->count(),
            'totals' => products::all()->count()
        ]);
    }

}
