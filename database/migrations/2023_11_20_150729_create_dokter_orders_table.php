<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokterOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter_orders', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tanggal_disajikan');
            $table->string('waktu_disajikan');
            $table->string('makanan');
            $table->string('ket_makanan')->nullable();
            $table->string('ops_ket_makanan')->nullable();
            $table->string('minuman');
            $table->string('ket_minuman')->nullable();
            $table->string('ops_ket_minuman')->nullable();
            $table->string('status')->nullable()->default('Belum Diproses');
            $table->string('belum_diproses')->nullable();
            $table->string('sedang_diproses')->nullable();
            $table->string('menunggu_pengantaran')->nullable();
            $table->string('sedang_diantar')->nullable();
            $table->string('selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokter_orders');
    }
}
