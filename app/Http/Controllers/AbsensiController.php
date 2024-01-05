<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Waktu_absensi;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $login_id = auth()->user()->id;
        $users = auth()->user();
        $hari_sekarang = Carbon::today();
        $waktu_sekarang = Carbon::now();
        $absensi = $users->absensi()->where('user_id', $login_id)->latest()->get();
        foreach ($absensi as $absen) {
            if ($absen->absen_masuk !== null) {
                $absen->absen_masuk = Carbon::parse($absen->absen_masuk)->isoFormat('H:mm:ss');
            }
            if ($absen->absen_keluar !== null) {
                $absen->absen_keluar = Carbon::parse($absen->absen_keluar)->isoFormat('H:mm:ss');
            }
            $absen->tanggal = Carbon::parse($absen->tanggal)->isoFormat('dddd, D MMMM YYYY');
        }

        $waktu_absensi = Waktu_absensi::latest()->first();
        
        if ($waktu_absensi) {
            $jamAwalMasuk = Carbon::parse($waktu_absensi->awalMasuk)->hour;
            $menitAwalMasuk = Carbon::parse($waktu_absensi->awalMasuk)->minute;

            $jamAkhirMasuk = Carbon::parse($waktu_absensi->akhirMasuk)->hour;
            $menitAkhirMasuk = Carbon::parse($waktu_absensi->akhirMasuk)->minute;

            $jamAwalKeluar = Carbon::parse($waktu_absensi->awalKeluar)->hour;
            $menitAwalKeluar = Carbon::parse($waktu_absensi->awalKeluar)->minute;
            
            $jamAkhirKeluar = Carbon::parse($waktu_absensi->akhirKeluar)->hour;
            $menitAkhirKeluar = Carbon::parse($waktu_absensi->akhirKeluar)->minute;
        }

        $batasAwalMasuk = $waktu_sekarang->copy()->setHour($jamAwalMasuk)->setMinute($menitAwalMasuk);
        $batasAkhirMasuk = $waktu_sekarang->copy()->setHour($jamAkhirMasuk)->setMinute($menitAkhirMasuk);
        $showAbsenMasuk = $waktu_sekarang->greaterThanOrEqualTo($batasAwalMasuk) && $waktu_sekarang->lessThanOrEqualTo($batasAkhirMasuk);

        $batasAwalKeluar = $waktu_sekarang->copy()->setHour($jamAwalKeluar)->setMinute($menitAwalKeluar);
        $batasAkhirKeluar = $waktu_sekarang->copy()->setHour($jamAkhirKeluar)->setMinute($menitAkhirKeluar);
        $showAbsenKeluar = $waktu_sekarang->greaterThanOrEqualTo($batasAwalKeluar) && $waktu_sekarang->lessThanOrEqualTo($batasAkhirKeluar);

        $alasanCheck = $users->absensi()->where('user_id', $login_id)->where('tanggal', Carbon::today()->format('Y-m-d'))->latest()->first();

        $awalMasuk = $batasAwalMasuk->format('h:m');
        $akhirMasuk = $batasAkhirMasuk->format('h:m');
        $awalKeluar = $batasAwalKeluar->format('h:m');
        $akhirKeluar = $batasAkhirKeluar->format('h:m');

        return view('absensi.index', compact('absensi', 'hari_sekarang', 'awalMasuk', 'akhirMasuk', 'awalKeluar', 'akhirKeluar', 'showAbsenMasuk', 'showAbsenKeluar', 'alasanCheck'));
    }

    public function store(Request $request)
    {
        $login_id = auth()->user()->id;
        $user = auth()->user();
        $hari_sekarang = Carbon::today();
        $absenMasukCheck = $user->absensi()->where('user_id', $login_id)->whereDate('tanggal', $hari_sekarang)->first();

        if ($absenMasukCheck) {
            return redirect()->back()->with('warning', 'Kamu sudah melakukan absen masuk pada hari ini.');
        }

        $absensi = new Absensi;
        $absensi->user_id = $login_id;
        $absensi->absen_masuk = Carbon::now();
        $absensi->status_masuk = "Hadir";
        $absensi->tanggal = Carbon::now();
        $absensi->save();

        return redirect()->back()->with('success', 'Berhasil absen masuk.');
    }

    public function update($id, Request $request)
    {
        $hari_sekarang = carbon::today();
        $absen_keluar = carbon::now();
        $user_login = auth()->user();
        $login_id = auth()->user()->id;
        $absenKeluarCheck = $user_login->absensi()->where('user_id', $login_id)->whereNotNull('absen_keluar')->whereDate('absen_masuk', $hari_sekarang)->first();

        if ($absenKeluarCheck) {
            return redirect()->back()->with('warning', 'Kamu sudah melakukan absen keluar pada hari ini.');
        }

        $users = User::find($id);
        $users->absensi()->where('absen_masuk', $hari_sekarang)->first();
        $users->absensi()->update([
            'absen_keluar' => $absen_keluar, 
            'status_keluar' => 'Hadir',
            'tanggal' => $absen_keluar,
        ]);

        return redirect()->back()->with('success', 'Berhasil absen keluar.');
    }

    public function alasan()
    {
        return view('absensi.alasan');
    }

    public function reportAlasan(Request $request)
    {
        $login_id = auth()->user()->id;
        $absensi = new Absensi;
        $absensi->user_id = $login_id;
        $absensi->keterangan = $request->input('keterangan');
        $absensi->status_masuk = $request->input('status');
        $absensi->status_keluar = $request->input('status');
        $absensi->tanggal = Carbon::now();
        $absensi->save();

        return redirect('/absensi')->with('success', 'Laporan absensi berhasil.');
    }

    public function aturAbsensi()
    {
        $waktu_absensi = Waktu_absensi::latest()->first();

        return view('absensi.pengaturan', compact('waktu_absensi'));
    }

    public function setWaktu(Request $request) 
    {
        $request->validate([
            'awalMasuk' => 'required',
            'akhirMasuk' => 'required',
            'awalKeluar' => 'required',
            'akhirKeluar' => 'required',
            // 'batasAbsensi' => 'required',
        ]);

        $waktu_absensi = Waktu_absensi::latest()->first();
        $waktu_absensi->awalMasuk = $request->input('awalMasuk');
        $waktu_absensi->akhirMasuk = $request->input('akhirMasuk');
        $waktu_absensi->awalKeluar = $request->input('awalKeluar');
        $waktu_absensi->akhirKeluar = $request->input('akhirKeluar');
        // $waktu_absensi->batasAbsensi = $request->input('batasAbsensi');
        $waktu_absensi->save();


        return redirect()->back()->with('success', 'Berhasil ubah pengaturan absensi.');
    }

    public function rekapAbsensi()
    {
        $users = User::all();

        return view('absensi.rekapAbsensi', compact('users'));
    }

    public function show($id)
    {
        $users = User::find($id);
        $absensi = $users->absensi->sortByDesc('created_at');

        foreach ($absensi as $absen) {
            if ($absen->absen_masuk !== null) {
                $absen->absen_masuk = Carbon::parse($absen->absen_masuk)->isoFormat('H:mm:ss');
            }
            if ($absen->absen_keluar !== null) {
                $absen->absen_keluar = Carbon::parse($absen->absen_keluar)->isoFormat('H:mm:ss');
            }
            $absen->tanggal = Carbon::parse($absen->tanggal)->isoFormat('dddd, D MMMM YYYY');
        }

        return view('absensi.show', compact('users', 'absensi'));
    }
}
