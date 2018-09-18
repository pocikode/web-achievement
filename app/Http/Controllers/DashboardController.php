<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            $achiev = $achiev->where('id_activity', $keg->id)->where('id_santri' , $id_santri)->where('tanggal', '=', Carbon::today()->toDateString());

            if ($achiev->isNotEmpty()) {
                //$achiev = $achiev->toArray();
                array_push($sudah, $keg);
            } else {
                array_push($belum, $keg);
            }
        }
        $list      = array_merge($sudah, $belum);
        
        $namaBulan = $this->namaBulan();
        $bulanan   = $this->progressBulanan();

        return view('dashboard.index', compact('kegiatan', 'sudah', 'belum', 'halaman', 'listKegiatan', 'namaBulan', 'bulanan'));
    }


    // Menampilkan Progess Bulanan
    private function progressBulanan()
    {
        $month = date('m');
        $year  = date('Y');
        // Draw table for Calendar 
        $calendar = '<table class="table table-bordered text-center table-sm">';

        // Draw Calendar table headings 
        $headings = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
        $calendar.= '
            <tr>
            <td class="calendar-day-head">'.implode('</td>
            <td class="calendar-day-head">',$headings).'</td>
            </tr>
        ';

        //days and weeks variable for now ... 
        $running_day = date('w',mktime(0,0,0,$month,1,$year));
        $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();

        // row for week one 
        $calendar.= '<tr>';

        // Display "blank" days until the first of the current week 
        for($x = 0; $x < $running_day; $x++){
            $calendar.= '<td> </td> ';
            $days_in_this_week++;
        }

        // Show days.... 
        
        for($list_day = 1; $list_day <= $days_in_month; $list_day++):
            // if($list_day==date('d') && $month==date('n'))
            // {
            //     $currentday='currentday';
            // }else
            // {
            //     $currentday='';
            // }
            $date = date('Y-m-d', mktime(0,0,0,date('n'),$list_day,date('Y')));
            $status = $this->statusHarian($date);
            if ($list_day==date('d') && $month==date('n')) {
                $currentday='currentday';
            } elseif ($status == 'sukses') {
                $bg = 'bg-success';
                $currentday = '';
            } elseif ($status == 'sebagian') {
                $bg = 'bg-warning';
                $currentday = '';
            } elseif ($status == 'gagal') {
                $bg = 'bg-danger';
                $currentday = '';
            } elseif ($list_day<date('d') && $status == 'kosong') {
                $bg = 'bg-danger';
                $currentday = '';
            } else {
                $bg = '';
                $currentday = '';
            }

            $calendar.= '<td class="calendar-day '.$currentday.' '.$bg.'">';
            
                //Add in the day number
                if($list_day<date('d') && $month==date('n'))
                {
                    $showtoday='<strong class="overday ">'.$list_day.'</strong>';
                }else
                {
                    $showtoday=$list_day;
                }

                $calendar.= '<div class="day-number">'.$showtoday.'</div>';

            // Draw table end
            $calendar.= '</td>';
            if($running_day == 6){
                $calendar.= '</tr>';
                if(($day_counter+1) != $days_in_month){
                    $calendar.= '<tr>';
                }
                $running_day = -1;
                $days_in_this_week = 0;
            }
            $days_in_this_week++; $running_day++; $day_counter++;
        endfor;

        // Finish the rest of the days in the week
        if($days_in_this_week < 8){
            for($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar.= '<td class="calendar-day-np"> </td>';
            endfor;
        }

        // Draw table final row
        $calendar.= '</tr>';

        // Draw table end the table 
        $calendar.= '</table>';
        
        // Finally all done, return result 
        return $calendar;
    }

    public function namaBulan()
    {
        switch (date('m')) {
            case '01':
                return 'Januari';
                break;
            case '02':
                return 'Pebruari';
                break;
            case '03':
                return 'Maret';
                break;
            case '04':
                return 'April';
                break;
            case '05':
                return 'Mei';
                break;
            case '06':
                return 'Juni';
                break;
            case '07':
                return 'Juli';
                break;
            case '08':
                return 'Agustus';
                break;
            case '09':
                return 'September';
                break;
            case '10':
                return 'Oktober';
                break;
            case '11':
                return 'Nopember';
                break;
            case '12':
                return 'Desember';
                break;
        }
    }


    // Mengecek status harian
    function statusHarian($tanggal)
    {
        $daily = DB::table('daily')->where('id_santri', Auth::user()->id)->where('tanggal', $tanggal)->get();
        
        if (count($daily) > 0) {
            return $daily[0]->status;
        } else {
            return 'kosong';
        }
    }
}
