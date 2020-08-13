<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use App\Rute;
use App\Karyawan;
use App\Kendaraan;

class JadwalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('Penjadwalan', ['Super Admin', 'divisi_penjadwalan']);
        $jadwal = Jadwal::orderBy('tanggal', 'desc')->orderBy('jam_berangkat', 'asc')->get();
        $params = compact('jadwal', 'request');
        return view('jadwal/index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('Penjadwalan', ['Super Admin', 'divisi_penjadwalan']);
        $rute = Rute::all();
        $kendaraan = Kendaraan::where('status', 'available')->get();
        $supir = Karyawan::where('status', 'Aktif')->where('jabatan', 'supir')->get();
        $params = compact('rute', 'kendaraan', 'supir' ,'request');
        return view('jadwal/add', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Penjadwalan', ['Super Admin', 'divisi_penjadwalan']);
        $this->validate($request, [
            'tanggal' => 'required',
            'jam_berangkat' => 'required',
            'perkiraan_tiba' => 'required',
            'id_rute' => 'required',
            'id_kendaraan' => 'required',
            'id_supir' => 'required',
            'harga' => 'required'
        ]);

        $jadwal = Jadwal::create($request->all());
        if (!$jadwal) {
            return redirect('jadwal/create')->with('error', 'Failed to insert data jadwal');
        }

        return redirect('jadwal')->with('success', 'Success to insert data jadwal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('Penjadwalan', ['Super Admin', 'divisi_penjadwalan']);
        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return redirect('jadwal')->with('error', 'Failed to get data, data not found!');
        }

        $params = compact('jadwal');
        return view('jadwal/show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('Penjadwalan', ['Super Admin', 'divisi_penjadwalan']);
        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return redirect('jadwal')->with('error', 'Failed to get data, data not found!');
        }
        $rute = Rute::all();
        $kendaraan = Kendaraan::where('status', 'available')->get();
        $supir = Karyawan::where('status', 'Aktif')->where('jabatan', 'supir')->get();
        $params = compact('rute', 'kendaraan', 'supir', 'jadwal');
        return view('jadwal/edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('Penjadwalan', ['Super Admin', 'divisi_penjadwalan']);
        $this->validate($request, [
            'tanggal' => 'required',
            'jam_berangkat' => 'required',
            'perkiraan_tiba' => 'required',
            'id_rute' => 'required',
            'id_kendaraan' => 'required',
            'id_supir' => 'required',
            'harga' => 'required'
        ]);

        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return redirect('jadwal/edit')->with('error', 'Failed to get data, data not found!');
        }

        $jadwal->update($request->all());
        if ($jadwal->save()) {
            return redirect('jadwal/edit')->with('error', 'Failed to update data!');
        }

        $jadwal = Jadwal::find($id);
        return redirect('jadwal')->with('success', 'Success to update data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Penjadwalan', ['Super Admin', 'divisi_penjadwalan']);
        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return redirect('jadwal')->with('error', 'Failed to get data, data not found!');
        }

        $jadwal->delete();
        return redirect('jadwal')->with('success', 'Success to delete data!');
    }
}
