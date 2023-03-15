<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User:: create([
          'username' => 'Admin', 
          'password' => bcrypt('admin'),
          'nama' => 'january gumelar',
          'jk'   => 'L',
          'alamat' => 'Subang',
          'no_hp' => '082120242036',
          'role' => 'admin'
        ]);  
        
        User:: create([
          'username' => 'Kasir', 
          'password' => bcrypt('kasir'),
          'nama' => 'january gumelar',
          'jk'   => 'L',
          'alamat' => 'Bandung',
          'no_hp' => '082120242036',
          'role' => 'Kasir'
        ]);  

        User:: create([
          'username' => 'Owner',
          'password' => 'owner',
          'nama'     => 'Jan',
          'jk'       => 'L',
          'alamat'   => 'padang',
          'no_hp'    => '321',
          'role'     => 'owner'
        ]);
    }
}
