@extends('layouts.sidebar')

@section('content')
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h1 class="fs-5 mb-4">Tugas baru</h1>
    <form action="/tugas" class="row gy-2 needs-validation" method="POST" novalidate>
        @csrf
        <div class="col-lg-6">
            <label class="mb-2" for="">Judul tugas</label>
            <input type="text" name="nama_tugas" id="" class="form-control" required>
            <div class="invalid-feedback">
                Judul tugas tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Penanggung jawab</label>
            <select name="penanggung_jawab" id="" class="form-select" required>
                <option value="">Pilih</option>
                <option value="Staff">Staff</option>
                <option value="Asisten">Asisten</option>
                <option value="Spesialis">Spesialis</option>
                <option value="Koordinator">Koordinator</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Manajer">Manajer</option>
                <option value="Wakil Direktur">Wakil Direktur</option>
                <option value="Direktur">Direktur</option>
                <option value="CEO">CEO</option>
            </select>
            <div class="invalid-feedback">
                Penanggung jawab tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Deskripsi</label>
            <textarea name="deskripsi" id="" cols="30" rows="3" class="form-control" required></textarea>
            <div class="invalid-feedback">
                Deskripsi tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Kelompok <span class="text-sm text-success">gunakan <span class="text-primary">Ctrl</span> + <span class="text-primary">Click</span> untuk memilih lebih dari 1</span></label>
            <select name="kelompok[]" id="" class="form-select" multiple required>
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Kelompok minimal terdiri dari 1 orang.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Batas waktu</label>
            <input type="datetime-local" min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" name="batas_waktu" id="" class="form-control" required>
            <div class="invalid-feedback">
                Batas waktu tidak boleh kosong.
            </div>
        </div>
        <div class="flex-between-center mt-3">
            <a href="/dashboard" class="text-decoration-none fw-semibold" style="color: var(--bs-body-color);"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
            <button class="btn btn-sm btn-primary">Simpan tugas</button>
        </div>
    </form>
</div>
@endsection