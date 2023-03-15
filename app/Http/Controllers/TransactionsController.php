<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\log;
use App\Models\transaction;
use App\Models\User;
use App\Models\products;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransactionsController extends Controller
{
    public function index()
    {
        return view('kasir.kasir', [
            'transaction' => transaction::all()
        ]);
    }

    public function show($id)
    {

        $transaction = transaction::find($id);
        return view('kasir.show_transaction', compact('transaction')
    );

    }

    
    /**
     * create
     * 
     * @return void
     */
    public function create()
    {
        return view('kasir.transaction', [
            'product' => products::all()
        ]);
    }

    // public function show()
    // {
    //    return view('kasir.kasir');
    // }


    /**
* store
*
* @param  mixed $request
* @return void
*/
public function store(Request $request)
{
    $this->validate($request, [
        'nomer_unik'         => 'required',
        'nama_pelanggan'     => 'required',
        'jenis_cuci'         => 'required',
        'total_harga'        => 'required',
        'plat_nomer'         => 'required',
        'uang_bayar'         => 'required',
        'uang_kembali'       
    ]);

    

    
        transaction::create([
        'nomer_unik'         => $request->nomer_unik = rand(100000, 999999),
        'nama_pelanggan'     => $request->nama_pelanggan,
        'jenis_cuci'         => $request->jenis_cuci,
        'plat_nomer'         => $request->plat_nomer,
        'total_harga'        => $request->total_harga,
        'uang_bayar'         => $request->uang_bayar,
        'uang_kembali'       => ($request->uang_bayar - $request->total_harga),
    ]);

    $user = User::find(auth()->user()->id);
        
                log::create([
                    'id_user' => $user->id,
                    'activity' => 'Input Data Transaction'
                ]);

    if($request){
        //redirect dengan pesan sukses
        return redirect('/kasir')->with(['success' => 'Data Berhasil Disimpan!']);
    }else{
        //redirect dengan pesan error
        return redirect('/kasir')->with(['error' => 'Data Gagal Disimpan!']);
    }
}

    public function data(Request $request)

    {

        $id = $request->input('id');
        $data = DB::table('products')->where('id', $id)->first();

        return response()->json($data);

    }

}
