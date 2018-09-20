<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

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
        if ($request->kategori == 0) {
          return redirect('activity')->with('error','Pilih salah satu kategori!');
        } else{
          $data = new \App\Activity;
          $data->id_santri    = Auth::user()->id;
          $data->nama         = $request->nama;
          $data->kategori     = $request->kategori;
          $data->jumlah       = $request->jumlah;
          $data->save();

          return redirect('activity');
      }
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
        if ($request->kategori == 0) {
            return redirect('activity')->with('error','Pilih salah satu kategori!');
        } else{ 
            $data = \App\Activity::find($request->id);
            $data->nama         = $request->nama;
            $data->kategori     = $request->kategori;
            $data->jumlah       = $request->jumlah;
            $data->keterangan   = $request->keterangan;
            $data->save();

            return redirect('activity');
        }
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
        $no = 1;

        $id_santri  = Auth::user()->id;
        $kegiatan   = \App\Activity::where('id_santri', $id_santri)->get();

        foreach ($kegiatan as $keg) {
            $achiev = \App\Achievement::all();
            $achiev = $achiev->where('id_activity', $keg->id)
                             ->where('id_santri', $id_santri)
                             ->where('tanggal', date('Y-m-d'));

            if ($achiev->isEmpty()) {
                array_push($belum, $keg);
            }
        }

        return view('dashboard.submit', compact('halaman', 'belum', 'no'));
    }

    public function submitPost(Request $request)
    {   
        // Cek Jumlah Submit
        $jmlSubmit  = count($request->kegiatan);
        // Cek jumlah yang sudah disubmit
        $achiev     = \App\Achievement::all();
        $jmlSubmited= $achiev->where('id_santri', Auth::user()->id)->where('tanggal', date('Y-m-d'))->count();
        // Cek jumlah activity
        $activity   = \App\Activity::all();
        $jmlAct     = $activity->where('id_santri', Auth::user()->id)->count();
        
        foreach($request->kegiatan as $id)
        {
            $data = new \App\Achievement;
            $data->id_activity  = $id;
            $data->id_santri    = Auth::user()->id;
            $data->status       = 'sukses';
            $data->tanggal      = date('Y-m-d');
            $data->save();
        }

        // Cek apakah ada data hari ini di table daily
        $daily = DB::table('daily')->where('id_santri', Auth::user()->id)
                                   ->where('tanggal', date('Y-m-d'))
                                   ->count();
        // Jika tidak ada data
        if ($daily == 0) {
            // Jika jumlah submit = jumlah activity
            if ($jmlSubmit == $jmlAct) {
                $status = 'sukses';
            } else {
                $status = 'sebagian';
            }

            // Buat data baru
            DB::table('daily')->insert([
                'id_santri' => Auth::user()->id,
                'tanggal'   => date('Y-m-d'),
                'status'    => $status
            ]);
        } 
        // Jika sudah ada data
        else {
            // Cek apakah jumlah submit + jumlah activity yang sudah disubmit =  jumlah activity
            if ($jmlSubmit+$jmlSubmited == $jmlAct) {
                DB::table('daily')->where('id_santri', Auth::user()->id)
                                  ->where('tanggal', date('Y-m-d'))
                                  ->update(['status' => 'sukses']);
            }
        }
        
        return redirect('dashboard');
    }
}
