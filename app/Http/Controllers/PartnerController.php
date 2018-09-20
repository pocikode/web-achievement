<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;
use DB;

class PartnerController extends Controller
{
    private $done = [];
    private $notYet = [];
    private $activities = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->partnerSubmitedActivityStatus();
        $halaman  = 'partner';
        $sudah    = $this->done;
        $belum    = $this->notYet;
        $kegiatan = $this->activities;
        $cekKategori = $this->checkPartnerCategory();

        $partner = $this->checkPartner();
        $pilihPartner = \App\Santri::where('id', '!=', Auth::user()->id)
                                    ->whereNull('partner')
                                    ->whereNull('level')->get();

        $totalPartnerActivity = $this->totalPartnerActivity();

        $aksesSubmit = DB::table('santris')->where('id', Auth::user()->partner)->value('akses_submit');

        return view('dashboard.partner', compact('halaman','partner','pilihPartner','totalPartnerActivity','sudah','belum','kegiatan','cekKategori','aksesSubmit'));
    }

    public function update(Request $request, $id)
    {
        $user = \App\Santri::find($id);
        $user->partner = $request->partner;
        $user->save();

        $partner = \App\Santri::find($request->partner);
        $partner->partner = $id;
        $partner->save();

        return redirect('partner');
    }

    /*
     * Submit Parner Activity
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        // Cek Jumlah Submit
        $jmlSubmit  = count($request->kegiatan);
        // Cek jumlah yang sudah disubmit
        $achiev     = \App\Achievement::all();
        $jmlSubmited= $achiev->where('id_santri', Auth::user()->partner)->where('tanggal', date('Y-m-d'))->count();
        // Cek jumlah activity
        $activity   = \App\Activity::all();
        $jmlAct     = $activity->where('id_santri', Auth::user()->partner)->count();
        
        foreach($request->kegiatan as $id)
        {
            $data = new \App\Achievement;
            $data->id_activity  = $id;
            $data->id_santri    = Auth::user()->partner;
            $data->status       = 'sukses';
            $data->tanggal      = date('Y-m-d');
            $data->save();
        }

        // Cek apakah ada data hari ini di table daily
        $daily = DB::table('daily')->where('id_santri', Auth::user()->partner)
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
                'id_santri' => Auth::user()->partner,
                'tanggal'   => date('Y-m-d'),
                'status'    => $status
            ]);
        } 
        // Jika sudah ada data
        else {
            // Cek apakah jumlah submit + jumlah activity yang sudah disubmit =  jumlah activity
            if ($jmlSubmit+$jmlSubmited == $jmlAct) {
                DB::table('daily')->where('id_santri', Auth::user()->partner)
                                  ->where('tanggal', date('Y-m-d'))
                                  ->update(['status' => 'sukses']);
            }
        }
        
        return redirect('partner');
    }

    public function aksesSubmitTrue()
    {
        $partner = \App\Santri::find(Auth::user()->partner);
        $partner->akses_submit = 1;
        $partner->save();
        return redirect('partner');
    }

    public function aksesSubmitFalse()
    {
        $partner = \App\Santri::find(Auth::user()->partner);
        $partner->akses_submit = 0;
        $partner->save();
        return redirect('partner');
    }

    private function checkPartner()
    {
        if (is_null(Auth::user()->partner)) {
            return 0;
        } else {
            return Auth::user()->partner;
        }
    }

    private function checkPartnerCategory()
    {
        $fikriyah  = \App\Activity::where('id_santri', Auth::user()->partner)->where('kategori', 3)->count();
        $jasadiyah = \App\Activity::where('id_santri', Auth::user()->partner)->where('kategori', 2)->count();
        $ruhiyah   = \App\Activity::where('id_santri', Auth::user()->partner)->where('kategori', 1)->count();

        $notif = 'Partnermu belum ada kegiatan ';

        if ($fikriyah>0 && $jasadiyah>0 && $ruhiyah>0) {
            return 'ada';
        } else {
            if ($fikriyah == 0) {
                $notif .= 'Fikriyah ';
            } elseif ($jasadiyah == 0) {
                $notif .= 'Jasadiyah ';
            } elseif ($ruhiyah == 0) {
                $notif .= 'Ruhiyah';
            }

            return $notif;
        }
    }

    private function totalPartnerActivity()
    {
        if (!is_null(Auth::user()->partner) || Auth::user()->partner > 0) {
            $activity   = \App\Activity::where('id_santri', Auth::user()->partner)->get();
            return $activity->count();
        } else {
            return 0;
        }
    }

    private function partnerSubmitedActivityStatus()
    {
        $activities   = \App\Activity::where('id_santri', Auth::user()->partner)->get();
        $this->activities = $activities;

        foreach ($activities as $activity) {
            $achievment = \App\Achievement::where('id_activity', $activity->id)->where('id_santri' , Auth::user()->partner)->where('tanggal', Carbon::today()->toDateString())->get();
            if ($achievment->isNotEmpty()) {
                array_push($this->done, $activity);
            } else {
                array_push($this->notYet, $activity);
            }
        }
    }
}
