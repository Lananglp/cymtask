@extends('layouts.sidebar')

@section('content')

{{-- <div class="mt-4">
    <p class="mb-0">Total Pengguna mengakses setiap halaman : {{$pengunjungWeb}} Kali</p>
</div> --}}

<div class="row gy-4 mt-0">
    <div class="col-lg-6 mx-0 px-0 row gy-4 mt-0">
        <div class="col-6">
            <div class="position-relative card-hover flex-between-center shadow border-bottom border-4 rounded-3 p-3" style="background-color: var(--bs-body-bg); border-color: var(--bs-emphasis-color) !important;">
                <div>
                    <h6 class="fw-semibold">Semua Data Tugas</h6>
                    <a href="/tugas/tugasAll" class="my-0 stretched-link text-decoration-none" style="color: var(--bs-body-color)">{{$tugas->count()}} Tugas</a>
                </div>
                <i class="mobile-d-none fa fa-fw fa-calendar fa-xl"></i>
            </div>
        </div>
        <div class="col-6">
            <div class="position-relative card-hover flex-between-center text-primary shadow border-bottom border-4 border-primary rounded-3 p-3" style="background-color: var(--bs-body-bg)">
                <div>
                    <h6 class="fw-semibold">Tugas Sedang Proses</h6>
                    <a href="/tugas/tugasProgress" class="my-0 stretched-link text-decoration-none text-primary">{{$progress_tugas}} Tugas</a>
                </div>
                <i class="mobile-d-none fa fa-fw fa-clock-rotate-left fa-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 mx-0 px-0 row gy-4 mt-0">
        <div class="col-6">
            <div class="position-relative card-hover flex-between-center text-danger shadow border-bottom border-4 border-danger rounded-3 p-3" style="background-color: var(--bs-body-bg)">
                <div>
                    <h6 class="fw-semibold">Tugas Lewat Batas Waktu</h6>
                    <a href="/tugas/tugasTerlambat" class="my-0 stretched-link text-decoration-none text-danger">{{$tugas_terlambat}} Tugas</a>
                </div>
                <i class="mobile-d-none fa fa-fw fa-calendar-xmark fa-xl"></i>
            </div>
        </div>
        <div class="col-6">
            <div class="position-relative card-hover flex-between-center text-success shadow border-bottom border-4 border-success rounded-3 p-3" style="background-color: var(--bs-body-bg)">
                <div>
                    <h6 class="fw-semibold">Tugas Diselesaikan</h6>
                    <a href="/tugas/tugasSelesai" class="my-0 stretched-link text-decoration-none text-success">{{$tugas_selesai}} Tugas</a>
                </div>
                <i class="mobile-d-none fa fa-fw fa-check fa-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="row gy-4 mt-0">
    <div class="mobile-d-none col-lg-4">
        <div class="flex-between-center text-success shadow border-bottom border-4 border-primary rounded-3 p-3" style="background-color: var(--bs-body-bg)">
            <canvas id="tugasBerproses"></canvas>
        </div>
    </div>
    <div class="mobile-d-none col-lg-4">
        <div class="flex-between-center text-success shadow border-bottom border-4 border-danger rounded-3 p-3" style="background-color: var(--bs-body-bg)">
            <canvas id="tugasTerlambat"></canvas>
        </div>
    </div>
    <div class="mobile-d-none col-lg-4">
        <div class="flex-between-center text-success shadow border-bottom border-4 border-success rounded-3 p-3" style="background-color: var(--bs-body-bg)">
            <canvas id="tugasSelesai"></canvas>
        </div>
    </div>
</div>

<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg)">
    <div class="flex-wrap flex-between-center mb-4">
        <h6 class="mb-0 mt-2">Tabel Tugas</h6>
        @if (auth()->user()->jabatan === "Admin")
            <div>
                <button type="button" class="btn btn-sm btn-dark border-0 mt-2 me-1" data-bs-toggle="modal" data-bs-target="#pengaturanTugas"><i class="fa fa-fw fa-cog"></i> Pengaturan Tugas</button>
                <a class="btn btn-sm btn-primary mt-2" href="/tugas/create"><i class="fa fa-fw fa-plus"></i> Buat Tugas Baru</a>
            </div>
        @endif
        @if (auth()->user()->jabatan === "Karyawan")
            <button type="button" class="btn btn-sm btn-primary border-0 mt-2" data-bs-toggle="modal" data-bs-target="#modalNewTaskToday">
                <i class="fa fa-fw fa-bell fa-shake"></i> Notifikasi
                <span class="badge bg-danger">{{$tugasNotif->count()}}</span>
            </button>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="text-nowrap text-center">
                    <th class="fw-semibold">No</th>
                    <th class="fw-semibold">Judul</th>
                    <th class="fw-semibold">Laporan</th>
                    <th class="fw-semibold">Batas Waktu</th>
                    <th class="fw-semibold">Status</th>
                    <th class="fw-semibold">Detail</th>
                </tr>
            </thead>
            <tbody>
                @if ($tugas->count() > 0)
                    @foreach ($tugas as $tgs)
                    <tr class="align-middle">
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$tgs->nama_tugas}}</td>
                        <td>
                            @if ($tgs->progress->count() > 0)
                                <div>
                                    <p class="mb-0 text-sm">{{$tgs->progress->last()->created_at}}</p>
                                    <p class="mb-1 fw-semibold">{{$tgs->progress->last()->users->name}}</p>
                                    <p class="my-0">{{$tgs->progress->last()->progress}}</p>
                                </div>
                            @else
                                <p class="my-0 text-center text-secondary">There is no progress report for this project.</p>
                            @endif
                        </td>
                        <td class="text-center">{{$tgs->batas_waktu}}</td>
                        <td class="text-center fw-semibold {{$tgs->tenggat === 1 ? 'text-danger' : 'text-success'}}">{{$tgs->tenggat === 1 ? 'Terlambat' : 'Belum Terlambat'}}</td>
                        <td class="text-center">
                            @if ($tgs->disetujui === null)
                                @if (auth()->user()->jabatan === 'Admin')
                                    @if ($tgs->status === 'selesai')
                                    <button id="setujuiForm" data-id="{{$tgs->id}}" data-judul="{{$tgs->nama_tugas}}" type="button" class="btn btn-sm btn-primary fa-shake my-1" data-bs-toggle="modal" data-bs-target="#setujuiModal"><i class="fa fa-fw fa-thumbs-up"></i></button>
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
                            <p class="my-0">There are no assignments at this time.</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg)">
    <div class="flex-between-center mb-4 mt-2">
        <h6>Task history table</h6>
        {{-- <button class="btn btn-sm btn-danger" href="/tugas/create"><i class="fa fa-fw fa-trash"></i> Clear history</button> --}}
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center text-nowrap">
                    <th>No</th>
                    <th>Project Name</th>
                    <th>Total Report</th>
                    <th>Done</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @if ($history->count() > 0)
                    @foreach ($history as $tgs)
                    <tr class="align-middle">
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="w-50">{{$tgs->nama_tugas}}</td>
                        <td class="text-center">{{$tgs->progress->count()}} kali report</td>
                        <td class="text-center">{{$tgs->updated_at}}</td>
                        <td class="text-center">
                            @if ($tgs->disetujui !== "disetujui")
                                @if (auth()->user()->jabatan === 'Karyawan')
                                <a class="btn btn-sm btn-success my-1" href="/tugas/{{$tgs->id}}/edit"><i class="fa fa-fw fa-edit"></i></a>
                                @endif
                            @endif
                            <a style="background-color: var(--bs-secondary-color); color: var(--bs-body-bg)" class="btn btn-sm my-1" href="/tugas/{{$tgs->id}}/show"><i class="fa fa-fw fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center text-secondary py-5" colspan="100">
                            <i class="fa fa-fw fa-exclamation-circle"></i>
                            <p class="my-0">There is no history at this time.</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="modal modal-lg fade" id="modalNewTaskToday" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Notifikasi Tugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    @if ($tugasNotif->count() > 0)
                        <!-- @foreach ($tugasNotif as $key => $tgs)
                        <p class="my-0 text-primary">Judul tugas :</p>
                        <h5>{{$tgs->nama_tugas}}</h5>
                        <p class="my-0 text-primary">Deskripsi :</p>
                        <p>{{$tgs->deskripsi}}</p>
                        <p class="my-0 text-primary">Status batas waktu :</p>
                        <p class="fw-semibold {{$tgs->tenggat === 1 ? 'text-danger' : 'text-success'}}">{{$tgs->tenggat === 1 ? 'Melewati batas waktu' : 'Belum melewati batas waktu'}}</p>
                        <p class="my-0 text-primary">Status tugas :</p>
                        <p class="fw-semibold 
                            {{$tgs->status === null ? 'text-danger' : ''}}
                            {{-- {{$tgs->status === 'progress' ? 'text-dark' : ''}} --}}
                            {{$tgs->status === 'selesai' ? 'text-success' : ''}}"
                        style="{{$tgs->status === 'progress' ? 'color: var(--bs-emphasis-color);' : ''}}"
                        >
                            @if ($tgs->status === null)
                                <i class="fa fa-fw fa-clock"></i>
                            @endif
                            @if ($tgs->status === 'progress')
                                <i class="fa fa-fw fa-spinner fa-spin"></i>
                            @endif
                            @if ($tgs->status === 'selesai')
                                <i class="fa fa-fw fa-circle-check"></i>
                            @endif
                            {{$tgs->status !== null ? $tgs->status : 'belum dikerjakan'}}
                        </p>
                        <a style="background-color: var(--bs-secondary-color); color: var(--bs-body-bg)" class="btn btn-sm my-1" href="/tugas/{{$tgs->id}}/show">See more detail <i class="fa fa-fw fa-eye"></i></a>
                        @endforeach -->
                        @foreach ($tugasNotif as $key => $tgs)
                        <a href="/tugas/{{$tgs->id}}/show" class="position-relative hover-notif d-flex justify-content-between align-items-center text-decoration-none border rounded p-3 mb-3" style="color: var(--bs-emphasis-color)">
                            <div style="width: 85%">
                                @if ($loop->first)
                                    <p class="position-absolute bg-warning text-black fw-semibold text-sm rounded-1 px-2" style="left: -8px; top: -8px;">Terbaru</p>
                                @endif
                                <p class="mb-0 text-sm text-secondary">{{$tgs->created_at}}</p>
                                <h6 class="mb-0">{{$tgs->nama_tugas}}</h6>
                                <p class="mb-0 text-sm text-truncate" style="width: 75%">{{$tgs->deskripsi}}</p>
                            </div>
                            <div class="notif-hand text-center">
                                <span class="d-flex align-items-center">Click <i class="fa fa-fw fa-2xl fa-hand-pointer"></i></span>
                            </div>
                        </a>
                        @endforeach

                        <p class="mb-0 text-sm text-secondary">Total task {{$tugas->count()}} max 10 notification</p>
                    @else
                        <tr>
                            <td colspan="100">
                                <div class="text-center text-secondary py-4">
                                    <i class="fa fa-fw fa-exclamation-circle"></i>
                                    <p class="my-0">There are no assignments at this time.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="setujuiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Persetujuan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="mb-0 text-sm text-primary">Judul Tugas :</p>
            <h6 class="mb-4" id="tugasName"></h6>
            <p class="mb-0">Yakin setujui sebagai tugas selesai?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form id="setujuiAction" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-primary">Setujui</button>
            </form>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="pengaturanTugas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Pengaturan Tugas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/tugas/tugasConfig" method="post">
                @csrf
                <div class="form-check">
                    <input class="form-check-input" value="0" type="radio" name="filter_tugas_admin" id="filter_tugas_admin1" {{$tugasConfig->filter_tugas_admin === 0 ? 'checked' : ''}}>
                    <label class="form-check-label" for="filter_tugas_admin1">
                        Admin lain tidak dapat melihat tugas Admin lainnya
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="1" type="radio" name="filter_tugas_admin" id="filter_tugas_admin2" {{$tugasConfig->filter_tugas_admin === 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="filter_tugas_admin2">
                        Admin lain dapat melihat tugas Admin lainnya
                    </label>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // $(document).ready(function() {
    //     $('#setujuiForm').on('click', function() {
    //         const tugasId = $(this).data('id');
    //         const tugasName = $(this).data('judul');
    //         $('#tugasName').text(tugasName); 
    //         const setujuiAction =  $('#setujuiAction');
    //         setujuiAction.attr('action', '/tugas/' + tugasId + '/setujui');
    //     })
    // })
    document.addEventListener('DOMContentLoaded', function() {
        var setujuiForm = document.getElementById('setujuiForm');

        if (setujuiForm) {
            setujuiForm.addEventListener('click', function() {
            var tugasId = this.getAttribute('data-id');
            var tugasName = this.getAttribute('data-judul');
            var tugasNameElement = document.getElementById('tugasName');
            tugasNameElement.textContent = tugasName;
            var setujuiAction = document.getElementById('setujuiAction');
            setujuiAction.setAttribute('action', '/tugas/' + tugasId + '/setujui');
        });
        }
    });
</script>

<script>
    var ctx = document.getElementById('tugasBerproses').getContext('2d');
    var tugasBerproses = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total tugas', 'Tugas berproses'],
            datasets: [{
                data: [{{ $tugas->count() }}, {{ $progress_tugas }}],
                backgroundColor: ['#6c757d', '#0d6efd']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Persentase Tugas Berproses',
                    color: '#0d6efd',
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    ticks: {
                        color: '#0d6efd',
                    }
                },
                x: {
                    ticks: {
                        color: '#6c757d',
                    }
                }
            },
        }
    });

    var ctx = document.getElementById('tugasTerlambat').getContext('2d');
    var tugasTerlambat = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total tugas', 'Tugas Terlambat'],
            datasets: [{
                data: [{{ $tugas->count() }}, {{ $tugas_terlambat }}],
                backgroundColor: ['#6c757d', '#dc3545'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Persentase Tugas Terlambat',
                    color: '#dc3545',
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    ticks: {
                        color: '#dc3545',
                    }
                },
                x: {
                    ticks: {
                        color: '#6c757d',
                    }
                }
            },
        }
    });

    var ctx = document.getElementById('tugasSelesai').getContext('2d');
    var tugasSelesai = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total tugas', 'Tugas Selesai'],
            datasets: [{
                data: [{{ $tugas->count() }}, {{ $tugas_selesai }}],
                backgroundColor: ['#6c757d', '#198754']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Persentase Tugas Selesai',
                    color: '#198754',
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    ticks: {
                        color: '#198754',
                    }
                },
                x: {
                    ticks: {
                        color: '#6c757d',
                    }
                }
            },
        }
    });
</script>
@endsection