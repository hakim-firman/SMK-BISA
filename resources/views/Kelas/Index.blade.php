@extends('Templates.layout')
@section('title', 'Siswa')
{{-- @section('heading', 'Daftar Siswa') --}}
@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Kelas</h3>
                <p class="text-subtitle text-muted">Menampilkan semua Kelas yang terdaftar dalam sistem</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelas</li>
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
            ajax: "{{ route('kelas.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'name',
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
                    var var_url = '{{ route('kelas.store') }}';
                    var var_type = 'POST'
                } else {
                    var var_url = '{{ route('kelas.update', ':id') }}'.replace(':id', id);
                    var var_type = 'PUT'
                }
                console.log('this is var_url:' + var_url)
                console.log('this is var_type:' + var_type)
                $.ajax({
                    url: var_url,
                    type: var_type,
                    data: {
                        kelas: $('#kelas').val(),
                    },
                    success: function(response) {
                        console.log(response.success);
                        $('#kelas').val('');
                        $('#exampleModal').modal('hide');
                        $('#myTable').DataTable().ajax.reload();
                        $('.alert-success').removeClass('d-none');
                        $('#message').text(response.success);
                        setTimeout(function() {
                            $('.alert-success').addClass('d-none');
                        }, 9000);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
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
                $('#kelas').val('');
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');
                $('.tombol-update').removeClass('tombol-update').addClass('tombol-simpan')
                $('.tombol-simpan').text('Simpan')
            });
            // event handler untuk tombol edot
            $('body').on('click', '.tombol-edit', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ route('kelas.edit', ':id') }}'.replace(':id', id),
                    type: 'GET',
                    success: function(response) {
                        $('#exampleModalLabel').html('Form Edit Kelas')
                        $('#exampleModal').modal('show');
                        $('#kelas').val(response.result.name);
                        $('.tombol-simpan').removeClass('tombol-simpan').addClass(
                            'tombol-update')
                        $('.tombol-update').text('Update')
                        console.log(response.result.name);
                        $('.tombol-update').data('id',id)
                       
                    }
                });
            });
            $('body').on('click', '.tombol-update', function(e) {
                            e.preventDefault();
                            var id = $(this).data('id');
                            $('.is-invalid').removeClass('is-invalid');
                            $('.invalid-feedback').remove();
                            simpan(id);

                        });
            $('body').on('click', '.tombol-delete', function(e) {
                $('#modalHapus').modal('show');

                $('.tombol-hapus').data('id',$(this).data('id'));
                var name=$(this).data('name')
                $('#data-name').text(name);

            });
             $('body').on('click', '.tombol-hapus', function(e) {
                e.preventDefault()
                var id ='';
                id=$(this).data('id')
                console.log(id)
                var url='{{ route('kelas.destroy', ':id') }}'.replace(':id', id)
                console.log(url)
                $.ajax({
                    url: '{{ route('kelas.destroy', ':id') }}'.replace(':id', id),
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
                        id=''

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

                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary tombol-tambah">
                        + Tambah Data
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Kelas</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="">
                                        <label for="invalid-state">Nama Kelas</label>
                                        <input type="text" class="form-control " id="kelas"
                                            placeholder="contoh : XI TKJ 1 / XI PSPT " required="">
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
                                    <button type="button" class="btn btn-primary tombol-hapus" data-id="x">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table id="myTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kelas</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
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
