<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forum', function (Blueprint $table) {
            $table->string('id_forum', 10)->primary();
            $table->string('id_user', 10);
            $table->string('judul');
            $table->text('isi');
            $table->enum('kategori', [
                'pupuk_dan_nutrisi',
                'penyakit_terung_ungu',
                'pemasaran_produk',
                'alat_dan_teknologi',
                'diskusi_tanaman'
            ]);
            $table->string('gambar', 255)->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('users');
        });
        Schema::create('komentar_forum', function (Blueprint $table) {
            $table->string('id_komentar', 10)->primary();
            $table->string('id_forum', 10);
            $table->string('id_user', 10);
            $table->text('isi');
            $table->timestamps();
            $table->foreign('id_forum')->references('id_forum')->on('forum');
            $table->foreign('id_user')->references('id_user')->on('users');
        });
        Schema::create('like_forum', function (Blueprint $table) {
            $table->string('id_like', 10)->primary();
            $table->string('id_forum', 10);
            $table->string('id_user', 10);
            $table->timestamps();
            $table->foreign('id_forum')->references('id_forum')->on('forum');
            $table->foreign('id_user')->references('id_user')->on('users');
        });
        Schema::create('balasan_forum', function (Blueprint $table) {
            $table->string('id_balasan', 10)->primary();
            $table->string('id_komentar', 10);
            $table->string('id_user', 10);
            $table->text('isi');
            $table->timestamps();
            $table->foreign('id_komentar')->references('id_komentar')->on('komentar_forum');
            $table->foreign('id_user')->references('id_user')->on('users');
        });
        Schema::create('artikel', function (Blueprint $table) {
            $table->string('id_artikel', 10)->primary();
            $table->string('id_user', 10);
            $table->string('judul');
            $table->text('isi');
            $table->enum('kategori', [
                'pupuk_dan_nutrisi',
                'penyakit_terung_ungu',
                'pemasaran_produk',
                'alat_dan_teknologi',
                'berita_tanaman',
                'edukasi'
            ]);            
            $table->string('gambar', 255)->nullable();
            $table->enum('status', ['draft', 'dipublikasikan'])->default('dipublikasikan');
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('users');
        });
        Schema::create('komentar_artikel', function (Blueprint $table) {
            $table->string('id_komentar', 10)->primary();
            $table->string('id_artikel', 10);
            $table->string('id_user', 10);
            $table->text('isi');
            $table->timestamps();
            $table->foreign('id_artikel')->references('id_artikel')->on('artikel');
            $table->foreign('id_user')->references('id_user')->on('users');
        });
        Schema::create('like_artikel', function (Blueprint $table) {
            $table->string('id_like', 10)->primary();
            $table->string('id_artikel', 10);
            $table->string('id_user', 10);
            $table->timestamps();
            $table->foreign('id_artikel')->references('id_artikel')->on('artikel');
            $table->foreign('id_user')->references('id_user')->on('users');
        });
        Schema::create('balasan_artikel', function (Blueprint $table) {
            $table->string('id_balasan', 10)->primary();
            $table->string('id_komentar', 10);
            $table->string('id_user', 10);
            $table->text('isi');
            $table->timestamps();
            $table->foreign('id_komentar')->references('id_komentar')->on('komentar_artikel');
            $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balasan_artikel');
        Schema::dropIfExists('like_artikel');
        Schema::dropIfExists('komentar_artikel');
        Schema::dropIfExists('artikel');
        Schema::dropIfExists('balasan_forum');
        Schema::dropIfExists('like_forum');
        Schema::dropIfExists('komentar_forum');
        Schema::dropIfExists('forum');
    }
};
