@extends('layouts.sidebar')

@section('content')
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h1 class="fs-5 mb-4">Ubah password</h1>
    <form action="/users/{{auth()->user()->id}}/updatePassword" class="row gy-2 needs-validation" method="POST" novalidate>
        @csrf
        <div class="col-lg-4">
            <label class="mb-2" for="">Password lama</label>
            <input type="password" name="password_lama" id="" class="form-control" required>
            <div class="invalid-feedback">
                Password lama tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-4">
            <label class="mb-2" for="">Password baru</label>
            <input type="password" name="password" id="" class="form-control" required>
            <div class="invalid-feedback">
                Password baru tidak boleh kosong.
            </div>
        </div>
        <div class="col-lg-4">
            <label class="mb-2" for="">Validasi password baru</label>
            <input type="password" name="password_confirmation" id="" class="form-control" required>
            <div class="invalid-feedback">
                Validasi password baru tidak boleh kosong.
            </div>
        </div>
        <div class="flex-between-center mt-4">
            <a href="/users" class="text-decoration-none fw-semibold" style="color: var(--bs-body-color);"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
            <button class="btn btn-sm btn-primary">Simpan perubahan</button>
        </div>
    </form>
</div>
@endsection