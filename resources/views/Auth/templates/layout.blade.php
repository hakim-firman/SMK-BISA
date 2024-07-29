<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@stack('title') - Basis Informasi Siswa dan Akademik</title>



    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('assets/compiled/css/app.css')}}">
  <link rel="stylesheet" href="{{asset('assets/compiled/css/app-dark.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">

<div class="row h-100">
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
    <div class="col-lg-5 col-12">
        @yield('content')
    </div>

</div>

    </div>
</body>

@stack('additional-js')

</html>
