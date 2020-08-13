<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Jadwal;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
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
        $this->authorize('Ticketing', ['Super Admin', 'kasir']);
        config()->set('database.connections.mysql.strict', false);
        DB::reconnect(); //important as the existing connection if any would be in strict mode
        /* $data = DB::table('transaksi', 't')->rightJoin('jadwal', 't.id_jadwal', '=', 'jadwal.id')
                    ->join('rute', 'jadwal.id_rute', '=', 'rute.id')->join('kendaraan', 'jadwal.id_kendaraan', '=', 'kendaraan.id')
                    ->where('jadwal.tanggal', 'DATE(NOW())')->groupBy('jadwal.id')->orderBy('jam_berangkat', 'asc')
                    ->select('tanggal', 'jam_berangkat', 'kota_asal', 'kota_destinasi', 'merk', 'tipe_jenis', 'kapasitas', DB::raw('(kapasitas - COUNT( t.id )) tersedia'), DB::raw('SUM(IF(t.`status`="Booking",1,null)) booking'))->get(); */
        $query = DB::raw('SELECT t.id, j.tanggal, j.jam_berangkat, r.kota_asal, r.kota_destinasi, k.merk, k.tipe_jenis, kapasitas, (kapasitas - COUNT( t.id )) tersedia, SUM(IF(t.`status`=\'Booking\',1,null)) booking FROM transaksi t RIGHT JOIN jadwal j ON t.id_jadwal = j.id INNER JOIN rute r ON j.id_rute = r.id INNER JOIN kendaraan k ON j.id_kendaraan = k.id WHERE j.tanggal = DATE(NOW()) GROUP BY j.id');
        $data = DB::select($query);
        //now changing back the strict ON
        config()->set('database.connections.mysql.strict', true);
        DB::reconnect();
        $params = compact('data', 'request');
        return view('transaksi/index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id, Request $request)
    {
        $this->authorize('Ticketing', ['Super Admin', 'kasir']);
        $jadwal = Jadwal::with('kendaraan')->with('rute')->where('id', $id)->first();
        if (!$jadwal) {
            return redirect('transaksi')->with('error', 'Failed to get data, data not found!');
        }
        $transaksi = Transaksi::where('id_jadwal', $id)->get();
        $no_transaksi = "TX-DTRVL-".date('Ymd-').str_pad(count($transaksi), 3, "0", STR_PAD_LEFT);;
        $kapasitas = [];
        for ($i=1; $i <= $jadwal->kendaraan->kapasitas; $i++) { 
            array_push($kapasitas, $i);
        }
        $seat_number = array_diff($kapasitas, array_column($transaksi->toArray(), 'seat_number'));
        $status = ['Booking', 'Paid', 'Confirmed'];
        $params = compact('jadwal', 'transaksi', 'no_transaksi', 'seat_number', 'status');
        return view('transaksi/add', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Ticketing', ['Super Admin', 'kasir']);
        $this->validate($request, [
            'no_transaction' => 'required',
            'nama_penumpang' => 'required',
            'nomor_telepon' => 'required',
            'status' => 'required',
            'id_jadwal' => 'required',
            'seat_number' => 'required'
        ]);

        $transaksi = Transaksi::create($request->all());
        if (!$transaksi) {
            return redirect('transaksi/create')->with('error', 'Failed to insert data transaksi');
        }

        return redirect('transaksi')->with('success', 'Success to insert data transaksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $this->authorize('Ticketing', ['Super Admin', 'kasir']);
        $jadwal = Jadwal::with('kendaraan')->with('rute')->where('id', $id)->first();
        if (!$jadwal) {
            return redirect('transaksi')->with('error', 'Failed to get data, data not found!');
        }
        $transaksi = Transaksi::where('id_jadwal', $id)->get();
        $params = compact('transaksi', 'jadwal', '');
        return view('transaksi/show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $this->authorize('Ticketing', ['Super Admin', 'kasir']);
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return back()->with('error', 'Failed to get data, data not found!');
        }
        
        $jadwal = Jadwal::with('kendaraan')->with('rute')->where('id', $transaksi->id_jadwal)->first();
        if (!$jadwal) {
            return back()->with('error', 'Failed to get data, data not found!');
        }
        $tmp_transaction = Transaksi::where('id_jadwal', $jadwal->id)->get();
        $kapasitas = [];
        for ($i=1; $i <= $jadwal->kendaraan->kapasitas; $i++) { 
            array_push($kapasitas, $i);
        }
        $seat_number = array_diff($kapasitas, array_column($tmp_transaction->toArray(), 'seat_number'));
        $status = ['Booking', 'Paid', 'Confirmed', 'Cancel'];
        $params = compact('transaksi', 'status', 'jadwal', 'seat_number');
        return view('transaksi/edit', $params);
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
        $this->authorize('Ticketing', ['Super Admin', 'kasir']);
        $this->validate($request, [
            'nama_penumpang' => 'required',
            'nomor_telepon' => 'required',
            'status' => 'required',
            'id_jadwal' => 'required',
            'seat_number' => 'required'
        ]);
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return redirect('transaksi/edit')->with('error', 'Failed to get data, data not found!');
        }

        $transaksi->update($request->all());
        if (!$transaksi->save()) {
            return redirect('transaksi/edit')->with('error', 'Failed to update data!');
        }

        // $transaksi = Transaksi::find($id);
        return redirect('transaksi/'.$transaksi->id_jadwal)->with('success', 'Success to update data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Ticketing', ['Super Admin', 'kasir']);
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return redirect('transaksi')->with('error', 'Failed to get data, data not found!');
        }

        $transaksi->delete();
        return redirect('transaksi')->with('success', 'Success to delete data!');
    }
}
