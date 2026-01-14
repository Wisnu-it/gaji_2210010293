@extends('adminlte::page')

@section('title', 'Data Jabatan')

@section('content_header')
    <h1 class="m-0 text-dark">Data Jabatan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header clearfix">
                    <h2 class="card-title mb-0"><strong>Table Data Jabatan</strong></h2>
                    <div class="card-tools">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Aksi Jabatan">
                            <a href="{{ route('jabatan.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                            <a href="{{ route('print.jabatan') }}" class="btn btn-info">
                                <i class="fas fa-print"></i> Print
                            </a>
                            <a href="{{ route('export.excel') }}" class="btn btn-success">
                                <i class="far fa-file-excel"></i> Export Excel
                            </a>
                            <a href="{{ route('grafik.jabatan') }}" class="btn btn-warning">
                                <i class="fas fa-chart-bar"></i> Grafik
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="jabatan-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>NAMA JABATAN</th>
                                    <th>GAJI POKOK</th>
                                    <th>TUNJANGAN JABATAN</th>
                                    <th>UANG MAKAN PERHARI</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($jabatans as $jabatan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jabatan->nama_jabatan }}</td>
                                    <td>Rp {{ number_format($jabatan->gapok_jabatan, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($jabatan->tunjangan_jabatan, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($jabatan->uang_makan_perhari, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('jabatan.destroy', $jabatan->id) }}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Aksi">
                                                <a href="{{ route('jabatan.edit', $jabatan->id) }}" class="btn btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-delete" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
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
            $('#jabatan-table').DataTable({
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
