<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ActivityController extends Controller
{
    protected $request;

    function __construct()
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
        $halaman = 'kegiatan';

        $no = 1;
        $kegiatan = \App\Activity::where('id_santri', Auth::user()->id)->get();
        $kategori = \App\Category::all();
        return view('dashboard.activity', compact('kegiatan', 'kategori', 'no', 'halaman'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new \App\Activity;
        $data->id_santri    = Auth::user()->id;
        $data->nama         = $request->nama;
        $data->kategori     = $request->kategori;
        $data->jumlah       = $request->jumlah;
        $data->keterangan   = $request->keterangan;
        $data->save();

        return redirect('activity');
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
        $data = \App\Activity::find($request->id);
        $data->nama         = $request->nama;
        $data->kategori     = $request->kategori;
        $data->jumlah       = $request->jumlah;
        $data->keterangan   = $request->keterangan;
        $data->save();

        return redirect('activity');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = \App\Activity::find($id);
        $data->delete();

        return redirect('activity');
    }

    /**
     * Submit Activity
     */
    public function submit()
    {
        $halaman = 'submit kegiatan';

        $belum = [];

        $id_santri  = Auth::user()->id;
        $kegiatan   = \App\Activity::where('id_santri', $id_santri)->get();

        foreach ($kegiatan as $keg) {
            $achiev = \App\Achievement::all();
            $achiev = $achiev->where('id_kegiatan', $keg->id)->where('id_santri', $id_santri)->where('tanggal', date('Y-m-d'));

            if ($achiev->isEmpty()) {
                array_push($belum, $keg);
            }
        }

        return view('dashboard.submit', compact('halaman', 'belum'));
    }
}
