<?php

namespace App\Http\Controllers;

use App\Models\log;
use App\Models\User;
use App\Models\products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return view('produk', [
            'products' => products::all()
        ]);
    }

    public function show()
    {
       return view('create_produk');
    }


    /**
     * create
     * 
     * @return void
     */
    public function create()
    {
        return view('create_produk');
    }

    /**
* store
*
* @param  mixed $request
* @return void
*/
public function store(Request $request)
{
    
    $this->validate($request, [
        'jenis_cuci'      => 'required',
        'harga'           => 'required'
    ]);

    
        products::create([
        'jenis_cuci'      => $request->jenis_cuci,
        'harga'           => $request->harga
    ]);


    $user = User::find(auth()->user()->id);
        
                log::create([
                    'id_user' => $user->id,
                    'activity' => 'Input Data Product'
                ]);

    if($request){
        //redirect dengan pesan sukses
        return redirect('/produk')->with(['success' => 'Data Berhasil Disimpan!']);
    }else{
        //redirect dengan pesan error
        return redirect('/produk')->with(['error' => 'Data Gagal Disimpan!']);
    }

    }

   /**
* edit
*
* @param  mixed $user
* @return void
*/
public function edit($id)
    {
        $products = products::find($id);
        return view('edit_produk', ['products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'jenis_cuci' => 'required',
    		'harga' => 'required',
         ]);
      
         $products = products::find($id);
         $products->jenis_cuci = $request->jenis_cuci;
         $products->harga = $request->harga;
         $products->save();
         return redirect('/produk');

         $user = User::find(auth()->user()->id);
        
                log::create([
                    'id_user' => $user->id,
                    'activity' => 'Update Data Product'
                ]);
    }



      /**
* destroy
*
* @param  mixed $id
* @return void
*/
public function destroy($id)
{
  $products = products::findOrfail($id);
  $products->delete();

  $user = User::find(auth()->user()->id);
        
  log::create([
      'id_user' => $user->id,
      'activity' => 'Hapus Data Product'
  ]);
    
  if($products){
     //redirect dengan pesan sukses
     return redirect('/produk')->with(['success' => 'Data Berhasil Dihapus!']);
  }else{
    //redirect dengan pesan error
    return redirect('/produk')->with(['error' => 'Data Gagal Dihapus!']);
  }
}


}
