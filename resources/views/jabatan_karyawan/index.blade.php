@extends('adminlte::page')

@section('title', 'Data Jabatan Karyawan')

@section('content_header')
    <h1 class="m-0 text-dark">Data Jabatan Karyawan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header clearfix">
                    <h2 class="card-title mb-0"><strong>Table Data Jabatan Karyawan</strong></h2>
                    <div class="card-tools">
                        <a href="{{ route('jabatan-karyawan.create') }}" class="btn btn-primary btn-md">Tambah Jabatan Karyawan</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="jabatan-karyawan-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>NIK</th>
                                    <th>NAMA KARYAWAN</th>
                                    <th>NAMA JABATAN</th>
                                    <th>TANGGAL MULAI</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($item->karyawan)->nik }}</td>
                                    <td>{{ optional($item->karyawan)->nama_lengkap }}</td>
                                    <td>{{ optional($item->jabatan)->nama_jabatan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('jabatan-karyawan.destroy', $item->id) }}" method="post" style="display: inline-block;">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{ route('jabatan-karyawan.edit', $item->id) }}" class="btn btn-md btn-warning">EDIT</a>
                                            <button type="button" class="btn btn-md btn-danger btn-delete">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- DataTables Bootstrap4 --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    {{-- jQuery sudah tersedia di AdminLTE; tambahkan DataTables --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $('#jabatan-karyawan-table').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                autoWidth: false,
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                    paginate: {
                        previous: 'Sebelumnya',
                        next: 'Berikutnya'
                    },
                    zeroRecords: 'Data tidak ditemukan'
                }
            });

            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: 'Yakin?',
                    text: 'Data yang dihapus tidak dapat dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@stop

