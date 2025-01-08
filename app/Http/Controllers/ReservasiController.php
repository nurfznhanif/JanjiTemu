<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Reservasi;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function reservasiDosen($dosen_id)
    {
        $dosen = Dosen::findOrFail($dosen_id);
        $jadwals = Jadwal::where('id_dosen', $dosen_id)->get();

        return view('mahasiswa.reservasi.form-reservasi', compact('dosen', 'jadwals'));
    }

    public function createReservasi($dosen_id, Request $request)
    {
        $validated = $request->validate([
            'jadwal_dosen' => 'required|exists:jadwal_dosen,id',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'keperluan' => 'required|string|max:255',
        ]);

        Reservasi::create([
            'id_mahasiswa' => Auth::id(),
            'id_dosen' => $dosen_id,
            'id_jadwal' => $validated['jadwal_dosen'],
            'nama_awal' => $validated['first_name'],
            'nama_tengah' => $validated['middle_name'],
            'nama_akhir' => $validated['last_name'],
            'keperluan' => $validated['keperluan'],
        ]);

        return redirect()->route('mahasiswa.reservasi')->with('success', 'Reservasi berhasil dibuat.');
    }

    public function listReservasi()
    {
        $list_reservasi = Reservasi::where('id_mahasiswa', Auth::id())
            ->with('jadwal') // Ensure relationship exists
            ->get();

        foreach ($list_reservasi as $reservasi) {
            $reservasi->dosen_name = Dosen::find($reservasi->id_dosen)->name;
        }

        return view('mahasiswa.reservasi.reservasi-list', compact('list_reservasi'));
    }

    public function detailReservasi($id_reservasi)
    {
        $reservasi = Reservasi::with('jadwal')->findOrFail($id_reservasi);
        $reservasi->dosen_name = Dosen::findOrFail($reservasi->id_dosen)->name;
        $jadwals = Jadwal::where('id_dosen', $reservasi->id_dosen)->get();

        return view('mahasiswa.reservasi.detail', compact('reservasi', 'jadwals'));
    }

    public function updateReservasi($id_reservasi, Request $request)
    {
        $validated = $request->validate([
            'jadwal_dosen' => 'required|exists:jadwal_dosen,id',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'keperluan' => 'required|string|max:255',
        ]);

        $reservasi = Reservasi::findOrFail($id_reservasi);
        $reservasi->update([
            'id_jadwal' => $validated['jadwal_dosen'],
            'nama_awal' => $validated['first_name'],
            'nama_tengah' => $validated['middle_name'],
            'nama_akhir' => $validated['last_name'],
            'keperluan' => $validated['keperluan'],
        ]);

        return redirect()->route('mahasiswa.reservasi')->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function deleteReservasi($id_reservasi)
    {
        $reservasi = Reservasi::findOrFail($id_reservasi);
        $reservasi->delete();

        return redirect()->route('reservasi.list')->with('success', 'Reservasi berhasil dihapus.');
    }

    public function indexDosen()
    {
        $list_reservasi = Reservasi::where('id_dosen', Auth::guard('dosen')->user()->id)
            ->where('selesai', false)
            ->with('jadwal')
            ->get();

        return view('dosen.reservasi.index', compact('list_reservasi'));
    }

    public function selesaiReservasi($reservasi_id)
    {
        $reservasi = Reservasi::findOrFail($reservasi_id);
        $reservasi->update(['selesai' => true]);

        return redirect()->route('reservasi.dosen.index')->with('success', 'Reservasi selesai.');
    }

    public function detailReservasiDosen($id_reservasi)
    {
        $reservasi = Reservasi::with('jadwal', 'dosen', 'mahasiswa')->findOrFail($id_reservasi);

        return view('dosen.reservasi.detail', compact('reservasi'));
    }
}
