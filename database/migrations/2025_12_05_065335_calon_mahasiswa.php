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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_prodi')->constrained('prodis')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('nomor_hp');
            $table->string('agama');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('asal_sekolah');
            $table->string('fakultas');
            $table->string('jurusan_pilihan');
            $table->string('foto_diri')->nullable();
            $table->string('status')->default('Menunggu verifikasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calon_mahasiswa');
        // Schema::table('calon_mahasiswas', function (Blueprint $table) {
        //     $table->dropForeign(['user_id']);
        //     $table->dropColumn('user_id');
        // });
    }
    };
