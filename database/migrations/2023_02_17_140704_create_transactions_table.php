<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk');
            $table->string('nomer_unik');
            $table->string('nama_pelanggan');
            $table->string('jenis_cuci');
            $table->string('plat_nomer');
            $table->bigInteger('total_harga');
            $table->bigInteger('uang_bayar');
            $table->bigInteger('uang_kembali')->default();
            $table->timestamps();
            $table->foreign('id_produk')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
