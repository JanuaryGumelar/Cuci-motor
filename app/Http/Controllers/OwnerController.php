<?php

namespace App\Http\Controllers;

use App\Models\log;
use App\Models\products;
use App\Models\transaction;
;use App\Models\owner;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function data_users()
    {
        return view('owner.data_users' , [
            'users' => User::all()
        ]);
    }

    public function data_produk()
    {
        return view('owner.data_produk' , [
            'products' => products::all()
        ]);
    }

    public function data_transaction()
    {

        $transaction = transaction::with('products')->get();
        return view('owner.data_transaction', compact('transaction'));
    }

    public function searchdp(Request $request)
    {
        $search = $request->search;
        $transaction = transaction::where('nama_pelanggan', 'LIKE', '%'. $search . '%')->paginate(5);
        return view('owner.data_transaction', compact('transaction'));

    }

    public function data_report()
    {
        $total = transaction::select([
            transaction::raw('sum(uang_bayar - uang_kembali) as total_harga'),
        ])
        ->groupBy(transaction::raw('MONTH(created_at)'))
        // ->groupBy(transaction::raw('WEEK(created_at)'))
        ->get();

        $months = array();  
        $totals = [];

        foreach ($total as $month) {
            
            $format = Carbon::parse()->format('F');
            array_push($months, $format);
            $totals[] += $month->total_harga;
        }

        return view('owner.data_report', [
            'bulan' => $months,
            'total_harga' => $totals,
            'panjang' => $total->count()
        ]);
    }    


}
