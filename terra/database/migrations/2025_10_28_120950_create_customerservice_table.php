<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_masalah', function (Blueprint $table) {
            $table->string('id_laporan', 10)->primary();
            $table->string('id_user', 10);
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('kategori', ['akun', 'transaksi', 'teknis', 'lainnya']);
            $table->enum('status', ['terbuka', 'dalam_proses', 'selesai'])->default('terbuka');
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi'])->default('sedang');
            $table->string('lampiran', 255)->nullable();
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');

        });
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->string('id_tanggapan', 10)->primary();
            $table->string('id_laporan', 10);
            $table->string('id_user', 10);
            $table->text('isi_tanggapan');
            $table->timestamps();
            $table->foreign('id_laporan')->references('id_laporan')->on('laporan_masalah')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
        Schema::create('qna', function (Blueprint $table) {
            $table->string('id_qna', 10)->primary();
            $table->string('id_user', 10);
            $table->string('pertanyaan');
            $table->enum('kategori', ['akun', 'transaksi', 'teknis', 'lainnya']);
            $table->enum('status_jawaban', ['terjawab', 'belum_terjawab'])->default('belum_terjawab');
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
        Schema::create('jawaban', function (Blueprint $table) {
            $table->string('id_jawaban', 10)->primary();
            $table->string('id_qna', 10);
            $table->string('id_user', 10);
            $table->text('isi_jawaban');
            $table->timestamps();
            $table->foreign('id_qna')->references('id_qna')->on('qna')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban');
        Schema::dropIfExists('qna');
        Schema::dropIfExists('tanggapan');
        Schema::dropIfExists('laporan_masalah');
    }
};
