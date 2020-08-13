<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\User;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
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
        $karyawan = Karyawan::all();
        $params = compact('karyawan', 'request');
        return view('karyawan/index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('Pengadaan', ['Super Admin', 'divisi_pengadaan']);
        $jabatan = ['kasir','divisi_penjadwalan','divisi_pengadaan', 'supir'];
        $params = compact('jabatan', 'request');
        return view('karyawan/add', $params);
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
            'nama' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'jabatan' => 'required',
            'telepon' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        DB::beginTransaction();
        $data_karyawan = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jabatan' => $request->jabatan,
            'telepon' => $request->telepon
        ];
        $karyawan = Karyawan::create($data_karyawan);
        if (!$karyawan) {
            DB::rollBack();
            return redirect('karyawan/create')->with('error', 'Failed to insert data karyawan')->withInput();
        }
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'id_karyawan' => $karyawan->id,
            'password' => Hash::make($request->password),
        ]);
        $user->id_karyawan = $karyawan->id;
        $user->save();
        if (!$user) {
            DB::rollBack();
            return redirect('karyawan/create')->with('error', 'Failed to insert data karyawan')->withInput();
        }
        DB::commit();
        return redirect('karyawan')->with('success', 'Success to insert data karyawan');
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
        $karyawan = Karyawan::find($id);
        if (!$karyawan) {
            return redirect('karyawan')->with('error', 'Failed to get data, data not found!');
        }

        $params = compact('karyawan');
        return view('karyawan/show', $params);
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
        $karyawan = Karyawan::find($id);
        if (!$karyawan) {
            return redirect('karyawan')->with('error', 'Failed to get data, data not found!');
        }
        $jabatan = ['kasir','divisi_penjadwalan','divisi_pengadaan', 'supir'];
        $status = ['Aktif', 'Non Aktif'];
        $user = User::where('id_karyawan', $karyawan->id)->first();
        $params = compact('karyawan', 'jabatan', 'status', 'user', 'request');
        return view('karyawan/edit', $params);
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
            'nama' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'jabatan' => 'required',
            'telepon' => 'required',
            'status' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $karyawan = Karyawan::find($id);
        if (!$karyawan) {
            return redirect('karyawan/edit')->with('error', 'Failed to get data, data not found!');
        }
        $data_karyawan = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jabatan' => $request->jabatan,
            'telepon' => $request->telepon
        ];

        $karyawan->update($data_karyawan);
        if (!$karyawan->save()) {
            return redirect('karyawan/edit')->with('error', 'Failed to update data!');
        }

        $data_user = [
            'name' => $request->nama,
            'email' => $request->email,
            'id_karyawan' => $karyawan->id,
            'password' => Hash::make($request->password),
        ];
        $user = User::where('id_karyawan', $karyawan->id)->first();
        $user->update($data_user);
        if (!$user->save()) {
            return redirect('karyawan/edit')->with('error', 'Failed to update data!');
        }

        $user = User::find($id);
        $karyawan = Karyawan::find($id);
        return redirect('karyawan')->with('success', 'Success to update data!');
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
        DB::beginTransaction();
        $karyawan = Karyawan::find($id);
        if (!$karyawan) {
            DB::rollback();
            return redirect('karyawan')->with('error', 'Failed to get data, data not found!');
        }

        $user = User::where('id_karyawan', $karyawan->id)->first();
        if (!$user) {
            DB::rollback();
            return redirect('karyawan')->with('error', 'Failed to get data, data not found!');
        }

        $karyawan->delete();
        $user->delete();
        DB::commit();
        return redirect('karyawan')->with('success', 'Success to delete data!');
    }
}
