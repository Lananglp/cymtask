@extends('layouts.sidebar')

@section('content')

<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h6 class="border-bottom pb-2">Profile</h6>
    <table class="table table-sm table-borderless">
        <tbody>
            <tr>
                <td class="fw-semibold">Nama lengkap</td>
                <td>:</td>
                <td class="w-75">{{auth()->user()->name}}</td>
            </tr>
            <tr>
                <td class="fw-semibold">Jabatan</td>
                <td>:</td>
                <td class="w-75">{{auth()->user()->jabatan}}</td>
            </tr>
            <tr>
                <td class="fw-semibold">Email</td>
                <td>:</td>
                <td class="w-75">{{auth()->user()->email}}</td>
            </tr>
            <tr>
                <td class="fw-semibold">No Telepon</td>
                <td>:</td>
                <td class="w-75">{{auth()->user()->no_hp}}</td>
            </tr>
            <tr>
                <td class="fw-semibold">Jenis Kelamin</td>
                <td>:</td>
                <td class="w-75">{{auth()->user()->jenis_kelamin}}</td>
            </tr>
            <tr>
                <td class="fw-semibold">Tempat Lahir</td>
                <td>:</td>
                <td class="w-75">{{auth()->user()->tempat_lahir}}</td>
            </tr>
            <tr>
                <td class="fw-semibold">Tanggal Lahir</td>
                <td>:</td>
                <td class="w-75">{{auth()->user()->tanggal_lahir}}</td>
            </tr>
            <tr>
                <td class="fw-semibold">Umur</td>
                <td>:</td>
                <td class="w-75">{{auth()->user()->umur}}</td>
            </tr>
            <tr>
                <td class="fw-semibold">Agama</td>
                <td>:</td>
                <td class="w-75">{{auth()->user()->agama}}</td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex align-items-center">
        @if (is_null(auth()->user()->no_hp) || is_null(auth()->user()->jenis_kelamin) || is_null(auth()->user()->tempat_lahir) || is_null(auth()->user()->tanggal_lahir) || is_null(auth()->user()->umur) || is_null(auth()->user()->agama) || is_null(auth()->user()->alamat))
            <a class="btn btn-sm btn-primary me-2 position-relative" href="/users/{{auth()->user()->id}}/edit"><i class="fa fa-fw fa-edit"></i> Lengkapi profile <span class="position-absolute top-0 start-0 translate-middle"><i class="fa fa-fw fa-circle-exclamation text-danger fa-shake fa-lg"></i></span></a>
        @endif
        <a class="btn btn-sm btn-success me-2" href="/users/{{auth()->user()->id}}/editPassword"><i class="fa fa-fw fa-key"></i> Ubah password</a>
    </div>
</div>

@if (auth()->user()->jabatan === "Admin")
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <div class="flex-between-center mb-4 mt-2">
        <h6>Tabel Akun Pengguna</h6>
        <a class="btn btn-sm btn-primary" href="/users/create"><i class="fa fa-fw fa-plus"></i> Tambah akun</a>
    </div>
    <p class="text-sm text-danger">Saat ini hapus data tidak tersedia.</p>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama lengkap</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$user->name}}</td>
                    <td class="text-center {{$user->jabatan === "Admin" ? 'text-primary' : 'text-success'}}">{{$user->jabatan}}</td>
                    <td>{{$user->email}}</td>
                    <td class="text-center">
                        {{-- <form action="/users/{{$user->id}}/destroy" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
                        </form> --}}
                        {{-- <button type="submit" class="btn btn-sm btn-danger" ><i class="fa fa-fw fa-trash"></i></a> --}}
                        <button type="button" class="disabled btn btn-sm btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}"><i class="fa fa-fw fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>  

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Penghapusan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="mb-0">Apakah Anda yakin ingin menghapus akun :</p>
            <p class="mb-0" id="userName"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form id="delete-user" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </form>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('.btn-delete').on('click', function () {
            const userId = $(this).data('id');
            const userName = $(this).data('name');
            console.log(userName);
            // $('#userId').text(userId); // Menampilkan ID pengguna dalam modal
            $('#userName').text(userName);
            const deleteForm = $('#delete-user'); // Form penghapusan
            deleteForm.attr('action', '/users/' + userId + '/destroy'); // Menetapkan URL penghapusan yang sesuai
        });
    });
</script>

@endif
@endsection