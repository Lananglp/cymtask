@extends('layouts.sidebar')

@section('content')

<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h6 class="border-bottom pb-2">Absensi</h6>
    <div class="row mt-4">
        <div class="col-lg-4 mb-2">
            <div class="rounded shadow p-3 h-100">
                <p class="my-0 text-primary">Nama :</p>
                <h5>{{auth()->user()->name}}</h5>
            </div>
        </div>
        <div class="col-lg-4 mb-2">
            <div class="rounded shadow p-3 h-100">
                <p class="my-0 text-primary">Jam digital :</p>
                <h5 id="realTimeClock"></h5>
            </div>
        </div>
        <div class="col-lg-4 mb-2">
            <div class="rounded shadow p-3 h-100">
                <p class="my-0 text-primary">Hari & Tanggal sekarang :</p>
                <h5 id="realTimeDate"></h5>
            </div>
        </div>
    </div>

    <form action="/absensi/setWaktu" class="row mt-4" method="post">
        @csrf
        <div class="col-lg-3 mb-2">
            <div>
                <label class="mb-2 text-primary">Awal Waktu Masuk :</label>
                <input type="time" value="{{ $waktu_absensi->awalMasuk ? $waktu_absensi->awalMasuk : '' }}" name="awalMasuk" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <div>
                <label class="mb-2 text-danger">Akhir Waktu Masuk :</label>
                <input type="time" value="{{ $waktu_absensi->akhirMasuk ? $waktu_absensi->akhirMasuk : '' }}" name="akhirMasuk" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <div>
                <label class="mb-2 text-primary">Awal Waktu Keluar :</label>
                <input type="time" value="{{ $waktu_absensi->awalKeluar ? $waktu_absensi->awalKeluar : '' }}" name="awalKeluar" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <div>
                <label class="mb-2 text-danger">Akhir Waktu Keluar :</label>
                <input type="time" value="{{ $waktu_absensi->akhirKeluar ? $waktu_absensi->akhirKeluar : '' }}" name="akhirKeluar" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <button type="submit" class="btn btn-sm btn-primary mt-2">Simpan perubahan</button>
        </div>
    </form>
</div>

<script>
    function updateClock() {
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();
        
        // Tambahkan nol di depan jika angka < 10
        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;
        
        var timeString = hours + ":" + minutes + ":" + seconds;
        document.getElementById("realTimeClock").innerText = timeString;
    }
    
    // Update setiap 1 detik
    setInterval(updateClock, 1000);

    function updateDate() {
        // var currentDate = new Date();
        // var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        // var dayName = days[currentDate.getDay()];
        // var dateString = dayName + ', ' + currentDate.toLocaleDateString();
        // document.getElementById("realTimeDate").innerText = dateString;

        var currentDate = new Date();
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        var dateString = currentDate.toLocaleDateString('id-ID', options);

        document.getElementById("realTimeDate").innerText = dateString;
    }

    // Update setiap 1 detik
    setInterval(updateDate, 1000);
    </script>
@endsection