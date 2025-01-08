<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalDosen extends Migration
{
    public function up()
    {
        Schema::create('jadwal_dosen', function (Blueprint $table) {
            $table->id(); // bigIncrements
            $table->foreignId('id_dosen')->constrained('dosens')->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
}
