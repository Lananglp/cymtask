@extends('layouts.sidebar')

@section('content')
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h6 class="border-bottom pb-3">Detail Tugas</h6>
    <div class="row">
        <div class="col-lg-6 p-4">
            <p class="my-0 text-primary">Judul tugas :</p>
            <h3>{{$tugas->nama_tugas}}</h3>
            <p class="my-0 text-primary">Deskripsi :</p>
            <p>{{$tugas->deskripsi}}</p>
            <p class="my-0 text-primary">Status batas waktu :</p>
            <p class="fw-semibold {{$tugas->tenggat === 1 ? 'text-danger' : 'text-success'}}">{{$tugas->tenggat === 1 ? 'Melewati batas waktu' : 'Belum melewati batas waktu'}}</p>
            <p class="my-0 text-primary">Status tugas :</p>
            <p class="fw-semibold 
                {{$tugas->status === null ? 'text-danger' : ''}}
                {{-- {{$tugas->status === 'progress' ? 'text-dark' : ''}} --}}
                {{$tugas->status === 'selesai' ? 'text-success' : ''}}"
            style="{{$tugas->status === 'progress' ? 'color: var(--bs-emphasis-color);' : ''}}"
            >
                @if ($tugas->status === null)
                    <i class="fa fa-fw fa-clock"></i>
                @endif
                @if ($tugas->status === 'progress')
                    <i class="fa fa-fw fa-spinner fa-spin"></i>
                @endif
                @if ($tugas->status === 'selesai')
                    <i class="fa fa-fw fa-circle-check"></i>
                @endif
                {{$tugas->status !== null ? $tugas->status : 'belum dikerjakan'}}
            </p>
            @if ($tugas->disetujui !== "disetujui")
                @if (auth()->user()->jabatan === 'Admin')
                <p class="mb-2 text-primary">Opsional :</p>
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTugas">
                    <i class="fa fa-fw fa-trash"></i> batalkan tugas ini
                </button>
                @endif
            @endif
        </div>
        <div class="col-lg-6">
            <div class="p-4">
                <p class="mb-2 text-primary">Ditugaskan oleh :</p>
                <h6>{{$tugas->pembuat_tugas}}</h6>
                <p class="mb-2 text-primary">Penanggung jawab :</p>
                <h5>{{$tugas->penanggung_jawab}}</h5>
                <p class="mb-2 text-success">Tanggal dibuat :</p>
                <h6>{{$tugas->created_at}}</h6>
                <p class="mb-2 text-danger">Batas waktu :</p>
                <h6>{{$tugas->batas_waktu}}</h6>
                <p class="my-0 text-primary">Kelompok :</p>
                <ol>
                    @foreach ($tugas->users as $kelompok)
                    <li class="fw-semibold">{{$kelompok->name}}</li>
                    @endforeach
                </ol>
            </div>
        </div>
        <div class="flex-between-center mt-3">
            <a href="/dashboard" class="text-decoration-none fw-semibold" style="color: var(--bs-body-color);"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h6 class="border-bottom pb-3">Tugas report</h6>
    <div class="row g-3 mt-1">
        @if ($progress->count() > 0)
        @foreach ($progress as $report)
        <div class="col-lg-3">
            <div class="border rounded-3 shadow-sm p-3 h-100">
                <p class="mb-2 text-sm">{{$report->created_at}}</p>
                <p class="fw-semibold">{{$report->users->name}}</p>
                <p>{{$report->progress}}</p>
            </div>
        </div>
        @endforeach
        @else
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td class="text-center text-secondary py-5" colspan="100">
                        <i class="fa fa-fw fa-exclamation-circle"></i>
                        <p class="my-0">Tidak ada report tugas saat ini.</p>
                    </td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
</div>
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <div class="row d-flex align-items-center border-bottom pb-3">
        @if ($tugas->disetujui !== "disetujui")
            <form action="/komentar" method="POST" class="col-10">
                @csrf
                <input type="hidden" name="tugas_id" value="{{$tugas->id}}">
                <input type="text" name="komentar" id="" class="form-control form-control-sm shadow-none border-0 fw-semibold" placeholder="Tambahkan komentar . . .">
                <button class="btn btn-sm border-0 shadow-none d-none" type="submit"><i class="fa fa-fw fa-paper-plane"></i></button>
            </form>
        @endif
        <div class="col-2 {{$tugas->disetujui === "disetujui" ? '' : 'text-end'}}">
            <h6 class="my-0">{{$total_komentar}} Komentar</h6>
        </div>
    </div>
    @if ($komentar->count() > 0)
        @foreach ($komentar as $koment)
        <div class="d-flex align-items-start px-3 pt-4 border-bottom">
            <div class="me-3">
                <i class="d-flex justify-content-center text-bg-dark py-2 px-3 rounded-pill align-middle fa fa-fw fa-user"></i>
            </div>
            <div class="d-flex flex-column align-items-ccenter w-100">
                <div class="d-flex justify-content-between align-items-start w-100">
                    <div>
                        <h6 class="my-0">{{$koment->users->name}}</h6>
                        <p class="mb-1 fw-semibold text-sm {{$koment->users->jabatan === "Admin" ? 'text-primary' : 'text-success'}}">{{$koment->users->jabatan === "Admin" ? 'Admin' : 'Karyawan'}}</p>
                    </div>
                    <p class="my-0">{{$koment->created_at}}</p>
                </div>
                <p>{{$koment->komentar}}</p>
            </div>
        </div>
        @endforeach
    @else
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td class="text-center text-secondary py-5" colspan="100">
                    <i class="fa fa-fw fa-exclamation-circle"></i>
                    <p class="my-0">Tidak ada komentar saat ini.</p>
                </td>
            </tr>
        </tbody>
    </table>
    @endif
</div>

<div class="modal fade" id="deleteTugas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Batalkan tugas?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>Apakah kamu yakin membatalkan tugas yang berjudul :</span>
                <h6 class="my-0">{{$tugas->nama_tugas}}</h6>
            </div>
            <div class="modal-footer">
                <form action="/tugas/{{$tugas->id}}/destroy" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">Iya, Batalkan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection