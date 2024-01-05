@extends('layouts.sidebar')

@section('content')
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h1 class="fs-5 mb-4">Akun baru</h1>
    <form action="/users" class="row gy-2 needs-validation" method="POST" novalidate>
        @csrf
        <div class="col-lg-6">
            <label class="mb-2" for="">Nama lengkap</label>
            <input type="text" name="name" id="" class="form-control" required>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Jabatan</label>
            <select name="jabatan" id="" class="form-select" required>
                <option value="">Pilih</option>
                <option value="Karyawan">Karyawan</option>
                <option value="Admin">Admin</option>
            </select>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Email</label>
            <input type="email" name="email" id="" class="form-control" required>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Password</label>
            <input type="password" name="password_confirmation" id="" class="form-control" required>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Validate Password</label>
            <input type="password" name="password" id="" class="form-control" required>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>
        <div class="flex-between-center mt-3">
            <a href="/users" class="text-decoration-none fw-semibold" style="color: var(--bs-body-color);"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
            <button class="btn btn-sm btn-primary">Buat akun</button>
        </div>
    </form>
</div>
@endsection