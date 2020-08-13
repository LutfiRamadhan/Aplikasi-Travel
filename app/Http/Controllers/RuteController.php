<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rute;

class RuteController extends Controller
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
        $rute = Rute::all();
        $params = compact('rute', 'request');
        return view('rute/index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('Penjadwalan', ['Super Admin', 'divisi_penjadwalan']);
        $params = compact('request');
        return view('rute/add', $params);
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
            'kota_asal' => 'required',
            'kota_destinasi' => 'required',
        ]);

        $rute = Rute::create($request->all());
        if (!$rute) {
            return redirect('rute/create')->with('error', 'Failed to insert data karyawan');
        }

        return redirect('rute')->with('success', 'Success to insert data karyawan');
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
        return redirect('rute');
        $rute = Rute::find($id);
        if (!$rute) {
            return redirect('rute')->with('error', 'Failed to get data, data not found!');
        }

        $params = compact('rute');
        return view('rute/show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $this->authorize('Penjadwalan', ['Super Admin', 'divisi_penjadwalan']);
        $rute = Rute::find($id);
        if (!$rute) {
            return redirect('rute')->with('error', 'Failed to get data, data not found!');
        }
        
        $params = compact('rute', 'request');
        return view('rute/edit', $params);
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
            'kota_asal' => 'required',
            'kota_destinasi' => 'required',
        ]);
        $rute = Rute::find($id);
        if (!$rute) {
            return redirect('rute/edit')->with('error', 'Failed to get data, data not found!');
        }

        $rute->update($request->all());
        if ($rute->save()) {
            return redirect('rute/edit')->with('error', 'Failed to update data!');
        }

        $rute = Rute::find($id);
        return redirect('rute')->with('success', 'Success to update data!');
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
        $rute = Rute::find($id);
        if (!$rute) {
            return redirect('rute')->with('error', 'Failed to get data, data not found!');
        }

        $rute->delete();
        return redirect('rute')->with('success', 'Success to delete data!');
    }
}
