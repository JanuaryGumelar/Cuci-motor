<?php

namespace App\Http\Controllers;

use App\Models\log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user', [
            'users' => User::all()
        ]);
    }

    /**
     * create
     * 
     * @return void
     */
    public function create()
    {
        return view('create');
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
        'nama'      => 'required',
        'no_hp'     => 'required',
        'jk'        => 'required',
        'alamat'    => 'required',
        'username'  => 'required',
        'password'  => 'required',
        'role'      => 'required'
    ]);

    
        User::create([
        'nama'      => $request->nama,
        'no_hp'     => $request->no_hp,
        'jk'        => $request->jk,
        'alamat'    => $request->alamat,
        'username'  => $request->username,  
        'password'  => Hash::make($request->password),
        'role'      => $request->role
    ]);

    $user = User::find(auth()->user()->id);
        
                log::create([
                    'id_user' => $user->id,
                    'activity' => 'Input Data Users'
                ]);

    if($request){
        //redirect dengan pesan sukses
        return redirect('/user')->with(['success' => 'Data Berhasil Disimpan!']);
    }else{
        //redirect dengan pesan error
        return redirect('/user')->with(['error' => 'Data Gagal Disimpan!']);
    }
}

    /**
* edit
*
* @param  mixed $user
* @return void
*/
public function edit(User $user)
{
    return view('edit', compact('user'));
}


/**
* update
*
* @param  mixed $request
* @param  mixed $user
* @return void
*/
public function update(Request $request, User $user)
{
    $this->validate($request, [
        'nama'      => 'required',
        'no_hp'     => 'required',
        'jk'        => 'required',
        'alamat'    => 'required',
        'username'  => 'required',
        'password'  => 'required',
        'role'      => 'required'
    ]);

    //get data User by ID
    User::findOrFail($user->id);
    {

        $user->update([
        'nama'      => $request->nama,
        'no_hp'     => $request->no_hp,
        'jk'        => $request->jk,
        'alamat'    => $request->alamat,
        'username'  => $request->username,  
        'password'  => $request->password,
        'role'      => $request->role
    ]);

    }

    $user = User::find(auth()->user()->id);
        
                log::create([
                    'id_user' => $user->id,
                    'activity' => 'Edit Data Users'
                ]);

    if($request){
        //redirect dengan pesan sukses
        return redirect('/user')->with(['success' => 'Data Berhasil Disimpan!']);
    }else{
        //redirect dengan pesan error
        return redirect('/user')->with(['error' => 'Data Gagal Disimpan!']);
    }

}

    /**
* destroy
*
* @param  mixed $id
* @return void
*/
public function destroy($id)
{
  $user = User::findOrfail($id);
  $user->delete();

  $user = User::find(auth()->user()->id);
        
  log::create([
      'id_user' => $user->id,
      'activity' => 'Hapus Data Users'
  ]);
  
  if($user){
     //redirect dengan pesan sukses
     return redirect('/user')->with(['success' => 'Data Berhasil Dihapus!']);
  }else{
    //redirect dengan pesan error
    return redirect('/user')->with(['error' => 'Data Gagal Dihapus!']);
  }
}

}
