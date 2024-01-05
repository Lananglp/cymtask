@extends('layouts.sidebar')

@section('content')
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h1 class="fs-5 mb-4">Lengkapi profile</h1>
    <form action="/users/{{auth()->user()->id}}/update" class="row gy-2 needs-validation" method="POST" novalidate>
        @csrf
        <div class="col-lg-6">
            <label class="mb-2" for="">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="" class="form-control" required>
            <div class="invalid-feedback">
                Tempat lahir tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="" class="form-control" required>
            <div class="invalid-feedback">
                Tanggal lahir tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="" class="form-select" required>
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <div class="invalid-feedback">
                Jenis kelamin tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">No Telepon</label>
            <input type="number" name="no_hp" id="" class="form-control" required>
            <div class="invalid-feedback">
                No telepon tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Umur</label>
            <input type="number" name="umur" id="" class="form-control" required>
            <div class="invalid-feedback">
                Umur tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Agama</label>
            <input type="text" name="agama" id="" class="form-control" required>
            <div class="invalid-feedback">
                Agama tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Alamat</label>
            <textarea name="alamat" id="" cols="30" rows="3" class="form-control" required></textarea>
            <div class="invalid-feedback">
                Alamat tidak boleh kosong.
            </div>
        </div>
        <div class="flex-between-center mt-3">
            <a href="/users" class="text-decoration-none fw-semibold" style="color: var(--bs-body-color);"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-sm btn-primary">Simpan perubahan</button>
        </div>
    </form>
</div>
@endsection