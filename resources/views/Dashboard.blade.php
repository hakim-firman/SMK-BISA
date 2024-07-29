@extends('Templates.layout')
@section('title', 'Dashboard')

@section('heading')
<div class="page-heading">
    <h3>Dashboard</h3>
</div>
@endsection
@section('content')
<section class="row " >
    <div class="col-12 col-lg-12">
        <div class="row">
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div
                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon purple mb-2">
                                    <i class="iconly-boldShow"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Kelas</h6>
                                <h6 class="font-extrabold mb-0">{{$kelas}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div
                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Siswa</h6>
                                <h6 class="font-extrabold mb-0">{{$siswa}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div
                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon green mb-2">
                                    <i class="iconly-boldAdd-User"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Guru</h6>
                                <h6 class="font-extrabold mb-0">{{$guru}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <h1>Hi🖐, {{ Auth::user()->name }}</h1>
    <h1 class="mb-10"style="margin-bottom: 20rem"> Selamat Datang Di Basis Informasi Siswa Dan Akademik</h1>

</section>
@endsection
