@extends('layouts.sidebar')

@section('content')
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg)">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h6 class="fw-semibold">Tabel Tugas Terlambat</h6>
        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#toggleFilter" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-fw fa-filter"></i> Filter data
        </button>
    </div>

    <div class="collapse mb-4" style="transition: 0.3s ease-in-out" id="toggleFilter">
        <div class="card border-0 card-body">
            <form action="/tugas/tugasTerlambat" method="get">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <label class="mb-2" for="">Dari Tanggal</label>
                        <input type="date" name="tanggalDari" class="form-control" required>
                    </div>
                    <div class="col-lg-6">
                        <label class="mb-2" for="">Sampai Tanggal</label>
                        <input type="date" name="tanggalSampai" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary w-25 mt-3">Filter</button>
            </form>
        </div>
    </div>

    @if ($filterCheck)
        <form>
            <button type="submit" class="btn btn-sm btn-warning w-25 mb-3"><i class="fa fa-fw fa-clock-rotate-left"></i> Reset Filter</button>
        </form>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="text-nowrap text-center">
                    <th>No</th>
                    <th>Nama Tugas</th>
                    <th>Report terbaru</th>
                    <th>Batas waktu</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @if ($tugas->count() > 0)
                    @foreach ($tugas as $key => $tgs)
                    <tr class="align-middle">
                        <td class="text-center">{{$key + 1}}</td>
                        <td>{{$tgs->nama_tugas}}</td>
                        <td>
                            @if ($tgs->progress->count() > 0)
                                <div>
                                    <p class="mb-0 text-sm">{{$tgs->progress->last()->created_at}}</p>
                                    <p class="mb-1 fw-semibold">{{$tgs->progress->last()->users->name}}</p>
                                    <p class="my-0">{{$tgs->progress->last()->progress}}</p>
                                </div>
                            @else
                                <p class="my-0 text-center text-secondary">Tidak ada laporan progress untuk tugas ini.</p>
                            @endif
                        </td>
                        <td class="text-center">{{$tgs->batas_waktu}}</td>
                        <td class="text-center fw-semibold {{$tgs->tenggat === 1 ? 'text-danger' : 'text-success'}}">{{$tgs->tenggat === 1 ? 'Melewati batas waktu' : 'Belum melewati batas waktu'}}</td>
                        <td class="text-center">
                            @if ($tgs->disetujui === null)
                                @if (auth()->user()->jabatan === 'Admin')
                                    @if ($tgs->status === 'selesai')
                                    <form action="/tugas/{{$tgs->id}}/setujui" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary fa-shake my-1"><i class="fa fa-fw fa-thumbs-up"></i></button>
                                    </form>
                                    @endif
                                @endif
                            @else
                            <span class="d-inline-block my-1"><i class="fa fa-fw fa-circle-check fa-xl text-success"></i></span>
                            @endif
                            @if (auth()->user()->jabatan === 'Karyawan')
                            <a class="btn btn-sm btn-success my-1" href="/tugas/{{$tgs->id}}/edit"><i class="fa fa-fw fa-edit"></i></a>
                            @endif
                            <a style="background-color: var(--bs-secondary-color); color: var(--bs-body-bg)" class="btn btn-sm my-1" href="/tugas/{{$tgs->id}}/show"><i class="fa fa-fw fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center text-secondary py-5" colspan="100">
                            <i class="fa fa-fw fa-exclamation-circle"></i>
                            <p class="my-0">Tidak ada tugas yang melewati batas waktu.</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="flex-between-center mt-3">
        <a href="/dashboard" class="text-decoration-none fw-semibold" style="color: var(--bs-body-color);"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
    </div>
</div>
@endsection