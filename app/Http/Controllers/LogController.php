<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\log;


class LogController extends Controller
{
    public function index(): View
    {
        // Ambil semua log untuk user yang sedang login
        $logs = DB::table('logs')->where('id', Auth::id())->get();
        $logs= log::with('users')->get();
        return view('owner.log', compact('logs'));
    }
}