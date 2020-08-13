<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kendaraan;

class KendaraanController extends Controller
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
        $this->authorize('Pengadaan', ['Super Admin', 'divisi_pengadaan']);
        $kendaraan = Kendaraan::all();
        $params = compact('kendaraan', 'request');
        return view('kendaraan/index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Pengadaan', ['Super Admin', 'divisi_pengadaan']);
        return view('kendaraan/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Pengadaan', ['Super Admin', 'divisi_pengadaan']);
        $this->validate($request, [
            'merk' => 'required',
            'tipe_jenis' => 'required',
            'plat_nomor' => 'required',
            'kapasitas' => 'required'
        ]);

        $kendaraan = Kendaraan::create($request->all());
        if (!$kendaraan) {
            return redirect('kendaraan/create')->with('error', 'Failed to insert data kendaraan');
        }

        return redirect('kendaraan')->with('success', 'Success to insert data kendaraan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('Pengadaan', ['Super Admin', 'divisi_pengadaan']);
        return redirect('kendaraan');
        $kendaraan = Kendaraan::find($id);
        if (!$kendaraan) {
            return redirect('kendaraan')->with('error', 'Failed to get data, data not found!');
        }

        $params = compact('kendaraan');
        return view('kendaraan/show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $this->authorize('Pengadaan', ['Super Admin', 'divisi_pengadaan']);
        $kendaraan = Kendaraan::find($id);
        if (!$kendaraan) {
            return redirect('kendaraan')->with('error', 'Failed to get data, data not found!');
        }
        $status = ['available','service','disable'];
        $params = compact('kendaraan', 'status');
        return view('kendaraan/edit', $params);
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
        $this->authorize('Pengadaan', ['Super Admin', 'divisi_pengadaan']);
        $this->validate($request, [
            'merk' => 'required',
            'tipe_jenis' => 'required',
            'plat_nomor' => 'required',
            'kapasitas' => 'required',
            'status' => 'required'
        ]);
        
        $kendaraan = Kendaraan::find($id);
        if (!$kendaraan) {
            return redirect('kendaraan/edit')->with('error', 'Failed to get data, data not found!');
        }

        $kendaraan->update($request->all());
        if ($kendaraan->save()) {
            return redirect('kendaraan/edit')->with('error', 'Failed to update data!');
        }

        $kendaraan = Kendaraan::find($id);
        return redirect('kendaraan')->with('success', 'Success to update data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Pengadaan', ['Super Admin', 'divisi_pengadaan']);
        $kendaraan = Kendaraan::find($id);
        if (!$kendaraan) {
            return redirect('kendaraan')->with('error', 'Failed to get data, data not found!');
        }

        $kendaraan->delete();
        return redirect('kendaraan')->with('success', 'Success to delete data!');
    }
}
