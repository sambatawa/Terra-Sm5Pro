<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manajemen_sensor', function (Blueprint $table) {
            $table->string('id_sensor', 10)->primary();
            $table->enum('tipe', ['BME280', 'BH1750', 'GPS', 'Ultrasonik'])->nullable();
            $table->timestamps();
        });
        Schema::create('BME280', function (Blueprint $table) {
            $table->id();
            $table->string('id_sensor', 10);
            $table->float('kelembapan')->nullable();
            $table->float('suhu')->nullable();
            $table->float('tekanan_udara')->nullable();
            $table->timestamps();
            $table->foreign('id_sensor')->references('id_sensor')->on('manajemen_sensor')->onDelete('cascade');
        });
        Schema::create('BH1750', function (Blueprint $table) {
            $table->id();
            $table->string('id_sensor', 10);
            $table->float('intensitas_cahaya')->nullable();
            $table->timestamps();
            $table->foreign('id_sensor')->references('id_sensor')->on('manajemen_sensor')->onDelete('cascade');
        });
        Schema::create('GPS', function (Blueprint $table) {
            $table->id();
            $table->string('id_sensor', 10);
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->timestamps();
            $table->foreign('id_sensor')->references('id_sensor')->on('manajemen_sensor')->onDelete('cascade');
        });
        Schema::create('Ultrasonik', function (Blueprint $table) {
            $table->id();       
            $table->string('id_sensor', 10);
            $table->float('jarak')->nullable();  
            $table->timestamps();
            $table->foreign('id_sensor')->references('id_sensor')->on('manajemen_sensor')->onDelete('cascade');
        });      
    }

    public function down(): void
    {
        Schema::dropIfExists('Ultrasonik');
        Schema::dropIfExists('GPS');
        Schema::dropIfExists('BH1750');
        Schema::dropIfExists('BME280');
        Schema::dropIfExists('manajemen_sensor');
    }
};
