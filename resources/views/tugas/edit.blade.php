@extends('layouts.sidebar')

@section('content')
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h6 class="border-bottom pb-3">Report tugas</h6>
    <div class="row">
        <div class="col-lg-6 p-4">
            <p class="my-0 text-primary">Judul tugas :</p>
            <h3>{{$tugas->nama_tugas}}</h3>
            <p class="my-0 text-primary">Deskripsi :</p>
            <p>{{$tugas->deskripsi}}</p>
        </div>
        <div class="col-lg-6">
            <div class="p-4">
                <p class="mb-2 text-primary">Penanggung jawab :</p>
                <h5>{{$tugas->penanggung_jawab}}</h5>
                <p class="my-0 text-primary">Kelompok :</p>
                <ol>
                    @foreach ($tugas->users as $kelompok)
                    <li class="fw-semibold">{{$kelompok->name}}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h6 class="border-bottom pb-3">Form report tugas</h6>
    <form action="/tugas/{{$tugas->id}}/update" class="row gy-2 mt-3" method="POST">
        @csrf
        <div class="col-lg-6">
            <label class="mb-2" for="">Report</label>
            <textarea name="progress" id="" cols="30" rows="3" class="form-control"></textarea>
        </div>
        <div class="col-lg-6">
            <label class="mb-2" for="">Opsional</label>
            <div>
                <div>
                    <input type="radio" name="status" value="progress" id="inputStatus1" {{$tugas->status === 'progress' ? 'checked' : ''}}>
                    <label for="inputStatus1">Tandai belum selesai</label>
                </div>
                    <div>
                        <input type="radio" name="status" value="selesai" id="inputStatus2" {{$tugas->status === 'selesai' ? 'checked' : ''}}>
                        <label for="inputStatus2">Tandai selesai</label>
                    </div>
            </div>
        </div>
        <div class="flex-between-center mt-3">
            <a href="/dashboard" class="text-decoration-none fw-semibold" style="color: var(--bs-body-color);"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
            <button class="btn btn-sm btn-primary">Report tugas</button>
        </div>
    </form>
</div>
@endsection