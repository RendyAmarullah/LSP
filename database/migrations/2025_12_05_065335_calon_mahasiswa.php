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
        Schema::create('calon_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('nomor_hp');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('asal_sekolah');
            $table->string('jurusan_pilihan'); // Pilihan Jurusan
            $table->string('foto_diri')->nullable(); // Path Gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calon_mahasiswa');
    }
    };
