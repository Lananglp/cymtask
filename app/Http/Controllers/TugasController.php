<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Tugas;
use App\Models\User;
use App\Models\Komentar;
use App\Models\Progress;
use App\Models\Tugasconfig;

use Carbon\Carbon;

class TugasController extends Controller
{
    public function dashboard(Request $request)
    {
        Tugas::where('batas_waktu', '<', Carbon::now())->where('tenggat', false)->update(['tenggat' => true]);
        $tugasConfig = Tugasconfig::find(1);

        if (Auth()->user()->jabatan === "Karyawan") {
            $user = Auth::user();
            $tugas = $user->tugas->whereNull('disetujui')->sortByDesc('created_at');
            $progress_tugas = $tugas->where('status', 'progress')->count();
            $tugas_terlambat = $tugas->where('tenggat', true)->count();
            $tugas_selesai = $tugas->where('status', 'selesai')->count();
            $history = $user->tugas->whereNotNull('disetujui')->sortByDesc('created_at');
            $tugasNotif = $user->tugas->whereNull('disetujui')->sortByDesc('created_at')->take(10);
            // $tugas_baru = $tugas->where('tanggal', Carbon::today()->format('Y-m-d'))->where('tenggat', false)->take(1);
        } else {
            
            if (!$tugasConfig->filter_tugas_admin) {
                // jabatan admin tidak bisa melihat tugas admin lainnya
                $admin_id = auth()->user()->id;
                $tugas = Tugas::whereNull('disetujui')->where('admin_id', $admin_id)->latest()->get();
                $progress_tugas = Tugas::whereNull('disetujui')->where('admin_id', $admin_id)->where('status', 'progress')->count();
                $tugas_terlambat = Tugas::whereNull('disetujui')->where('admin_id', $admin_id)->where('tenggat', true)->count();
                $tugas_selesai = Tugas::whereNull('disetujui')->where('admin_id', $admin_id)->where('status', 'selesai')->count();
                $history = Tugas::whereNotNull('disetujui')->where('admin_id', $admin_id)->latest()->get();
                $tugasNotif = Tugas::whereNull('disetujui')->where('admin_id', $admin_id)->latest()->limit(10)->get();
            } else {
                // jabatan admin bisa melihat tugas admin lainnya
                $tugas = Tugas::whereNull('disetujui')->latest()->get();
                $progress_tugas = Tugas::whereNull('disetujui')->where('status', 'progress')->count();
                $tugas_terlambat = Tugas::whereNull('disetujui')->where('tenggat', true)->count();
                $tugas_selesai = Tugas::whereNull('disetujui')->where('status', 'selesai')->count();
                $history = Tugas::whereNotNull('disetujui')->latest()->get();
                $tugasNotif = Tugas::whereNull('disetujui')->latest()->limit(10)->get();
                // $tugas_baru = $history; // kalau bisa dibuat null
            }
        }

        $pengunjungWeb = Cache::get('total_pengunjung');

        return view('dashboard', compact('tugas', 'progress_tugas', 'tugas_terlambat', 'tugas_selesai', 'history', 'tugasNotif', 'tugasConfig', 'pengunjungWeb'));
    }
    public function show($id)
    {
        $tugas = Tugas::find($id);
        $komentar = Komentar::where('tugas_id', $id)->latest()->get();
        $total_komentar = Komentar::where('tugas_id', $id)->count();
        $progress = Progress::where('tugas_id', $id)->latest()->get();

        return view('tugas.show', compact('tugas', 'komentar', 'total_komentar', 'progress'));
    }

    public function create()
    {
        $users = User::where('jabatan', 'Karyawan')->get();

        $realtimeTugasForm = session('realtimeTugasForm');

        return view('tugas.create', compact('users', 'realtimeTugasForm'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tugas' => ['required'],
            'penanggung_jawab' => ['required'],
            'deskripsi' => ['required'],
            'kelompok' => ['required'],
            'batas_waktu' => ['required'],
        ]);

        $tugas = new Tugas;
        $tugas->admin_id = auth()->user()->id;
        $tugas->pembuat_tugas = auth()->user()->name;
        $tugas->nama_tugas = $request->input('nama_tugas');
        $tugas->penanggung_jawab = $request->input('penanggung_jawab');
        $tugas->deskripsi = $request->input('deskripsi');
        $tugas->batas_waktu = $request->input('batas_waktu');
        $tugas->tanggal = Carbon::today();
        $tugas->save();
        $tugas->users()->sync($request->input('kelompok'));
        $tugas->save();

        return redirect('/dashboard')->with('success', 'tugas baru berhasil ditambah!');
    }

    public function komentar(Request $request)
    {
        $request->validate([
            'komentar' => ['required'],
        ]);

        $komentar = new Komentar;
        $komentar->user_id = auth()->user()->id;
        $komentar->tugas_id = $request->input('tugas_id');
        $komentar->komentar = $request->input('komentar');
        $komentar->save();

        return redirect()->back()->with('success', 'Komentar ditambahkan.');
    }

    public function destroy($id)
    {
        $tugas = Tugas::find($id);
        $tugas->delete();

        return redirect('/dashboard')->with('warning', 'Anda telah membatalkan tugas.');
    }

    public function edit($id, Request $request)
    {
        $tugas = Tugas::find($id);

        return view('tugas.edit', compact('tugas'));
    }

    public function update($id, Request $request)
    {
        if ($request->input('progress') !== null) {
            $report = new Progress;
            $report->user_id = auth()->user()->id;
            $report->tugas_id = $id;
            $report->progress = $request->input('progress');
            $report->save();
        }

        $tugas = Tugas::find($id);
        if ($request->input('status') === "selesai") {
            $tugas->status = $request->input('status');
        }
        if ($request->input('status') === "progress") {
            $tugas->status = $request->input('status');
        }
        if ($request->input('status') === null) {
            $tugas->status = 'progress';
        }
        $tugas->save();   

        return redirect('/dashboard')->with('success', 'Report tugas berhasil.');
    }

    public function setujui($id, Request $request)
    {
        $tugas = Tugas::find($id);
        $tugas->disetujui = 'disetujui';
        $tugas->save();

        return redirect()->back()->with('success', 'Menyetujui tugas berhasil.');
    }

    public function tugasAll(Request $request)
    {
        $users = Auth::user();

        $tanggalDari = $request->input('tanggalDari');
        $tanggalSampai = $request->input('tanggalSampai');
        $filterCheck = !empty($tanggalDari) || !empty($tanggalSampai);

        if ($filterCheck) {

            if ($users->jabatan === "Karyawan") {
                $tugas = $users->tugas->whereBetween('tanggal', [$tanggalDari, $tanggalSampai])->whereNull('disetujui')->sortByDesc('created_at');
            }
            if ($users->jabatan === "Admin") {
                $tugas = Tugas::whereBetween('tanggal', [$tanggalDari, $tanggalSampai])->whereNull('disetujui')->latest()->get();
            }
        } else {

            if ($users->jabatan === "Karyawan") {
                $tugas = $users->tugas->whereNull('disetujui')->sortByDesc('created_at');
            }
            if ($users->jabatan === "Admin") {
                $tugas = Tugas::whereNull('disetujui')->latest()->get();
            }
        }

        return view('tugas.tugasAll', compact('tugas', 'filterCheck'));
    }

    public function tugasProgress(Request $request)
    {
        $users = Auth::user();
        
        $tanggalDari = $request->input('tanggalDari');
        $tanggalSampai = $request->input('tanggalSampai');
        $filterCheck = !empty($tanggalDari) || !empty($tanggalSampai);
        
        if ($filterCheck) {
            if ($users->jabatan === "Karyawan") {
                $tugas = $users->tugas->whereBetween('tanggal', [$tanggalDari, $tanggalSampai])->whereNull('disetujui')->where('status', 'progress')->sortByDesc('created_at');
            }
            if ($users->jabatan === "Admin") {
                $tugas = Tugas::whereBetween('tanggal', [$tanggalDari, $tanggalSampai])->whereNull('disetujui')->where('status', 'progress')->latest()->get();
            }
        } else {
            if ($users->jabatan === "Karyawan") {
                $tugas = $users->tugas->whereNull('disetujui')->where('status', 'progress')->sortByDesc('created_at');
            }
            if ($users->jabatan === "Admin") {
                $tugas = Tugas::whereNull('disetujui')->where('status', 'progress')->latest()->get();
            }
        }
        

        return view('tugas.tugasProgress', compact('tugas', 'filterCheck'));
    }

    public function tugasTerlambat(Request $request)
    {
        $users = Auth::user();

        $tanggalDari = $request->input('tanggalDari');
        $tanggalSampai = $request->input('tanggalSampai');
        $filterCheck = !empty($tanggalDari) || !empty($tanggalSampai);
        
        if ($filterCheck) {
            if ($users->jabatan === "Karyawan") {
                $tugas = $users->tugas->whereBetween('tanggal', [$tanggalDari, $tanggalSampai])->whereNull('disetujui')->where('tenggat', true)->sortByDesc('created_at');
            }
            if ($users->jabatan === "Admin") {
                $tugas = Tugas::whereBetween('tanggal', [$tanggalDari, $tanggalSampai])->whereNull('disetujui')->where('tenggat', true)->latest()->get();
            }
        } else {
            if ($users->jabatan === "Karyawan") {
                $tugas = $users->tugas->whereNull('disetujui')->where('tenggat', true)->sortByDesc('created_at');
            }
            if ($users->jabatan === "Admin") {
                $tugas = Tugas::whereNull('disetujui')->where('tenggat', true)->latest()->get();
            }
        }
        

        return view('tugas.tugasTerlambat', compact('tugas', 'filterCheck'));
    }

    public function tugasSelesai(Request $request)
    {
        $users = Auth::user();

        $tanggalDari = $request->input('tanggalDari');
        $tanggalSampai = $request->input('tanggalSampai');
        $filterCheck = !empty($tanggalDari) || !empty($tanggalSampai);

        if ($filterCheck) {
            if ($users->jabatan === "Karyawan") {
                $tugas = $users->tugas->whereBetween('tanggal', [$tanggalDari, $tanggalSampai])->whereNull('disetujui')->where('status', 'selesai')->sortByDesc('created_at');
            }
            if ($users->jabatan === "Admin") {
                $tugas = Tugas::whereBetween('tanggal', [$tanggalDari, $tanggalSampai])->whereNull('disetujui')->where('status', 'selesai')->latest()->get();
            }
        } else {
            if ($users->jabatan === "Karyawan") {
                $tugas = $users->tugas->whereNull('disetujui')->where('status', 'selesai')->sortByDesc('created_at');
            }
            if ($users->jabatan === "Admin") {
                $tugas = Tugas::whereNull('disetujui')->where('status', 'selesai')->latest()->get();
            }
        }
        

        return view('tugas.tugasSelesai', compact('tugas', 'filterCheck'));
    }

    public function tugasConfig(Request $request)
    {
        $tugasConfig = Tugasconfig::find(1);
        $tugasConfig->filter_tugas_admin = $request->input('filter_tugas_admin');
        $tugasConfig->save();

        return redirect()->back()->with('success', 'Pengaturan tugas berhasil diubah.');
    }
}
