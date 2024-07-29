@extends('Templates.layout')
@section('title', 'Siswa')
{{-- @section('heading', 'Daftar Siswa') --}}
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Siswa</h3>
                <p class="text-subtitle text-muted">Menampilkan semua siswa yang terdaftar dalam sistem</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Siswa</li>
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
                url: '{{ route('siswa.index') }}',
                data: function(d) {
                    d.filter = $('#filterSelect').val();

                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'Nis',
                    name: 'Nis'
                },
                {
                    data: 'name',
                    name: 'Nama'
                },
                {
                    data: 'class.name',
                    name: 'Kelas'
                },
                {
                    data: 'aksi',
                    name: 'Aksi',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $('#filterSelect').change(function() {
            $('#myTable').DataTable().ajax.reload();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('body').on('click', '.tombol-simpan', function(e) {
                e.preventDefault();
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                $('.tombol-update').removeClass('tombol-update').addClass('tombol-simpan')
                $('.tombol-simpan').text('Simpan')
                simpan();

            });
            // handler simpan dan update
            function simpan(id = '') {
                if (id == '') {
                    var var_url = '{{ route('siswa.store') }}';
                    var var_type = 'POST'
                } else {
                    var var_url = '{{ route('siswa.update', ':id') }}'.replace(':id', id);
                    var var_type = 'PUT'
                }
                console.log('this is var_url:' + var_url)
                console.log('this is var_type:' + var_type)

                $.ajax({
                    url: var_url,
                    type: var_type,
                    data: {
                        Nis: $('#Nis').val(),
                        name: $('#name').val(),
                        kelas_id: $('#kelas_id').val(),
                    },
                    success: function(response) {
                        console.log(response.success);
                        $('#Nis').val('');
                        $('#name').val('');

                        $('#exampleModal').modal('hide');
                        $('#myTable').DataTable().ajax.reload();
                        $('.alert-success').removeClass('d-none');
                        $('#message').text(response.success);
                        setTimeout(function() {
                            $('.alert-success').addClass('d-none');
                        }, 9000);
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        console.log('general error:' + errors)
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            console.log(errors)
                            $.each(errors, function(key, value) {
                                var input = $('#' + key);
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback">' + value[
                                    0] + ' <i class="bx bx-radio-circle"></i></div>');
                            });
                        }
                    }
                });
            }

            // Event handler untuk tombol tambah
            $('body').on('click', '.tombol-tambah', function(e) {
                e.preventDefault();
                $('#exampleModal').modal('show');
            });

            // Event handler untuk menghapus pesan validasi saat modal ditutup
            $('#exampleModal').on('hidden.bs.modal', function() {
                $('#Nis').val('');
                $('#name').val('');
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');
                $('.tombol-update').removeClass('tombol-update').addClass('tombol-simpan')
                $('.tombol-simpan').text('Simpan')
            });
            // event handler untuk tombol edit
            $('body').on('click', '.tombol-edit', function(e) {
                e.preventDefault();
                console.log("this is edit")
                var id = $(this).data('id')

                $.ajax({
                    url: '{{ route('siswa.edit', ':id') }}'.replace(':id', id),
                    type: 'GET',
                    success: function(response) {
                        $('#exampleModalLabel').html('Form Edit Siswa')
                        $('#exampleModal').modal('show');
                        $('#Nis').val(response.result.Nis);
                        $('#name').val(response.result.name);
                        $('#kelas_id').val(response.result.kelas_id);
                        $('.tombol-simpan').removeClass('tombol-simpan').addClass(
                            'tombol-update')
                        $('.tombol-update').text('Update')
                        $('.tombol-update').data('id', id)


                    }
                });
            });
            $('body').on('click', '.tombol-update', function(e) {
                e.preventDefault();
                var id = $(this).data('id')
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                simpan(id);

            });
            $('body').on('click', '.tombol-delete', function(e) {
                $('#modalHapus').modal('show');

                $('.tombol-hapus').data('id', $(this).data('id'));
                var name = $(this).data('name')
                $('#data-name').text(name);

            });
            $('body').on('click', '.tombol-hapus', function(e) {
                e.preventDefault()
                var id = '';
                id = $(this).data('id')
                console.log(id)
                var url = '{{ route('siswa.destroy', ':id') }}'.replace(':id', id)
                console.log(url)
                $.ajax({
                    url: '{{ route('siswa.destroy', ':id') }}'.replace(':id', id),
                    type: 'DELETE',
                    success: function(response) {
                        $('#modalHapus').modal('hide');
                        $('#myTable').DataTable().ajax.reload();
                        $('.alert-success').removeClass('d-none');
                        $('#message').text(response.success);
                        setTimeout(function() {
                            $('.alert-success').addClass('d-none');
                        }, 9000);
                        $('.tombol-hapus').attr('data-id', '');
                        id = ''

                    }
                });
            });
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
                    <div class="d-flex  align-items-center justify-content-between">

                        <button type="button" class="btn btn-primary tombol-tambah">
                            + Tambah Data
                        </button>
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

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Siswa</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="">
                                        <label for="invalid-state">NIS</label>
                                        <input type="text" class="form-control " id="Nis" placeholder="nis  "
                                            required="">
                                        <div class="invalid-feedback">
                                            This is invalid state.
                                            <i class="bx bx-radio-circle"></i>
                                        </div>

                                    </div>
                                    <div class="">
                                        <label for="invalid-state">Nama Siswa</label>
                                        <input type="text" class="form-control " id="name" placeholder="Nama Siswa"
                                            required="">
                                        <div class="invalid-feedback">
                                            This is invalid state.
                                            <i class="bx bx-radio-circle"></i>
                                        </div>

                                    </div>
                                    <div class="">
                                        <label for="invalid-state">Kelas</label>
                                        <select class="form-select" id="kelas_id" name="kelas_id">
                                            @foreach ($kelas as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            This is invalid state.
                                            <i class="bx bx-radio-circle"></i>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close-button"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary tombol-simpan">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Hapus --}}
                    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalHapusLabel">Konfirmasi Hapus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="">
                                        <p>Apakah anda yakin ingin menghapus data <span id="data-name"
                                                class="text-danger fw-bold">xsaaa</span>?</p>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close-button"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary tombol-hapus"
                                        data-id="x">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table id="myTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nis</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nis</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Aksi</th>

                            </tr>
                        </tfoot>
                    </table>


                </div>
            </div>
        </div>
    </section>
@endsection
