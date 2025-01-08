<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Http\Requests\StoreRiwayatRequest;
use App\Http\Requests\UpdateRiwayatRequest;
use App\Models\Dosen;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_riwayat = Riwayat::where('id_dosen', Auth::guard('dosen')->user()->id)->get();

        return view('dosen.riwayat.index', compact('list_riwayat'));
    }

    public function indexMahasiswa()
    {
        $list_reservasi_mahasiswa = Reservasi::where('id_mahasiswa', Auth::user()->id) -> get();
        $list_riwayat = [];
        foreach($list_reservasi_mahasiswa as $reservasi) {
            $riwayat = Riwayat::where('id_reservasi', $reservasi -> id) -> first();
            if (is_null($riwayat)) {
                continue;
            }
            array_push($list_riwayat, $riwayat);
        }

        return view('mahasiswa.riwayat.index', compact('list_riwayat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($reservasi_id)
    {
        $reservasi = Reservasi::findOrFail($reservasi_id);

        return view('dosen.riwayat.form-riwayat', compact('reservasi'));
    }

    public function showCompletedReservasi()
    {
        $list_reservasi = Reservasi::where([['id_dosen', '=', Auth::guard('dosen')->user()->id], ['selesai', '=', true]]) -> get();

        return view('dosen.riwayat.index-selesai', compact('list_reservasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRiwayatRequest  $request
     * @param  String $reservasi_id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiwayatRequest $request, $reservasi_id)
    {
        $riwayat = new Riwayat;

        $riwayat -> id_reservasi = $reservasi_id;
        $riwayat -> id_dosen = Auth::guard('dosen')->user()->id;
        $riwayat -> pesan = $request -> pesan;
        $riwayat -> tanggal = Carbon::now()->format('m/d/Y');
        $riwayat -> save();

        return redirect() -> route('riwayat.dosen.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function show($riwayat_id)
    {
        $riwayat = Riwayat::findOrFail($riwayat_id);

        return view('dosen.riwayat.detail', compact('riwayat'));
    }

    public function showMahasiswaRiwayat($riwayat_id)
    {
        $riwayat = Riwayat::findOrFail($riwayat_id);
        $riwayat -> nama_dosen = Dosen::findOrFail($riwayat -> id_dosen) -> name;

        return view("mahasiswa.riwayat.detail", compact('riwayat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function edit(Riwayat $riwayat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRiwayatRequest  $request
     * @param  String $riwayat_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiwayatRequest $request, $riwayat_id)
    {
        $riwayat = Riwayat::findOrFail($riwayat_id);
        $riwayat -> tanggal = $request -> date;
        $riwayat -> pesan = $request -> pesan;
        $riwayat -> save();

        return redirect()->route('riwayat.dosen.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Riwayat $riwayat)
    {
        //
    }
}
