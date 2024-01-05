<!doctype html>
<html lang="en" data-bs-theme="light">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cym Task</title>
    <link rel="shortcut icon" href="/img/cymtask.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body style="position-relative background-color: var(--bs-tertiary-bg); color: var(--bs-emphasis-color)">

    @if (session('success'))
    <div class="fixed-top m-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-fw fa-circle-check fa-xl text-success me-2"></i> <strong>Success</strong> {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if (session('warning'))
    <div class="fixed-top m-4">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fa fa-fw fa-circle-exclamation fa-xl text-warning me-2"></i> <strong>Warning!</strong> {{session('warning')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if (session('danger'))
    <div class="fixed-top m-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-fw fa-circle-exclamation fa-xl text-danger me-2"></i> <strong>Error!</strong> {{session('danger')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if (session('login'))
    <div class="fixed-top m-4">
        <div class="alert alert-success alert-dismissible d-flex align-items-center fade show" role="alert">
            <i class="fa fa-fw fa-circle-check fa-xl text-success me-2"></i> <strong>Success</strong>&nbsp;{{session('login')}}&nbsp;<h6 class="my-0">{{auth()->user()->name}}</h6>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if (session('logout'))
    <div class="fixed-top m-4">
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <i class="fa fa-fw fa-circle-check fa-xl text-primary me-2"></i> <strong>Success</strong> {{session('logout')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <div id="loadingNice">
        <div id="loadingEffect" class="position-fixed vw-100 vh-100 d-flex justify-content-center align-items-center" style="z-index: 150;">
            <div class="text-center">
                <svg class="pl" viewBox="0 0 200 200" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="pl-grad1" x1="1" y1="0.5" x2="0" y2="0.5">
                            <stop offset="0%" stop-color="hsl(313,90%,55%)" />
                            <stop offset="100%" stop-color="hsl(223,90%,55%)" />
                        </linearGradient>
                        <linearGradient id="pl-grad2" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="hsl(313,90%,55%)" />
                            <stop offset="100%" stop-color="hsl(223,90%,55%)" />
                        </linearGradient>
                    </defs>
                    <circle class="pl__ring" cx="100" cy="100" r="82" fill="none" stroke="url(#pl-grad1)" stroke-width="36" stroke-dasharray="0 257 1 257" stroke-dashoffset="0.01" stroke-linecap="round" transform="rotate(-90,100,100)" />
                    <line class="pl__ball" stroke="url(#pl-grad2)" x1="100" y1="18" x2="100.01" y2="182" stroke-width="36" stroke-dasharray="1 165" stroke-linecap="round" />
                </svg>
                <h6 class="mt-3 mb-0 text-white">Loading. . .</h6>
            </div>
            {{-- <div class="text-center">
                <img src="/img/cymtask.svg" alt="logo cym task" width="128" class="loading-logo-effect">
                <h6 class="mt-2 mb-0 text-white"><i class="fa fa-spinner fa-spin"></i> Loading. . .</h6>
            </div> --}}
        </div>
    </div>

    <div class="position-relative">
        {{-- <div class="desktop-opacity-none position-absolute mobile-vw-100 h-100" style="min-height: 100vh; z-index: 50;"> --}}
            <div id="sidebar" class="position-absolute sidebar shadow rounded-end-3 px-4 py-2" style="background-color: var(--bs-body-bg);">
                <div>
                    <div class="d-flex justify-content-center align-items-center border-bottom pt-1 pb-2">
                        <img src="/img/cymtask.svg" alt="" width="36">
                        <h2 class="ms-1 my-0 fw-semibold text-info fs-4">CYM TASK</h2>
                    </div>
                    <ul class="list-unstyled mt-4">
                        {{-- tugas --}}
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Dashboard' ? 'item-active' : ''}} rounded"><a class="px-2 py-1 my-2 stretched-link nav-link fw-semibold" href="/dashboard"><i class="me-1 fa fa-fw fa-home"></i> Dashboard</a></li>
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Semua Tugas' ? 'item-active' : ''}} rounded"><a class="ps-4 pe-2 mb-1 stretched-link nav-link text-secondary" href="/tugas/tugasAll">Semua Tugas</a></li>
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Tugas Berproses' ? 'item-active' : ''}} rounded"><a class="ps-4 pe-2 mb-1 stretched-link nav-link text-secondary" href="/tugas/tugasProgress">Tugas Berproses</a></li>
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Tugas Terlambat' ? 'item-active' : ''}} rounded"><a class="ps-4 pe-2 mb-1 stretched-link nav-link text-secondary" href="/tugas/tugasTerlambat">Tugas Terlambat</a></li>
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Tugas Selesai' ? 'item-active' : ''}} rounded"><a class="ps-4 pe-2 mb-1 stretched-link nav-link text-secondary" href="/tugas/tugasSelesai">Tugas Selesai</a></li>
                        {{-- absensi --}}
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Absensi' ? 'item-active' : ''}} rounded"><a class="px-2 py-1 my-2 stretched-link nav-link fw-semibold" href="/absensi"><i class="me-1 fa fa-fw fa-calendar-check"></i> Absensi</a></li>
                        @if (auth()->user()->jabatan === 'Admin')
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Pengaturan Absensi' ? 'item-active' : ''}} rounded"><a class="ps-4 pe-2 mb-1 stretched-link nav-link text-secondary" href="/absensi/pengaturan">Pengaturan Absensi</a></li>
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Rekap Absensi' ? 'item-active' : ''}} rounded"><a class="ps-4 pe-2 mb-1 stretched-link nav-link text-secondary" href="/absensi/rekapAbsensi">Rekap Absensi</a></li>
                        @endif
                        {{-- chat --}}
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Chat Grup' ? 'item-active' : ''}} rounded"><a class="px-2 py-1 my-2 stretched-link nav-link fw-semibold" href="/chat"><i class="me-1 fa fa-fw fa-comment"></i> Chat Grup</a></li>
                        {{-- toko --}}
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Toko' ? 'item-active' : ''}} rounded"><a class="px-2 py-1 my-2 stretched-link nav-link fw-semibold" href="/toko"><i class="me-1 fa fa-fw fa-shop"></i> Toko</a></li>
                        {{-- <li class="position-relative item-hover {{Route::currentRouteName() === 'Pengaturan Absensi' ? 'item-active' : ''}} rounded"><a class="ps-4 pe-2 mb-1 stretched-link nav-link text-secondary" href="/absensi/pengaturan">Pengaturan Absensi</a></li>
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Rekap Absensi' ? 'item-active' : ''}} rounded"><a class="ps-4 pe-2 mb-1 stretched-link nav-link text-secondary" href="/absensi/rekapAbsensi">Rekap Absensi</a></li> --}}
                        {{-- akun --}}
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Akun' ? 'item-active' : ''}} rounded"><a class="px-2 py-1 my-2 stretched-link nav-link fw-semibold" href="/users"><i class="me-1 fa fa-fw fa-user"></i> Akun</a></li>
                        @if (auth()->user()->jabatan === 'Admin')
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Tambah Akun' ? 'item-active' : ''}} rounded"><a class="ps-4 pe-2 mb-1 stretched-link nav-link text-secondary" href="/users/create">Tambah Akun</a></li>
                        @endif
                        @if (is_null(auth()->user()->no_hp) || is_null(auth()->user()->jenis_kelamin) || is_null(auth()->user()->tempat_lahir) || is_null(auth()->user()->tanggal_lahir) || is_null(auth()->user()->umur) || is_null(auth()->user()->agama) || is_null(auth()->user()->alamat))
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Edit Akun' ? 'item-active' : ''}} rounded"><a class="ps-4 pe-2 mb-1 stretched-link nav-link text-secondary" href="/users/{{auth()->user()->id}}/edit">Lengkapi akun <i class="fa fa-fw fa-circle-exclamation text-warning"></i></a></li>
                        @endif
                        <li class="position-relative item-hover {{Route::currentRouteName() === 'Edit password' ? 'item-active' : ''}} rounded"><a class="ps-4 pe-2 mb-1 stretched-link nav-link text-secondary" href="/users/{{auth()->user()->id}}/editPassword">Ubah Password</a></li>
                        {{-- <li class="desktop-d-none position-relative rounded">
                            <button class="btn btn-sm border-0 fw-semibold shadow-none dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="me-1 fa fa-fw fa-cog"></i> Tema
                            </button>
                            <ul class="dropdown-menu shadow border-0">
                                <li><button data-bs-theme-value="light" class="dropdown-item fw-semibold"><i class="fa fa-fw fa-sun me-1"></i>Light</button></li>
                                <li><button data-bs-theme-value="dark" class="dropdown-item fw-semibold"><i class="fa fa-fw fa-moon me-1"></i>Dark</button></li>
                            </ul>
                        </li> --}}
                    </ul>
                    <div class="border-top pt-4">
                        <button type="button" class="btn btn-sm btn-danger border-0 w-100" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="fa fa-fw fa-power-off"></i> Logout
                        </button>
                    </div>
                    <div class="p-3">
                        <h6 class="border-bottom text-center text-success pb-2">Tips</h6>
                        <ul>
                            <li class="text-sm mb-2">Tugas dikategorikan selesai apabila <span class="text-success">Karyawan</span> menandai tugas selesai.</li>
                            <li class="text-sm mb-2">Tugas yang sudah disetujui selesai oleh <span class="text-primary">Admin</span> akan masuk ke tabel history.</li>
                        </ul>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
        <div id="content" class="content px-4">
            <div id="sidebarBackdrop" class="position-absolute start-0 w-100 h-100" style="min-height: 100vh; z-index: 40"></div>
            <div class="flex-between-center shadow p-3 rounded-bottom-3" style="background-color: var(--bs-body-bg)">
                <div>
                    <button class="btn btn-sm btn-primary" type="button" id="toggleSidebar">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    @if (Route::currentRouteName())
                        <h3 class="mobile-d-none ms-2 my-0 fs-5">{{Route::currentRouteName()}}</h3>
                    @endif
                    {{-- @if (Route::currentRouteName() === 'index')
                        <h3 class="ms-2 my-0 fs-5">Akun</h3>
                    @endif
                    @if (Route::currentRouteName() === 'show')
                        <h3 class="ms-2 my-0 fs-5">Tugas</h3>
                    @endif --}}
                </div>
                <div class="d-flex align-items-center">
                    <div class="dropdown me-2">
                        <button class="btn btn-sm border-0 fw-semibold shadow-none dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tema
                        </button>
                        <ul class="dropdown-menu shadow border-0">
                            <li><button data-bs-theme-value="light" class="dropdown-item fw-semibold"><i class="fa fa-fw fa-sun me-1"></i>Light</button></li>
                            <li><button data-bs-theme-value="dark" class="dropdown-item fw-semibold"><i class="fa fa-fw fa-moon me-1"></i>Dark</button></li>
                        </ul>
                    </div>
                    <div class="mobile-d-none vr me-3 ms-1"></div>
                    <h6 class="mobile-d-none my-0 me-2 {{auth()->user()->jabatan === 'Admin' ? 'text-primary' : 'text-success'}}">{{auth()->user()->jabatan}}</h6>
                    <div class="mobile-d-none vr me-3 ms-1"></div>
                    {{-- <p class="mobile-d-none my-0"><i class="fa fa-fw fa-user"></i> {{auth()->user()->name}}</p> --}}
                    <p class="my-0"><i class="fa fa-fw fa-user"></i> <span id="userName"></span></p>
                </div>
            </div>

            @yield('content')

            <div class="py-4">
                <p class="text-center text-secondary my-0">&copy; 2023 Cylare Manajement Task. All Rights Reserved</p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to logout?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Are you sure to logout from account :</span>
                    <h6 class="my-0">{{auth()->user()->name}}</h6>
                </div>
                <div class="modal-footer">
                    <a href="/logout" class="btn btn-sm btn-danger border-0 d-flex justify-content-end">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/script.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> -->
    <script>
        (() => {
        'use strict'

        const getStoredTheme = () => localStorage.getItem('theme')
        const setStoredTheme = theme => localStorage.setItem('theme', theme)

        const getPreferredTheme = () => {
            const storedTheme = getStoredTheme()
            if (storedTheme) {
            return storedTheme
            }

            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }

        const setTheme = theme => {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
            document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        const showActiveTheme = (theme, focus = false) => {
            const themeSwitcher = document.querySelector('#bd-theme')

            if (!themeSwitcher) {
            return
            }

            const themeSwitcherText = document.querySelector('#bd-theme-text')
            const activeThemeIcon = document.querySelector('.theme-icon-active')
            const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
            const iconOfActiveBtn = btnToActive.querySelector('i').dataset.themeIcon

            document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
            element.classList.remove('active')
            element.setAttribute('aria-pressed', 'false')
            })

            btnToActive.classList.add('active')
            btnToActive.setAttribute('aria-pressed', 'true')
            activeThemeIcon.setAttribute('href', svgOfActiveBtn)
            const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
            themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

            if (focus) {
            themeSwitcher.focus()
            }
        }

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            const storedTheme = getStoredTheme()
            if (storedTheme !== 'light' && storedTheme !== 'dark') {
            setTheme(getPreferredTheme())
            }
        })

        window.addEventListener('DOMContentLoaded', () => {
            showActiveTheme(getPreferredTheme())

            document.querySelectorAll('[data-bs-theme-value]')
            .forEach(toggle => {
                toggle.addEventListener('click', () => {
                const theme = toggle.getAttribute('data-bs-theme-value')
                setStoredTheme(theme)
                setTheme(theme)
                showActiveTheme(theme, true)
                })
            })
        })
        })()
    </script>

    <script>
        function splitUserName() {
            const userName = document.getElementById("userName");
            const userLogin = "{{auth()->user()->name}}";

            if (window.innerWidth < 576) {
                userName.textContent = userLogin.split(" ")[0] + " " + userLogin.split(" ")[1];
            } else {
                userName.textContent = userLogin;
            }
        }

        document.addEventListener("DOMContentLoaded", splitUserName);
        window.addEventListener("resize", splitUserName);
    </script>
</body>
</html>