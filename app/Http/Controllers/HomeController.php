<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(Request $request) {
        $data = Transaksi::where(DB::raw('YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1)'))->get();
        $neworder = Transaksi::orderBy('created_at', 'desc')->limit('10')->get();
        $params = compact('request', 'data', 'neworder');
        return view('dashboard/index', $params);
    }
}
