<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;

class DashboardController extends Controller
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
    public function index()
    {
        $halaman = 'dashboard';
        $listKegiatan = 0;

        $id_santri  = Auth::user()->id;
        $kegiatan   = \App\Activity::where('id_santri', $id_santri)->get();
        if ($kegiatan->count() > 0) {
            $listKegiatan = 1;
        }

        $sudah = [];
        $belum = [];

        foreach ($kegiatan as $keg) {
            $achiev     = \App\Achievement::all();
            //$achiev = $achiev->where(['id_kegiatan', 'id_santri', 'tanggal'], [$keg->id, $id_santri, date('Y-m-d')]);
            $achiev = $achiev->where('id_activity', $keg->id)->where('tanggal', date('Y-m-d'))->where('id_santri' , $id_santri);

            if ($achiev->isNotEmpty()) {
                //$achiev = $achiev->toArray();
                array_push($sudah, $keg);
            } else {
                array_push($belum, $keg);
            }
        }

        return view('dashboard.index', compact('sudah', 'belum', 'halaman', 'listKegiatan'));
        echo(count($belum));
    }
}
