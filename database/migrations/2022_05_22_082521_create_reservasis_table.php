<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jadwal')->constrained('jadwal_dosen')->onDelete('cascade');
            $table->foreignId('id_mahasiswa')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_dosen')->constrained('dosens')->onDelete('cascade');
            $table->string('nama_awal');
            $table->string('nama_tengah')->nullable();
            $table->string('nama_akhir');
            $table->text('Keperluan');
            $table->boolean('selesai')->default(false);
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
        Schema::dropIfExists('reservasis');
    }
};
