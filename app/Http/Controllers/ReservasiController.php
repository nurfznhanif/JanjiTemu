<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function reservasiDosen($dosen_id)
    {
        $dosen = Dosen::findOrFail($dosen_id);

        return view('mahasiswa.reservasi.form-reservasi', compact('dosen'));
    }

    public function createReservasi($dosen_id, Request $request)
    {
        $reservasi = new Reservasi;

        $reservasi->id_mahasiswa = Auth::user()->id;
        $reservasi->id_dosen = $dosen_id;
        $reservasi->nama_awal = $request->first_name;
        $reservasi->nama_tengah = $request->middle_name;
        $reservasi->nama_akhir = $request->last_name;
        $reservasi->tanggal = $request->date;
        $reservasi->pesan = $request->pesan;
        $reservasi->save();

        return view('mahasiswa.reservasi.daftar-reservasi');
    }

    public function listReservasi()
    {
        $list_reservasi = Reservasi::where('id_mahasiswa', Auth::user()->id)->get();
        foreach ($list_reservasi as $reservasi) {
            $dosen_temp = Dosen::find($reservasi->id_dosen);
            $reservasi->dosen_name = $dosen_temp->name;
        }

        return view('mahasiswa.reservasi.reservasi-list', compact('list_reservasi'));
    }

    public function detailReservasi($id_reservasi)
    {
        $reservasi = Reservasi::findOrFail($id_reservasi);
        $reservasi->dosen_name = Dosen::findOrFail($reservasi->id_dosen)->name;

        return view('mahasiswa.reservasi.detail', compact('reservasi'));
    }

    public function detailReservasiDosen($id_reservasi)
    {
        $reservasi = Reservasi::findOrFail($id_reservasi);

        return view('dosen.reservasi.detail', compact('reservasi'));
    }

    public function updateReservasi($id_reservasi, Request $request)
    {
        $reservasi = Reservasi::findOrFail($id_reservasi);
        $reservasi->nama_awal = $request->first_name;
        $reservasi->nama_tengah = $request->middle_name;
        $reservasi->nama_akhir = $request->last_name;
        $reservasi->tanggal = $request->date;
        $reservasi->pesan = $request->pesan;
        $reservasi->save();

        return redirect()->route('reservasi.list');
    }

    public function deleteReservasi($id_reservasi)
    {
        $reservasi = Reservasi::findOrFail($id_reservasi);
        $reservasi->delete();

        return redirect()->route('reservasi.list');
    }

    public function indexDosen()
    {
        $list_reservasi = Reservasi::where('id_dosen', Auth::guard('dosen')->user()->id)
            ->where('selesai', false)
            ->get();

        return view('dosen.reservasi.index', compact('list_reservasi'));
    }

    public function selesaiReservasi($reservasi_id)
    {
        $reservasi = Reservasi::findOrFail($reservasi_id);

        $reservasi->selesai = true;
        $reservasi->save();

        return redirect()->route('reservasi.dosen.index');
    }
}
