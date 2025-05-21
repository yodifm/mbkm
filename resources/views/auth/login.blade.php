<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merdeka Belajar Kampus Merdeka</title>

    <link rel="shortcut icon" href="{{ asset('logo_kampus.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('/dist/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/assets/compiled/css/auth.css') }}">
</head>

<body>
    <script src="{{ asset('/dist/assets/static/js/initTheme.js') }}"></script>
    <div id="auth">

        <div class="row h-100" style="background-color:#fff">

            <div class="col-lg-5 col-12" style="background-color:#fff"><br />

                <div id="auth-left">

                    <div style="display: flex; align-items: center; gap: 10px; margin-top: -40px">
                        <img src={{ asset('logo_kampus.png') }} alt="Logo" style="width: 50px; height: 50px;">
                        <span style="font-size: 20px; font-weight: bold;">SIP MBKM MP FIP UNJ</span>
                    </div>

                    <div style="margin-top: 40px;">

                        <h1 class="auth-title" style="color: #000; font-size:50px" ;>Selamat Datang 👋</h1>
                        <p class="mb-5 auth-subtitle" style="font-size:20px">Kami senang kamu datang kembali</p>
                    </div>

                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-4 form-group position-relative has-icon-left">

                            <input type="text" class="form-control form-control-xl"
                                placeholder="Nomor Induk Mahasiswa" name="NIM" style="border-color:#000">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="mb-4 form-group position-relative has-icon-left">
                            <input type="password" class="form-control form-control-xl" placeholder="Kata Sandi"
                                name="password" style="border-color:#000">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="mt-5 text-white shadow-lg btn btn-block btn-lg" style="background-color: #34623F"
                            type="submit">Log in</button>
                    </form>

                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"
                    style="position: relative; background: linear-gradient(90deg, #DBEBDF, #DBEBDF); border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                    <img src="{{ asset('logo.png') }}" alt="Logo"
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
                </div>
            </div>


        </div>

    </div>

    @include('sweetalert::alert')
</body>

</html>

</html>
