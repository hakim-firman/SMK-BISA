@extends('Templates.layout')
@section('title', 'Siswa')
{{-- @section('heading', 'Daftar Siswa') --}}
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Relasi Data</h3>
                <p class="text-subtitle text-muted">Menampilkan semua data yang terdaftar dalam sistem</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Siswa-Kelas-Guru</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@push('additional-js')
    <script>
        new DataTable('#myTable', {
            processing: true,
            serveriside: true,
            responsive: true,
            select: true,
            // ajax: "{{ route('siswa.index') }}",
            // data: function(d) {
            //             d.role = $('#filterSelect').val();
            //         },
            ajax: {
                url: '{{ route('relasi') }}',
                data: function(d) {
                    d.filter = $('#filterSelect').val();

                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'NIS',
                    name: 'Nis'
                },
                {
                    data: 'name',
                    name: 'Nama Siswa'
                },
                {
                    data: 'NamaKelas',
                    name: 'Kelas'
                },
                {
                    data: 'NamaGuru',
                    name: 'Daftar Guru',

                },
            ]
        });
        $('#filterSelect').change(function() {
            $('#myTable').DataTable().ajax.reload();
        });


    </script>
@endpush

@section('content')
    <section class="section">
        <div class="alert alert-success d-none"><i class="bi bi-check-circle"></i>
            <p class="d-inline" id="message"></p>
        </div>
        <div class="card">

            <div class="card-content">

                <div class="card-body ">
                    <!-- Button trigger modal -->
                    <div class="d-flex  align-items-end justify-content-end">


                        <div>
                            <span class="fw-bold">Filter:</span>
                            <select class="form-select d-inline" style="width: 10rem" id="filterSelect">
                                <option value="" selected>Semua Kelas</option>
                                @foreach ($kelas as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table id="myTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nis</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Daftar Guru</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nis</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Daftar Guru</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
