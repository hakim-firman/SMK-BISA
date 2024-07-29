@extends('Auth.templates.layout')
@section('title', 'Login')

@push('additional-js')
    <script></script>
@endpush
@section('content')
    <div id="auth-left">
        <div class="pb-3 ">
            <a href="index.html"><img src="logo.svg" style="height: 5rem" alt="Logo"></a>
            <p class="auth-subtitle text-primary">Basis Informasi Siswa dan Akademik </p>
        </div>
        <h1 class="auth-title">Log in.</h1>
        <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>


        @if ($errors->any())
            <div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('authenticate') }}" method="post">

            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" name="email" placeholder="Email">
                <div class="form-control-icon">
                    <i class="bi  bi-envelope-at"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>

            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="font-bold">Sign
                    up</a>.</p>

        </div>
    </div>
@endsection
