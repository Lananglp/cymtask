<!doctype html>
<html lang="en" data-bs-theme="light">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cym Task</title>
    <link rel="shortcut icon" href="/img/cymtask.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body style="background-color: var(--bs-tertiary-bg); color: var(--bs-emphasis-color);">

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

    @error('email')
    <div class="fixed-top m-4">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fa fa-fw fa-circle-exclamation fa-xl text-warning me-2"></i> <strong>Warning!</strong> Email yang anda masukan sudah digunakan oleh pengguna lain.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @enderror

    {{-- @error('password')
    <div class="fixed-top m-4">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fa fa-fw fa-circle-exclamation fa-xl text-warning me-2"></i> <strong>Warning!</strong> Password harus terdiri dari minimal 8 karakter..
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @enderror --}}

    <div class="flex-auto-center vh-100">
        <div class="container col-lg-4 shadow rounded-3 p-4 mx-4 mx-sm-0" style="background-color: var(--bs-body-bg)">
            <div class="text-center">
                <img src="/img/cymtask.svg" alt="" width="64">
                {{-- <h1 class="ms-1 my-0 fw-semibold fs-6">BD Project</h1> --}}
            </div>
            <div>
                <h2 class="mb-5 text-center text-info fw-semibold">CYM TASK</h2>
                <form action="/register" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="my-2">
                        <input type="text" name="name" id="" class="form-control" placeholder="Nama lengkap" required>
                        <div class="invalid-feedback">
                            Nama tidak boleh kosong.
                        </div>
                    </div>
                    <div class="my-2">
                        <input type="email" name="email" id="" class="form-control" placeholder="Email" required>
                        <div class="invalid-feedback">
                            Email tidak boleh kosong.
                        </div>
                    </div>
                    <div class="my-2">
                        <select name="jabatan" id="" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="Karyawan">Karyawan</option>
                            <option value="Admin">Admin</option>
                        </select>
                        <div class="invalid-feedback">
                            Jabatan tidak boleh kosong.
                        </div>
                    </div>
                    <div class="my-2">
                        <input type="password" name="password" id="" class="form-control" placeholder="Password" required>
                        <div class="invalid-feedback">
                            Password tidak boleh kosong.
                        </div>
                    </div>
                    <div class="my-2">
                        <input type="password" name="password_confirmation" id="" class="form-control" placeholder="Konfirmasi password" required>
                        <div class="invalid-feedback">
                            Validasi password tidak boleh kosong.
                        </div>
                    </div>
                    <button class="btn btn-primary w-100 my-2 rounded-3"><i class="fa fa-fw fa-arrow-right"></i> Register</button>
                    <p class="text-center mt-2">Sudah punya akun? Klik <a class="text-decoration-none fw-semibold border-bottom border-2 border-primary" href="/">disini</a> untuk login.</p>
                </form>
            </div>
        </div>
    </div>
    <script src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        (() => {
            'use strict'
        
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')
        
            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }
        
                form.classList.add('was-validated')
            }, false)
            })
        })()

        setTimeout(function() {
            var alertElement = document.querySelector('.alert');
            if (alertElement) {
                alertElement.remove();
            }
        }, 5000); // Menghilangkan setelah 5 detik (5000 ms)




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





        // document.addEventListener('DOMContentLoaded', function() {
        //     // Mendapatkan semua elemen input
        //     var inputElements = document.querySelectorAll('input');

        //     // Iterasi melalui setiap elemen input
        //     inputElements.forEach(function(inputElement) {
        //         // Mendapatkan nama input
        //         var inputName = inputElement.name;

        //         // Mengisi nilai input dari localStorage jika ada
        //         if (localStorage.getItem(inputName)) {
        //             inputElement.value = localStorage.getItem(inputName);
        //         }

        //         // Menyimpan nilai input ke dalam localStorage saat input berubah
        //         inputElement.addEventListener('input', function() {
        //             localStorage.setItem(inputName, inputElement.value);
        //         });
        //     });
        // });
    </script>
</body>
</html>