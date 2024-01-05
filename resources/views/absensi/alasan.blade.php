@extends('layouts.sidebar')

@section('content')
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h1 class="fs-5 mb-4">Alasan absensi</h1>
    <form action="/absensi/reportAlasan" class="row gy-2 needs-validation" method="POST" novalidate>
        @csrf
        <div class="col-lg-6">
            <label class="mb-2" for="">Keterangan</label>
            <textarea name="keterangan" id="" cols="30" rows="3" class="form-control" required></textarea>
            <div class="invalid-feedback">
                Keterangan tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Status</label>
            <select name="status" id="" class="form-select" required>
                <option value="">Pilih</option>
                <option value="Sakit">Sakit</option>
                <option value="Izin">Izin</option>
            </select>
            <div class="invalid-feedback">
                Status tidak boleh kosong.
            </div>
        </div>
        <div class="flex-between-center mt-4">
            <a href="/absensi" class="text-decoration-none fw-semibold" style="color: var(--bs-body-color);"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
            <button class="btn btn-sm btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection