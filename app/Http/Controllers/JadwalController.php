<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the jadwal for the logged-in dosen.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwals = Jadwal::where('id_dosen', Auth::guard('dosen')->id())->get();
        return view('dosen.jadwal.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new jadwal.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.jadwal.create');
    }

    /**
     * Store a newly created jadwal in storage.
     *
     * Validates the input data and stores a new Jadwal.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i', // Ensuring time is in the correct format
        ]);

        $idDosen = Auth::guard('dosen')->id();

        if (!$idDosen) {
            return redirect()->back()->with('error', 'Anda harus login sebagai dosen untuk menambahkan jadwal.');
        }

        Jadwal::create([
            'id_dosen' => $idDosen,
            'date' => $validated['date'],
            'time' => $validated['time'],
        ]);

        return redirect()->route('jadwal.dosen.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified jadwal.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        return view('dosen.jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified jadwal.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        return view('dosen.jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified jadwal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $jadwal->update([
            'date' => $validated['date'],
            'time' => $validated['time'],
        ]);

        return redirect()->route('jadwal.dosen.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified jadwal from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.dosen.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    /**
     * Show the reservation form for a specific dosen.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showReservasiForm($id)
    {
        $dosen = Dosen::findOrFail($id); // Get the lecturer
        $jadwals = Jadwal::where('id_dosen', $id)->get(); // Fetch available schedules
        return view('mahasiswa.reservasi.form', compact('dosen', 'jadwals'));
    }
}
