@extends('layouts.sidebar')

@section('content')

<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <h6 class="border-bottom pb-2">Absensi</h6>
    <div class="row mt-4">
        <div class="col-lg-4">
            <div class="rounded shadow p-3 h-100">
                <p class="my-0 text-primary">Nama :</p>
                <h5>{{auth()->user()->name}}</h5>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="rounded shadow p-3 h-100">
                <p class="my-0 text-primary">Jam digital :</p>
                <h5 id="realTimeClock"></h5>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="rounded shadow p-3 h-100">
                <p class="my-0 text-primary">Hari & Tanggal sekarang :</p>
                <h5 id="realTimeDate"></h5>
            </div>
        </div>
    </div>

    @if ($showAbsenMasuk)    
    <div class="p-2 mt-4">
        <p class="mb-0 text-primary">Status absensi :</p>
        <h2>Absen Masuk</h2>
        <p class="my-0 text-success">Silahkan melakukan absensi masuk pada pukul {{$awalMasuk}} - {{$akhirMasuk}} WITA</p>
        <form action="/absensi/store" method="post">
            @csrf
            <button class="btn btn-sm btn-primary mt-2">Absen masuk <i class="fa fa-fw fa-arrow-right"></i></button>
        </form>
    </div>
    @endif

    @if ($showAbsenKeluar)    
    <div class="p-2 mt-4">
        <p class="mb-0 text-primary">Status absensi :</p>
        <h2>Absen Keluar</h2>
        <p class="my-0 text-success">Silahkan melakukan absensi keluar pada pukul {{$awalKeluar}} - {{$akhirKeluar}} WITA</p>
        <form action="/absensi/{{auth()->user()->id}}/update" method="post">
            @csrf
            <button class="btn btn-sm btn-success mt-2">Absen keluar <i class="fa fa-fw fa-arrow-left"></i></button>
        </form>
    </div>
    @endif

    @if (!$showAbsenMasuk && !$showAbsenKeluar)    
        @if (!empty($alasanCheck))
            <div class="p-2 mt-4">
                <p class="mb-0 text-primary">Status absensi :</p>
                <h2 class="text-success">Absensi Selesai</h2>
                <p class="my-0 text-secondary">Absensi <span class="text-primary">masuk</span> pada pukul {{$awalMasuk}} - {{$akhirMasuk}} WITA</p>
                <p class="text-secondary">Dan Absensi <span class="text-danger">keluar</span> pada pukul {{$awalKeluar}} - {{$akhirKeluar}} WITA</p>
                <p class="mb-1 text-success">Terimakasih sudah memberi alasan absensi pada hari ini.</p>
                <a href="/absensi/alasan" class="btn btn-sm btn-success disabled"><i class="fa fa-fw fa-check"></i> Alasan terkirim</a>
            </div>    
        @else
            <div class="p-2 mt-4">
                <p class="mb-0 text-primary">Status absensi :</p>
                <h2>Menunggu</h2>
                <p class="my-0 text-secondary">Absensi <span class="text-primary">masuk</span> pada pukul {{$awalMasuk}} - {{$akhirMasuk}} WITA</p>
                <p class="text-secondary">Dan Absensi <span class="text-danger">keluar</span> pada pukul {{$awalKeluar}} - {{$akhirKeluar}} WITA</p>
                <p class="mb-1 text-success">Jika hari ini anda tidak bekerja, klik tombol dibawah untuk membuat alasan.</p>
                <a href="/absensi/alasan" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-edit"></i> Beri alasan</a>
            </div>
        @endif
    @endif

    <h6 class="mt-4">Tabel riwayat absensi</h6>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="text-nowrap text-center">
                    <th>No</th>
                    <th>Status</th>
                    <th>Hari & Tanggal</th>
                    <th>masuk</th>
                    <th>keluar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absensi as $key => $absen)
                <tr class="text-nowrap text-center">
                    <td>{{$key + 1}}</td>
                    <td class="fw-semibold 
                        {{$absen->status_keluar === 'Hadir' ? 'text-success' : ''}}
                        {{$absen->status_keluar === 'Sakit' ? 'text-warning' : ''}}
                        {{$absen->status_keluar === 'Izin' ? 'text-warning' : ''}}
                    ">{{$absen->status_keluar}}</td>
                    <td>{{$absen->tanggal}}</td>
                    <td>{{$absen->absen_masuk ? $absen->absen_masuk : '-'}}</td>
                    <td>{{$absen->absen_keluar ? $absen->absen_keluar : '-'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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