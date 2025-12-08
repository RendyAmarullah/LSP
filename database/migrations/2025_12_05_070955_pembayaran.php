<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function(Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('id_calon_mahasiswa')
                    ->constrained('calon_mahasiswas')
                    ->onDelete('cascade');
            $table->dateTime('tanggal');
            $table->enum('jenis_pembayaran', ['biaya pendaftaran', 'daftar ulang']);
            $table->bigInteger('jumlah_bayar');
            $table->string('metode_pembayaran');
            $table->string('bukti_bayar')->nullable();
            $table->enum('status', ['pending', 'lunas','ditolak']);
            $table->text('keterangan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
